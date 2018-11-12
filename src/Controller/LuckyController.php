<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 12/11/18
 * Time: 11:07
 */



namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class LuckyController extends AbstractController


{
    /**
     * @Route("/lucky/number")
     */

    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }
}