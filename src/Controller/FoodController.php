<?php

namespace App\Controller;

use App\Repository\FoodRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FoodController extends AbstractController
{
    #[Route('/', name: 'food_list')]
    public function index(FoodRepository $repository): Response
    {
        $foodList = $repository->findAll();
        return $this->render('food/foodList.html.twig', [
            'foodList' => $foodList,
            'isCalories'=> false,
            'isCarbohydrates'=> false
        ]);
    }

    #[Route('/food/calories/{calories}', name: 'food_by_calories')]
    public function displayFoodByCalories(FoodRepository $repository, $calories): Response
    {
        $foodList = $repository->getAlimentByProperties('calories', '<',$calories);
        return $this->render('food/foodList.html.twig', [
            'foodList' => $foodList,
            'isCalories'=> true,
            'isCarbohydrates'=> false
        ]);
    }
    #[Route('/food/carbohydrates/{carbohydrates}', name: 'food_by_carbohydrates')]
    public function displayFoodByCarbohydrates(FoodRepository $repository, $carbohydrates): Response
    {
        $foodList = $repository->getAlimentByProperties('carbohydrates', '<', $carbohydrates);
        return $this->render('food/foodList.html.twig', [
            'foodList' => $foodList,
            'isCalories'=> false,
            'isCarbohydrates'=> true
        ]);
    }
}
