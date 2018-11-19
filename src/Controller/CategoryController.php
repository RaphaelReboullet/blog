<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 19/11/18
 * Time: 10:07
 */

namespace App\Controller;

use App\Form\ArticleType;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;

class CategoryController extends AbstractController

{
     /**
      * @Route("/category/{id}", name="category_show")
      */
    public function show(Category $category) :Response
    {
        return $this->render('blog/categorybyid.html.twig', ['category'=>$category]);
    }

}