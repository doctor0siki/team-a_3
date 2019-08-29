<?php
use Slim\Http\Request;
use Slim\Http\Response;

/*
 * アップロード画面初期表示
 */
$app->get('/upload/', function (Response $response) {
	$data = [];

	return $this->view->render($response, 'upload/index.twig', $data);
});

/*
 * 動画アップロードの受け口。
 * postされたファイルを全て保存する
 * 動画かどうかは見ていないので必要なら足して。
 */
$app->post('/upload/', function (Request $request, Response $response) {
	$data = [];
	
	$uploadedFileModel = new \Model\UploadFileModel($request->getUploadedFiles());
	
	$data['file_name_list'] = $uploadedFileModel->write();
	
	return $this->view->render($response, 'upload/index.twig', $data);
});