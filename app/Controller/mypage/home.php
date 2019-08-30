<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\User;


// 会員登録ページコントローラ
$app->get('/mypage/', function (Request $request, Response $response) use($app) {
	
	if(\Model\login\LoginUtil::isNotLogin($this->session)){
		return $response->withRedirect($app->getContainer()->get('router')->pathFor('top'));
	}

    //GETされた内容を取得します。
    $data = $request->getQueryParams();

    // Render index view
    return $this->view->render($response, 'mypage/home.twig', $data);

})
->setName('mypage');
