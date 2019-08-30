<?php

namespace Model\file;

use Slim\Http\UploadedFile;

class FileUtil {
	
	//TODO あんまよくない
	const SAVE_PATH = '/../../../public/assets/videos';
	
	private $files;

	/**
	 * UploadFileModel constructor.
	 *
	 * @param array $files
	 */
	public function __construct(array $files) {
		$this ->files = $files;
	}

	/**
	 * 保持しているファイルを書き込む。
	 * 書き込み先はここ{@see UploadFileModel::SAVE_PATH}
	 * 
	 * @return array 書き込んだファイルの名前一覧。
	 */
	public function write(){
		$executed_filename_list = array();
		foreach ($this->files as $file){
			$executed_filename_list[] = $this->moveUploadedFile(__DIR__.self::SAVE_PATH, $file);
		}
		return $executed_filename_list;
	}
	
	private function moveUploadedFile($directory, UploadedFile $uploadedFile)
	{
		$extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
		$basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
		$filename = sprintf('%s.%0.8s', $basename, $extension);

		$uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

		return $filename;
	}
}