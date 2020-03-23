<?php

/**
 * @return array|null
 */
function getRecentArticles() {
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "SELECT * FROM Article ORDER BY datePubli DESC";
        $query = $database->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = array_slice($result, 0, 4);
        return $result;
    } catch(PDOException $e) {
        return null;
    }
}

/**
 * @param $id
 * @return null
 */
function getArticle($id) {
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "SELECT * FROM Article WHERE id = :id";
        $query = $database->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return null;
    }
}