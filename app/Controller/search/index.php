<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Video;

// TOPページのコントローラ
$app->get('/result', function (Request $request, Response $response) {

    $query = $request->getQueryParams();
    $video = new Video($this->db);
    $data["list"] = $video->search($query["search"]);

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
})->setName('result');
