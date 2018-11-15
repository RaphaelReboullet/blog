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
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Entity\Category;



class BlogController extends AbstractController
{

    /**
     * Show all row from article's entity
     *
     * @Route("/", name="blog_index")
     * @return Response A response instance
     */
    public function index() : Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig',
            ['articles' => $articles]
        );
    }



    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/{slug}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     *  @return Response A response instance
     */
    public function show($slug) : Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        $category = $article->getCategory();
        $tags = $article->getTags();



        if (!$article) {
            throw $this->createNotFoundException(
                'No article with '.$slug.' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/show.html.twig',
            [
                'article' => $article,
                'slug' => $slug,
                'category' => $category,
                'tags' => $tags
            ]
        );
    }

    /**
     * @Route("/category/{categoryName}", name="blog_show_category")
     * @return Response A response instance
     */

    public function showByCategory(string $categoryName) : Response
    {


        $category=$this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneByName($categoryName);

        $articles=$category->getArticles();
            ;


        return $this->render(
            'blog/category.html.twig',
            [
                'category' => $category,
                'articles' => $articles,
            ]
        );
    }


}