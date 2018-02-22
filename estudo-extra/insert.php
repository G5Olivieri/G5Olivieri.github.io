<?php 
    function insert(Int $id, String $name) {
        $pdo = new PDO('mysql:host=localhost;port=3307;dbname=api', 'root', '');
        $query = "INSERT INTO info VALUES(:id, :name)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":name", $name);
        $stmt->execute();
        $pdo = null;
    }
?>