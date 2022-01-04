<?php
/*
 * Copyright (c) 2021. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/htdocs/intranetV3/src/MessageHandler/ExportPdfEdtHandler.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 08/10/2021 19:44
 */

namespace App\MessageHandler;

use App\Classes\Configuration;
use App\Classes\Edt\MyEdtExport;
use App\Message\ExportPdfEdt;
use App\Repository\DepartementRepository;
use App\Repository\PersonnelRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class ExportPdfEdtHandler implements MessageHandlerInterface
{
    private PersonnelRepository $personnelRepository;
    private MailerInterface $mailer;

    private MyEdtExport $myEdtExport;

    private DepartementRepository $departementRepository;

    private Configuration $configuration;

    /**
     * ExportReleveHandler constructor.
     */
    public function __construct(
        Configuration $configuration,
        MyEdtExport $myEdtExport,
        DepartementRepository $departementRepository,
        MailerInterface $mailer,
        PersonnelRepository $personnelRepository
    ) {
        $this->myEdtExport = $myEdtExport;
        $this->personnelRepository = $personnelRepository;
        $this->departementRepository = $departementRepository;
        $this->mailer = $mailer;
        $this->configuration = $configuration;
    }

    public function __invoke(ExportPdfEdt $exportPdfEdt)
    {
        $departement = $this->departementRepository->find($exportPdfEdt->getDepartement());
        $personnel = $this->personnelRepository->find($exportPdfEdt->getPersonnel());

        if (null !== $departement && null !== $personnel) {
            foreach ($exportPdfEdt->getPersonnels() as $idPersonnel) {
                $pers = $this->personnelRepository->find($idPersonnel);
                if (null !== $pers) {
                    $this->myEdtExport->generePdf($pers, 'intranet', $departement);
                }
            }
            $this->myEdtExport->compressDir($departement);

            $mail = (new TemplatedEmail())
                ->from($this->configuration->get('MAIL_FROM'))
                ->to($personnel->getMailUniv())
                ->subject('Documents prêts')

                // path of the Twig template to render
                ->htmlTemplate('mails/documents_prets.html.twig')

                // pass variables (name => value) to the template
                    //todo: a finir pour les expors des PDF des EDT sur le principes des notes avec RabbitMq...
                ->context([
                    'semestre' => $semestre,
                    'personnel' => $personnel,
                    'lien' => $lien,
                ]);

            $this->mailer->send($mail);
        }
    }
}
