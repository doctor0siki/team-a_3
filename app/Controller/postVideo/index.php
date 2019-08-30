<?php

use Slim\Http\Request;
use Slim\Http\Response;

// 投稿ページのコントローラ
$app->get('/post_video', function (Request $request, Response $response) {

    $data = [];

    // Render index view
    return $this->view->render($response, 'postVideo/index.twig', $data);
});

