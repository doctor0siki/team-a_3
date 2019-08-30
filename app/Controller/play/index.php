<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Model\Dao\Video;
use Model\Dao\Explanation;

// TOPページのコントローラ
$app->get('/play/{id}', function (Request $request, Response $response, $args) {

    $data = [];

    $video_id = $args["id"];
    $video_params["id"] = $video_id;

    $explanation_params["video_id"] = $video_id;

    $video = new Video($this->db);
    $video_explanation = new Explanation($this->db);

    $video_data = $video->select($video_params, "", "", 1, false);
    $video_explanation_data = $video_explanation->select($explanation_params, "time", "ASC", 999, true);

    // dd($video_explanation_data);
    $data['video'] = $video_data;
    $data['explanation_shout'] = array_filter($video_explanation_data,function($input){
        return $input['type'] === "1";
    });
    $data['explanation_hand_wave'] = array_filter($video_explanation_data,function($input){
        return $input['type'] === "2";
    });

    // dd($data);

    // Render index view
    return $this->view->render($response, 'play/index.twig', $data);
});
