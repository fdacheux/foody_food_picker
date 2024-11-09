<?php

namespace App\Controller\Admin;

use App\Entity\Food;
use App\Form\FoodType;
use App\Repository\FoodRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdminFoodController extends AbstractController
{
    // #[Route('/admin/phpInfo', name: 'php_info')]
    // public function phpInfo(): Response
    // {
    //    return new Response('<html><body>'. phpinfo() . '</body></html>');
    // }

    #[Route('/admin/food', name: 'admin_food')]
    #[Route('/admin/food/deleted', name: 'admin_food_deleted')]
    public function index(FoodRepository $repository): Response
    {
        $foodList = $repository->findAll();
        return $this->render('admin/admin_food/adminFood.html.twig', [
            'foodList' => $foodList,
        ]);
    }
    #[Route('/admin/food/creation', name: 'admin_food_creation')]
    #[Route('/admin/food/{id}', name: 'admin_food_modifications', methods:"GET|POST")]
    public function creationAndModifications(Food $food = null, Request $request, EntityManager $entityManager): Response
    {
        if(!$food){
            $food = new Food();
        }
        $foodForm = $this->createForm(FoodType::class, $food);
        $foodForm->handleRequest($request);

        if($foodForm->isSubmitted() && $foodForm->isValid()){
            $edit = $food->getId() !== null;
            $entityManager->persist($food);
            $entityManager->flush();
            $this->addFlash('success', ($edit) ? 'Successfully modified' : 'Successfully created');
            return $this->redirectToRoute('admin_food');
        }
        return $this->render('admin/admin_food/foodModificationsAndCreation.html.twig', [
            'foodItem' => $food,
            'foodForm' => $foodForm,
            'isModification' => $food->getId() !== null
        ]);
    }
    
    #[Route('/admin/food/{id}', name: 'admin_food_deletion', methods:"deletion")]
    public function deleteFood(Food $food, Request $request, EntityManager $entityManager): Response
    {
        
            if($this->isCsrfTokenValid('SUP'.$food->getId(), $request->get('_token')))
            $entityManager->remove($food);
            $entityManager->flush();
            
            $this->addFlash('success', 'Successfully deleted');
            return $this->redirectToRoute('admin_food');
        
    }
}
