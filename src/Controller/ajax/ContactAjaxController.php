<?php
/*
 * Copyright (c) 2022. | David Annebicque | IUT de Troyes  - All Rights Reserved
 * @file /Users/davidannebicque/Sites/intranetV3/src/Controller/ajax/ContactAjaxController.php
 * @author davidannebicque
 * @project intranetV3
 * @lastUpdate 18/05/2022 16:44
 */

namespace App\Controller\ajax;

use App\Classes\MyContact;
use App\Controller\BaseController;
use App\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AbsenceApiController.
 */
#[Route(path: '/ajax/contact')]
#[IsGranted('ROLE_PERMANENT')]
class ContactAjaxController extends BaseController
{
    #[Route(path: '/edit/{id}', name: 'contact_ajax_edit', options: ['expose' => true])]
    public function edit(MyContact $myContact, Request $request, Contact $contact): JsonResponse
    {
        $name = $request->request->get('field');
        $value = $request->request->get('value');
        if (null !== $name && '' !== $name) {
            $update = $myContact->update($contact, $name, $value);
        } else {
            $update = false;
        }

        return $update ? new JsonResponse('', Response::HTTP_OK) : new JsonResponse('erreur',
            Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
