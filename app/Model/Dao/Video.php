<?php

namespace Model\Dao;

/**
 * Class Video
 *
 * Videoテーブルを扱う Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 */
class Video extends Dao
{
    /**
     * getVideoList Function
     *
     * Videoテーブルの全データ取得。
     *
     */
    public function getVideoList()
    {

        //全件取得するクエリを作成
        $sql = "select * from video";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        //SQLを実行
        $statement->execute();

        //結果レコードを全件取得し、返送
        return $statement->fetchAll();

    }
}
