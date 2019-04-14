<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CountWordsController
{
    /**
     * 
     * @Route("api/countwords/{texte}", name="countwords", methods={"GET","HEAD"})
     */

    public function getCountWord( Request $request) {

        $request = $request->get('texte') ? $request->get('texte') : null;
        $json_array = array(
            'sentence' => $request
        );
        $array_clean = [];

        $json_array_explode = explode(" ", $json_array["sentence"]);
        $element_to_replace = ["(",")"];
        $json_array_replace =  str_replace($element_to_replace,' ',$json_array_explode);

        foreach ($json_array_replace as $value ) {
            array_push($array_clean, trim($value));
        }
        $json_array_correct =  array_count_values($array_clean) ;

        $response = new JsonResponse();

        $response->headers->set('Access-Control-Allow-Origin', '*');

        $json_array_correct = json_encode( $json_array_correct) ;
        $response->setContent($json_array_correct);

        return  $response;

    }


}