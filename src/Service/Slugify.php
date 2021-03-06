<?php
/**
 * Created by PhpStorm.
 * User: raphael
 * Date: 23/11/18
 * Time: 10:20
 */

namespace App\Service;


class Slugify
{
 public function generate(string $input) : string
 {
     $input = trim($input);
     $input = str_replace(' ', '-', $input);
     $input = str_replace(
         array('à','á','â','ã','ä', 'ç', 'è','é','ê','ë', 'ì','í','î','ï', 'ñ', 'ò','ó','ô','õ','ö', 'ù','ú','û','ü',
             'ý','ÿ', 'À','Á','Â','Ã','Ä', 'Ç', 'È','É','Ê','Ë', 'Ì','Í','Î','Ï', 'Ñ', 'Ò','Ó','Ô','Õ','Ö', 'Ù','Ú','Û','Ü', 'Ý'),
         array('a','a','a','a','a', 'c', 'e','e','e','e', 'i','i','i','i', 'n', 'o','o','o','o','o', 'u','u','u','u',
             'y','y', 'A','A','A','A','A', 'C', 'E','E','E','E', 'I','I','I','I', 'N', 'O','O','O','O','O', 'U','U','U','U', 'Y'),
         $input);
     $input = str_replace(array('!', '\'', '"', '.', ','), '', $input);
     $input = preg_replace('/(-+)/', '-', $input);
     $input = strtolower($input);

     return $input;
 }
}