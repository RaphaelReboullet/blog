<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 15/11/18
 * Time: 10:16
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Tag;

class TagController extends  AbstractController{

    /**
     * @Route("/tags", name="tags_index")
     * @return Response A response instance
     */

    public function showTags(){
        $tags = $this->getDoctrine()
            ->getRepository(Tag::class)
            ->findAll();

        return $this->render(
            'blog/indextag.html.twig',
            [
                'tags' => $tags,
            ]
        );
    }

    /**
     * @Route("/tags/{name}", name="articles_by_tags")
     * @return Response A response instance
     */

    public function showArticlesByTag($name){

        $tag = $this->getDoctrine()
            ->getRepository(Tag::class)
            ->findOneByName($name);



        $articles = $tag->getArticles();





        return $this->render(
            'blog/tag.html.twig',
            [
                'tag' => $tag,
                'articles' => $articles
            ]
        );
    }
}