<?php

namespace App\Controller;

use App\Repository\CategoriesRepository; // Gebruik de correcte repository
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="categories", methods={"GET"})
     */
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        // Haal alle categorieën op uit de database
        $categories = $categoriesRepository->findAll();

        // Render de Twig-template en geef de variabele `categories` mee
        return $this->render('categories.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_detail", methods={"GET"})
     */
    public function detail(int $id, CategoriesRepository $categoriesRepository): Response
    {
        // Haal een specifieke categorie op met het id
        $category = $categoriesRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException('De opgevraagde categorie bestaat niet.');
        }

        // Render de detailpagina en geef de categorie mee
        return $this->render('category_detail.html.twig', [
            'category' => $category,
        ]);
    }
}