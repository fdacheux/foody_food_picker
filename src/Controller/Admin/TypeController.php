<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\CategoryType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TypeController extends AbstractController
{
    #[Route('/admin/type', name: 'admin_types')]
    public function index(TypeRepository $repository): Response
    {
        $types = $repository->findAll();
        return $this->render('admin/type/adminType.html.twig', [
            'types' => $types
        ]);
    }

    #[Route('/admin/type/creation', name: 'add_type')]
    #[Route('/admin/type/{id}', name: 'edit_type', methods:"GET|POST")]
    public function addAndEdit(Type $type = null, Request $request, EntityManager $entityManager): Response
    {
        if(!$type){
            $type = new Type();
        }
        $form = $this->createForm(CategoryType::class, $type);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $edit = $type->getId() !== null;
            $entityManager->persist($type);
            $entityManager->flush();
            $this->addFlash('success', ($edit) ? 'Successfully modified' : 'Successfully created');
            return $this->redirectToRoute('admin_types');
        }
        return $this->render('admin/type/addAndEdit.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
            'isModification' => $type->getId() !== null
        ]);
    }
    
    #[Route('/admin/type/{id}', name: 'delete_type', methods:"deletion")]
    public function deleteType(Type $type, Request $request, EntityManager $entityManager): Response
    {
        
            if($this->isCsrfTokenValid('SUP'.$type->getId(), $request->get('_token')))
            $entityManager->remove($type);
            $entityManager->flush();
            
            $this->addFlash('success', 'Successfully deleted');
            return $this->redirectToRoute('admin_types');
        
    }


}
