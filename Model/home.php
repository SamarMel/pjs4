<?php
/**
 * @param $id
 * @return null
 */
function getArticle($id) {
    require (dirname(__FILE__) . '/database.php');
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