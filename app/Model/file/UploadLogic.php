<?php

namespace Model\file;

class UploadLogic {

	private $video_dao;
	private $music_dao;
	private $artist_dao;
	private $explanation_dao;

	/**
	 * UploadLogic constructor.
	 *
	 * @param $video_dao \Model\Dao\Video
	 * @param $music_dao \Model\Dao\Music
	 * @param $artist_dao \Model\Dao\Artist
	 * @param $explanation_dao \Model\Dao\Explanation
	 */
	public function __construct(
		$video_dao,
		$music_dao,
		$artist_dao,
		$explanation_dao
	) {
		$this->video_dao       = $video_dao;
		$this->music_dao       = $music_dao;
		$this->artist_dao      = $artist_dao;
		$this->explanation_dao = $explanation_dao;
	}


	/**
	 * アップロードされた動画を登録する。
	 *
	 * @param array $param 本当はDTOにする方が良いけど、ハッカソンなのでまあ。
	 * 'upload_data'
	 *   => base
	 *      => user_id => ユーザID
	 *      => artist_id => アーティストID
	 *      => music_id => 音楽ID
	 *      => description => 説明
	 *   => files
	 *      => リストインデックス
	 *         => ファイルデータ
	 *   => explanations
	 *      => リストインデックス
	 *         => time => 時間
	 *         => text => 解説
	 *         => type => 応援なのか振り付けなのか
	 *
	 *
	 * @return array 登録結果リスト。ファイル名とビデオIDが入っている。構造は以下のような感じ。
	 * 'uploaded'
	 *   => リストインデックス
	 *      => 'file_name' => value
	 *      => 'video_id' => value
	 * @throws \Exception
	 */
	public function register( array $param ) {
		$result = [ 'uploaded' => [] ];
		foreach ( $param['files'] as $file ) {
			// 今回は動画ファイルをサーバ上に置いとく
			$file_name = FileUtil::write( $file );
			$insert_data = $param['base'];
			// todo フルパスにする？
			$insert_data['path'] = $file_name;
			$video_id  = $this->video_dao->insert( $insert_data );
			if ( $video_id ) {
				$this->registerExplanation( $param );
				$result['uploaded'][]['file_name'] = $file_name;
				$result['uploaded'][]['video_id']  = $video_id;
			} else {
				throw new \Exception( '投稿に失敗しました。' );
			}
		}

		return $result;
	}

	private function registerExplanation( array $param ) {
		foreach ( $param['explanations'] as $explanation ) {
			$this->explanation_dao->insert( $explanation );
		}
	}
}