<?php

require_once("./phpQuery-onefile.php");
$count = 0;

for ($i = 1; $i <= 5; $i++) {
    $html = file_get_contents("http://j-lyric.net/artist/p{$i}.html");
    $doc = phpQuery::newDocument($html);

    foreach ($doc[".bdy"] as $body) {
        $count++;
        $artist = pq($body)->find(".mid")->find("a")->text();
        $artistList[] = ["name" => $artist];
        $music = explode("\n", rtrim(pq($body)->find(".sml")->find("a")->text(), "\n"));
        foreach ($music as $value) {
            $musicList[] = ["artist_id" => $count, "name" => $value];
        }
    }
}

try {
    $pdo = new PDO('mysql:host=192.168.0.19;dbname=team-a;charset=utf8','team-a','team-a!');
    $stmtArtist = $pdo->prepare("INSERT INTO artist (id, name) VALUES (:id, :name)");
    $count = 0;
    foreach ($artistList as $value) {
        $stmtArtist->bindValue(":id", ++$count, PDO::PARAM_INT);
        $stmtArtist->bindParam(":name", $value["name"], PDO::PARAM_STR);
        $stmtArtist->execute();
    }

    $stmtMusic = $pdo->prepare("INSERT INTO music (id, artist_id, name) VALUES (:id, :artist_id, :name)");
    $count = 0;
    foreach ($musicList as $value) {
        $stmtMusic->bindValue(":id", ++$count, PDO::PARAM_INT);
        $stmtMusic->bindValue(":artist_id", $value["artist_id"], PDO::PARAM_INT);
        $stmtMusic->bindParam(":name", $value["name"], PDO::PARAM_STR);
        $stmtMusic->execute();
    }

    echo "insert成功";
} catch (PDOException $e) {
    echo 'データベース接続失敗。'.$e->getMessage();
}
