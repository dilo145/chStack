<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/api/get-categories', name: 'categories_show', methods: ['GET'])]
    public function getAll(CategoriesRepository $CategoriesRepository): Response
    {
        $categories = $CategoriesRepository->findAll();

        return $this->json($categories);
    }

    #[Route('/api/get-category/{id}', name: 'category_shows', methods: ['GET'])]
    public function getOne(CategoriesRepository $CategoriesRepository, int $id): Response
    {
        $category = $CategoriesRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException('Category not found');
        }

        return $this->json($category);
    }

    // #[Route('/api/create-category', name: 'category_create', methods: ['POST'])]
    // public function create(Request $request,  CategoriesRepository $CategoriesRepository,): Response
    // {
    //     $data = json_decode($request->getContent(), true);
        
    //     $response = $CategoriesRepository->create($data);

    //     if (!$response) {
    //         throw $this->createNotFoundException('Error while creating lesson');
    //     }

    //     return $this->json($response);
    // }

    // #[Route('/api/update-category/{id}', name: 'category_update', methods: ['PUT'])]
    // public function update(Request $request, CategoriesRepository $CategoriesRepository, int $id): Response
    // {
    //     $data = json_decode($request->getContent(), true);
        
    //     $response = $CategoriesRepository->update($data, $id);

    //     if (!$response) {
    //         throw $this->createNotFoundException('Error while updating lesson');
    //     }

    //     return $this->json($response);
    // }

    // #[Route('/api/delete-category/{id}', name: 'category_delete', methods: ['DELETE'])]
    // public function delete(CategoriesRepository $CategoriesRepository, int $id): Response
    // {
    //     if ($id === null) {
    //         throw $this->createNotFoundException('Id is required');
    //     }

    //     $category = $CategoriesRepository->delete($id);

    //     if (!$category) {
    //         throw $this->createNotFoundException('Category not found');
    //     }

    //     return $this->json($category);
    // }
}
