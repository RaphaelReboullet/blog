<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 12/11/18
 * Time: 11:51
 */

namespace App\Controller;

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController
{

    /**
     * @Route("/",name="homepage")
     */

    public function index()
    {
        return $this->render('home/home.html.twig');
    }

}