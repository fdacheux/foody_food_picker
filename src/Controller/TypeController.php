<?php

namespace App\Controller;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TypeController extends AbstractController
{
    #[Route('/types', name: 'types_list')]
    public function index(TypeRepository $repository): Response
    {
        $types = $repository->findAll();
        return $this->render('type/types.html.twig', [
            'types' => $types,
        ]);
    }
}
