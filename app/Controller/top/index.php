<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Video;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

    $video = new Video($this->db);
    $data["list"] = $video->getVideoList();

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
})
->setName('top');
