<?php

namespace Model\Dao;

use Model\Dao\Artist;
use Model\Dao\Music;

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
        $sql = $sql = "select v.id as id, m.name as music_name, a.name as artist_name, u.name as user_name, v.path as path, v.description as description "
            ."from video v "
            ."inner join music m on v.music_id = m.id "
            ."inner join artist a on v.artist_id = a.id "
            ."inner join user u on v.user_id = u.id";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        //SQLを実行
        $statement->execute();

        //結果レコードを全件取得し、返送
        return $statement->fetchAll();

    }

    /**
     *
     */
    public function search($query)
    {

        $sql = "select artist.id as artist_id, music.id as music_id, artist.name as artist, music.name as music from artist, music where artist.id = music.artist_id";
        $statement = $this->db->prepare($sql);
        $statement->execute();
        $list = $statement->fetchAll();

        $matchList = [];
        foreach ($list as $item) {
            if (strstr($item["artist"], $query) !== false || strstr($item["music"], $query) !== false) {
                $matchList[] = $item["music_id"];
            }
        }

        $matchStr = implode(", ", $matchList);
        $sql = "select v.id as id, m.name as music_name, a.name as artist_name, u.name as user_name, v.path as path, v.description as description "
            ."from video v "
            ."inner join music m on v.music_id = m.id "
            ."inner join artist a on v.artist_id = a.id "
            ."inner join user u on v.user_id = u.id "
            ."where v.music_id in ({$matchStr})";
        $statement = $this->db->prepare($sql);
        $statement->execute();

        return $statement->fetchAll();

    }
}
