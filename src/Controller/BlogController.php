<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 12/11/18
 * Time: 13:43
 */

// src/Controller/BlogController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog/{slug}", requirements={"slug"="[0-9a-z-]+"}, name="blog_list")
     */

    public function show($slug = 'Article Sans Titre')
    {
        if (isset($slug)){
        $tiret = '-';
        $space = ' ';
        $slug = ucwords($slug);
        $slug = str_replace($tiret, $space, $slug);
        }

        return $this->render('blog/index.html.twig', ['slug' => $slug]);
    }
}