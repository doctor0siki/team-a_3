<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/play', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'play/index.twig', $data);
});
