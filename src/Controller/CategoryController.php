<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\CategoryService;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\Category;
use App\Form\CategoryType;

class CategoryController extends AbstractController
{
    public function __construct(
        private CategoryService $categoryService
    )  {}

    #[Route(path:'/categories', name: 'app_categories')]
    #[IsGranted('ROLE_USER', message:'Vous n\'êtes pas autorisé  à accéder à la page')]
    public function showAllCategories(): Response
    {
        //Récupération de toutes les catégories de la BDD
        $categories = $this->categoryService->getCategories();

        return $this->render('category/show_all_categories.html.twig',[
            'categories' => $categories
        ]);
    }

    #[Route(path:'/category/new', name:'app_category_new', methods:["GET", "POST"])]
    #[IsGranted('ROLE_USER', message:'Vous n\'est pas autorisé')]
    public function new(Request $request):Response 
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            //ajouter avec le CategoryService::saevCategory
            $msg = $this->categoryService->saveCategory($category);

            $this->addFlash('notice', $msg);

            return $this->redirectToRoute('app_category_new');
        }

        return $this->render('category/category_new.html.twig', [
            'form'=> $form
        ]);
    }

    #[Route(path:'/categories/{id}/edit', name:'app_categories_edit', methods:["GET", "POST"])]
    #[IsGranted('ROLE_USER', message:'Vous n\'est pas autorisé')]
    public function edit(Request $request, int $id):Response
    {
        $category = $this->categoryService->getCategoryById($id);

        if (!$category){
            throw $this->createNotFoundException('La catégorie n\'existe pas');
        }

        $form = $this->createForm(CategoryType::class, $category);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $msg = $this->categoryService->editCategory($category);
            $this->addFlash('notice', $msg);

            return $this->redirectToRoute('app_category_new');
        }

        return $this->render('category/category_new.html.twig', [
            'form'=> $form
        ]);
    }

}
