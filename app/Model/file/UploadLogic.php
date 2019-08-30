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
		$this->video_dao  = $video_dao;
		$this->music_dao  = $music_dao;
		$this->artist_dao = $artist_dao;
		$this->explanation_dao  = $explanation_dao;
	}


	/**
	 * アップロードされた動画を登録する。
	 *
	 * @param array $param 本当はDTOにする方が良いけど、ハッカソンなのでまあ。
	 *
	 * @return array 登録結果リスト。ファイル名とビデオIDが入っている。構造は以下のような感じ。
	 * 'uploaded'
	 *   => 0
	 *      => 'file_name' => value
	 *      => 'video_id' => value
	 *   => 1
	 *      => 'file_name' => value
	 *      => 'video_id' => value
	 * @throws \Exception
	 */
	public function register( array $param ) {
		$result = ['uploaded' => []];
		foreach ( $param['files'] as $file ) {
			// 今回は動画ファイルをサーバ上に置いとく
			$file_name = FileUtil::write( $file );
			$video_id  = $this->video_dao->insert( [] );
			if ( $video_id ) {
				$this->music_dao->insert( [] );
				$this->artist_dao->insert( [] );
				$this->explanation_dao->insert([]);
				$result['uploaded'][]['file_name'] = $file_name;
				$result['uploaded'][]['video_id'] = $video_id;
			} else {
				throw new \Exception( '投稿に失敗しました。' );
			}
		}
		return $result;
	}
}