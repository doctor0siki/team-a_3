<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Video;

// 投稿ページのコントローラ
$app->get('/post_video', function (Request $request, Response $response) use($app) {

	if(\Model\login\LoginUtil::isNotLogin($this->session)){
		return $response->withRedirect($app->getContainer()->get('router')->pathFor('top'));
	}

    $data = [];

    // Render index view
    return $this->view->render($response, 'postVideo/index.twig', $data);
})
->setName('post_video');

$app->post('/post_video/upload', function (Request $request, Response $response) use($app) {

	if(\Model\login\LoginUtil::isNotLogin($this->session)){
		return $response->withRedirect($app->getContainer()->get('router')->pathFor('top'));
	}

    $session = $this->session["user_info"];
    $body = $request->getParsedBody();
    $file = $request->getUploadedFiles();
    $video = new Video($this->db);
    $video->create($session, $body, $file);

    return $response->withRedirect('/edit');
})->setName("upload");
