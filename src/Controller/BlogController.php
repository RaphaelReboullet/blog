<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 12/11/18
 * Time: 13:43
 */

// src/Controller/BlogController.php
namespace App\Controller;

use App\Form\ArticleType;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Request;


class BlogController extends AbstractController
{

    /**
     * Show all row from article's entity
     *
     * @Route("/", name="blog_index")
     * @return Response A response instance
     */
    public function index(Request $request): Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        $article = new Article();
        $articleForm = $this->createForm(
            ArticleType::class,
            $article);
        $articleForm->handleRequest($request);

        if ($articleForm->isSubmitted()) {
            $title = $article->getTitle();
            $content = $article->getContent();
            $category = $article->getCategory();
            $article->setTitle($title);
            $article->setContent($content);
            $article->setCategory($category);



            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('blog_index');
        }


        return $this->render(
            'blog/index.html.twig', [
                'articles' => $articles,
                'articleform' => $articleForm->createView()
            ]
        );
    }


        /**
         * Getting a article with a formatted slug for title
         *
         * @param string $slug The slugger
         *
         * @Route("/article/{slug}",
         *     defaults={"slug" = null},
         *     name="blog_show")
         * @return Response A response instance
         */

   public function show($slug): Response
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
                'No article with ' . $slug . ' title, found in article\'s table.'
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
     * @Route("/categories", name="categories_index")
     * @return Response A response instance
     */

    public function showCategories(Request $request): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll();

        $category = new Category();
        $categoryForm = $this->createForm(
            CategoryType::class,
            $category);
        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted()) {
            $name = $category->getName();
            $category->setName($name);


            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('categories_index');
        }


            return $this->render(
                'blog/indexcategories.html.twig',
                [
                    'categories' => $categories,
                    'categoryform' => $categoryForm->createView()
                ]
            );
    }


    /**
     * @Route("/categories/{categoryName}", name="blog_show_category")
     * @return Response A response instance
     */

    public
    function showByCategory(string $categoryName): Response
    {


        $category = $this->getDoctrine()
            ->getRepository(Category::class)
            ->findOneByName($categoryName);


        $articles = $category->getArticles();;


        return $this->render(
            'blog/category.html.twig',
            [
                'category' => $category,
                'articles' => $articles,
            ]
        );
    }


}