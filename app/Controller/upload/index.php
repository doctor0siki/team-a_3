<?php

use Model\Dao\Artist;
use Model\Dao\Music;
use Model\Dao\Video;
use Model\file\UploadLogic;
use Slim\Http\Request;
use Slim\Http\Response;

/*
 * アップロード画面初期表示
 */
$app->get('/upload/', function (Request $request, Response $response) {
	$data = [];

	return $this->view->render($response, 'upload/index.twig', $data);
})
->setName('upload_init');

/*
 * 動画アップロードの受け口。
 * postされたファイルを全て保存する
 * 動画かどうかは見ていないので必要なら足して。
 */
$app->post('/upload/', function (Request $request, Response $response) {
	$data = [];
	
	// todo 残りのDAO作らないとね
	$data['file_name_list'] = (new UploadLogic(
		new Video($this->db),
		new Music($this->db),
		new Artist($this->db),
		null,
		null
	))->register($request->getUploadedFiles());
	
	return $this->view->render($response, 'upload/index.twig', $data);
})
->setName('upload_post');