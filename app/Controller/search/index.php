<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/result', function (Request $request, Response $response) {

    $data = [];
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'top/index.twig', $data);
});
