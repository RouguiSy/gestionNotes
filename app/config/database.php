<?php
function connexionDB() : PDO {
    $user = 'postgres';
    $password = 'passer123';
    static $db = null;
    if ($db == null) {
        $db = new PDO("pgsql:host=localhost;dbname=ges_note", $user, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        
        if(!$db) {
            throw new Exception("Erreur de connexion à la base de données", 1);
        }
    }
    return $db;
}

function query(PDO $pdo, string $sql, bool $single = false) : array {
    $query = $pdo->query($sql);
    return $single ? $query->fetch() : $query->fetchAll();
}

function prepareExecute(PDO $pdo, string $sql, array $data = []) : PDOStatement {
    $prepare = $pdo->prepare($sql);
    $prepare->execute($data);
    return $prepare;
}

// function executeQuery(PDO $pdo, string $sql, array $data = [], bool $single = false) : array {
//     $statement = prepareExecute($pdo, $sql, $data);
//     return $single ? $statement->fetch() : $statement->fetchAll();
// }

function executeQuery(PDO $pdo, string $sql, array $data = [], bool $single = false) : array {
    $statement = prepareExecute($pdo, $sql, $data);
    if ($single) {
        $result = $statement->fetch();
        return $result === false ? [] : $result;
    }
    return $statement->fetchAll();
}

function executeUpdate(PDO $pdo, string $sql, array $data = []) : int {
    $statement = prepareExecute($pdo, $sql, $data);
    if (str_starts_with(strtoupper(trim($sql)), 'INSERT')) {
        return (int)$pdo->lastInsertId();
    }
    return $statement->rowCount();
}

function getAllTable(string $table) : array {
    $pdo = connexionDB();
    $sql = "SELECT * FROM $table";
    $query = query($pdo, $sql, false);  
    $pdo = null;
    return $query;
}
?>