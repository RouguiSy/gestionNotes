<?php

function getUtilisateurByEmail(string $email) : array {
    $pdo = connexionDB();
    $sql = "SELECT u.id, u.nom, u.prenom, u.email, u.password, r.nomrole
            FROM utilisateurs u
            INNER JOIN roles r ON u.role_id = r.id
            WHERE u.email = :email";
    $utilisateur = executeQuery($pdo, $sql, ['email' => $email], true);
    $pdo = null;
    return $utilisateur;
}