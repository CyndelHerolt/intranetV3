<?php
/*
 * Copyright (c) 2024. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Classes/EduSign/ApiEduSign.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 29/02/2024 20:42
 */

namespace App\Classes\EduSign;

use App\Classes\EduSign\DTO\EduSignCourse;
use App\Classes\EduSign\DTO\EduSignEnseignant;
use App\Classes\EduSign\DTO\EduSignEtudiant;
use App\Classes\EduSign\DTO\EduSignGroupe;
use App\Entity\Departement;
use App\Entity\Groupe;
use App\Entity\Personnel;
use App\Entity\Semestre;
use App\Repository\EdtCelcatRepository;
use App\Repository\EdtPlanningRepository;
use App\Repository\EtudiantRepository;
use App\Repository\GroupeRepository;
use App\Repository\PersonnelRepository;
use App\Repository\SemestreRepository;
use Exception;
use Symfony\Component\HttpClient\HttpClient;

class ApiEduSign
{
    public function __construct(
        protected PersonnelRepository   $personnelRepository,
        protected EdtPlanningRepository $edtPlanningRepository,
        protected EdtCelcatRepository   $edtCelcatRepository,
        protected SemestreRepository    $semestreRepository,
        protected GroupeRepository      $groupeRepository,
        protected EtudiantRepository    $etudiantRepository,
        protected GetCleApi             $getCleApi,
    )
    {
    }

    public function addCourse(EduSignCourse $course, string $cleApi): string
    {
        $client = HttpClient::create();

        $response = $client->request('POST', 'https://ext.edusign.fr/v1/course', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ],
            'json' => ['course' => $course->toArray()],
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();

        $data = json_decode($content, true);
        // accéder à la valeur de l'ID
        $id = $data['result']['ID'] ?? "";

        if (str_contains($course->type_edt, 'intranet')) {
            $edt = $this->edtPlanningRepository->findOneBy(['id' => $course->api_id]);
            $rep = $this->edtPlanningRepository;
        } elseif (str_contains($course->type_edt, 'celcat')) {
            $edt = $this->edtCelcatRepository->findOneBy(['id' => $course->api_id]);
            $rep = $this->edtCelcatRepository;
        } else {
            $edt = null;
            $rep = null;
        }

        if (null === $edt) {
            throw new Exception('Course not found for ' . $edt->api_id);
        }

        if ($edt->getIdEduSign() == null && $rep !== null) {
            $edt->setIdEduSign($id);
            $rep->save($edt);
        }

        return $content;
    }

    public function updateCourse(EduSignCourse $course, string $cleApi): string
    {
        $client = HttpClient::create();

        $response = $client->request('PATCH', 'https://ext.edusign.fr/v1/professor/', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ],
            'json' => ['course' => $course->toArray()],
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();

        return $content;
    }

    public function getCourseIdByApiId(string $apiId, string $cleApi): mixed
    {
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://ext.edusign.fr/v1/course/get-id/' . $apiId, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        // convertit JSON en tableau associatif PHP
        $data = json_decode($content, true);

        return $data['result'] ?? "";
    }

    public function getCourses(?string $id, string $cleApi): mixed
    {
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://ext.edusign.fr/v1/course/' . $id, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        // convertit JSON en tableau associatif PHP
        $data = json_decode($content, true);

        return $data['result'] ?? "";
    }

    public function getAllCourses(string $cleApi): mixed
    {
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://ext.edusign.fr/v1/course', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ]
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();
        // convertit JSON en tableau associatif PHP
        $data = json_decode($content, true);

        return $data['result'] ?? "";
    }

    public function deleteCourse(?string $course, string $cleApi): string
    {
        $client = HttpClient::create();

        $response = $client->request('DELETE', 'https://ext.edusign.fr/v1/course/' . $course, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ],
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();

        $edt = $this->edtPlanningRepository->findOneBy(['idEduSign' => $course]);
        if ($edt) {
            $edt->setIdEduSign(null);
            $this->edtPlanningRepository->save($edt);
        }

        return $content;

    }

    public function getAllGroups(string $cleApi): mixed
    {
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://ext.edusign.fr/v1/group', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ]
        ]);

        $content = $response->getContent();
        // convertit JSON en tableau associatif PHP
        $data = json_decode($content, true);

        return $data['result'] ?? "";
    }

    public function addGroupe(EduSignGroupe $groupe, string $cleApi, ?string $type): mixed
    {
        $client = HttpClient::create();

        $response = $client->request('POST', 'https://ext.edusign.fr/v1/group', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ],
            'json' => ['group' => $groupe->toArray()],
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();

        $data = json_decode($content, true);
        // accéder à la valeur de l'ID
        $id = $data['result']['ID'] ?? "";

        if ($type === 'semestre') {
            $semestre = $this->semestreRepository->findOneBy(['id' => $groupe->api_id]);
            if ($semestre && $semestre instanceof Semestre) {
                if ($semestre->getIdEduSign() === null) {
                    $semestre->setIdEduSign($id);
                    $this->semestreRepository->save($semestre);
                }
            }
        } elseif($type === 'groupe') {
            $groupeAdd = $this->groupeRepository->findOneBy(['id' => $groupe->api_id]);
            if ($groupeAdd && $groupeAdd instanceof Groupe) {
                if ($groupeAdd && $groupeAdd->getIdEduSign() === null) {
                    $groupeAdd->setIdEduSign($id);
                    $this->groupeRepository->save($groupeAdd);
                }
            }
        }

            return $content;
    }

    public function deleteGroupe(EduSignGroupe $groupe, string $cleApi): void
    {
        $client = HttpClient::create();

        $response = $client->request('DELETE', 'https://ext.edusign.fr/v1/group/' . $groupe->id_edu_sign, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ],
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();

        $groupe = $this->groupeRepository->findOneBy(['idEduSign' => $groupe->id_edu_sign]);
        if ($groupe) {
            $groupe->setIdEduSign(null);
            $this->groupeRepository->save($groupe);
        }

    }

    public function addEtudiant(EduSignEtudiant $etudiant, $cleApi): void
    {
        $client = HttpClient::create();
        $response = $client->request('POST', 'https://ext.edusign.fr/v1/student', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ],
            'json' => ['student' => $etudiant->toArray()],
        ]);
        $statusCode = $response->getStatusCode();
        $content = $response->getContent();

        $data = json_decode($content, true);
        // accéder à la valeur de l'ID
        $id = $data['result']['ID'] ?? "";

        $etudiant = $this->etudiantRepository->findOneBy(['id' => $etudiant->api_id]);
        if ($etudiant && null === $etudiant) {
            throw new Exception('Etudiant not found for ' . $etudiant->api_id);
        }

        if ($etudiant && $etudiant->getIdEduSign() === null) {
            $etudiant->setIdEduSign($id);
            $this->etudiantRepository->save($etudiant);
        }
    }

    public function getAllEtudiants(string $cleApi): mixed
    {
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://ext.edusign.fr/v1/student', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ]
        ]);

        $content = $response->getContent();
        // convertit JSON en tableau associatif PHP
        $data = json_decode($content, true);

        return $data['result'] ?? "";
    }

    public function getEtudiant(?string $etudiant, string $cleApi): mixed
    {
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://ext.edusign.fr/v1/student/'.$etudiant, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ]
        ]);

        $content = $response->getContent();
        // convertit JSON en tableau associatif PHP
        $data = json_decode($content, true);

        return $data['result'] ?? "";
    }

    public function updateEtudiant(EduSignEtudiant $etudiant, string $cleApi): void
    {
        $client = HttpClient::create();

        $response = $client->request('PATCH', 'https://ext.edusign.fr/v1/student/', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ],
            'json' => ['student' => $etudiant->toArray()],
        ]);

    }

    public function deleteEtudiant(int $etudiant, string $cleApi): void
    {
        $client = HttpClient::create();

        $response = $client->request('DELETE', 'https://ext.edusign.fr/v1/student/' . $etudiant, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ],
        ]);

        $statusCode = $response->getStatusCode();
        $content = $response->getContent();

        $etudiant = $this->etudiantRepository->findOneBy(['idEduSign' => $etudiant]);
        if ($etudiant) {
            $etudiant->setIdEduSign(null);
            $this->etudiantRepository->save($etudiant);
        }
    }

    public function addEnseignant(EduSignEnseignant $enseignant, Personnel $personnel, Departement $departement, $cleApi): void
    {
        $client = HttpClient::create();

        $response = $client->request('POST', 'https://ext.edusign.fr/v1/professor', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ],
            'json' => ['professor' => $enseignant->toArray(), 'dontSendCredentials' => $enseignant->dontSendCredentials],
        ]);

        $statusCode = $response->getStatusCode();

        $content = $response->getContent();
        // convertit JSON en tableau associatif PHP
        $data = json_decode($content, true);

        // accéder à la valeur de l'ID
        $id = $data['result']['ID'] ?? "";

        $departementId = $departement->getId();
        $existingIdEduSign = $personnel->getIdEduSign();

        // Supprimer les entrées avec des valeurs nulles
        if ($existingIdEduSign !== null) {
            foreach ($existingIdEduSign as $key => $value) {
                if ($value === null || $value === '') {
                    unset($existingIdEduSign[$key]);
                }
            }
            $personnel->setIdEduSign($existingIdEduSign);
            $this->personnelRepository->save($personnel);
        }
        if ($existingIdEduSign === null || !array_key_exists($departementId, $existingIdEduSign)) {
            $jsonId = [$departementId => $id];

            if ($existingIdEduSign === null) {
                // Si idEduSign est null, le définir comme le nouveau tableau $jsonId
                $personnel->setIdEduSign($jsonId);
            } else {
                // Autrement, ajoute le nouveau tableau $jsonId à l'ancien tableau $existingIdEduSign
                $personnel->setIdEduSign($existingIdEduSign + $jsonId);
            }
        }

        $this->personnelRepository->save($personnel);
    }

    public function getEnseignant(string $cleApi): mixed
    {
        $client = HttpClient::create();

        $response = $client->request('GET', 'https://ext.edusign.fr/v1/professor', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ]
        ]);

        $content = $response->getContent();
        // convertit JSON en tableau associatif PHP
        $data = json_decode($content, true);

        return $data['result'] ?? "";
    }

    public function updateEnseignant(EduSignEnseignant $enseignant, string $cleApi): void
    {
        $client = HttpClient::create();

        $response = $client->request('PATCH', 'https://ext.edusign.fr/v1/professor/', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getCleApi->getCleApi($cleApi),
            ],
            'json' => ['professor' => $enseignant->toArray()],
        ]);
    }

}
