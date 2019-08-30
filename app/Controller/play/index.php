<?php

use Slim\Http\Request;
use Slim\Http\Response;

// TOPページのコントローラ
$app->get('/play/{id}', function (Request $request, Response $response) {

    $data = [];
    $data['discription']='アーティスト：初音ミク
    タイトル：千本桜

    ポイント：手を大きく前にあげて．．．';

    // Render index view
    return $this->view->render($response, 'play/index.twig', $data);
});
