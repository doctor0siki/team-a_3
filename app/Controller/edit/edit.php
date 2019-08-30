<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;


// 会員登録ページコントローラ
$app->get('/edit/{id}', function (Request $request, Response $response) {

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'edit/edit.twig', $data);

});
