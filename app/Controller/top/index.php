<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/', function (Request $request, Response $response) {

    $data = [];
    $data['video_id'] = "0";
    $data['user_id'] = "0";

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});
