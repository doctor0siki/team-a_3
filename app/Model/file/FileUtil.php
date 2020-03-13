<?php

namespace Model\file;

use Slim\Http\UploadedFile;

class FileUtil {
	
	//TODO あんまよくない
	const SAVE_PATH = '/../../../public/assets/videos';
	
	/**
	 * ファイルを書き込む。
	 * 書き込み先はここ{@see UploadFileModel::SAVE_PATH}
	 * @param $file
	 *
	 * @return array
	 */
	public static function write($file){
		return self::writeAll([$file])[0];
	}
	
	/**
	 * ファイルを書き込む。
	 * 書き込み先はここ{@see UploadFileModel::SAVE_PATH}
	 *
	 * @param array $files
	 *
	 * @return array 書き込んだファイルの名前一覧。
	 */
	public static function writeAll(array $files){
		$executed_filename_list = array();
		foreach ($files as $file){
			$executed_filename_list[] = self::moveUploadedFile(__DIR__.self::SAVE_PATH, $file);
		}
		return $executed_filename_list;
	}
	
	private static function moveUploadedFile($directory, UploadedFile $uploadedFile)
	{
		$extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
		$basename = bin2hex(random_bytes(8)); // see http://php.net/manual/en/function.random-bytes.php
		$filename = sprintf('%s.%0.8s', $basename, $extension);

		$uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);

		return $filename;
	}
}