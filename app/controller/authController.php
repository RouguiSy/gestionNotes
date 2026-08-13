<?php
require_once dirname(__DIR__).'/config/database.php';
require_once dirname(__DIR__).'/model/utilisateurModel.php';

function login(){
    $erreurConnexion = false;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $utilisateur = getUtilisateurByEmail($email);

        if (!empty($utilisateur) && $password === $utilisateur['password']) {
            set_session('user_id', $utilisateur['id']);
            set_session('user_nom', $utilisateur['nom']);
            set_session('user_prenom', $utilisateur['prenom']);
            set_session('user_role', $utilisateur['nomrole']);

            header('Location: /notes/saisie');
            exit;
        }
        $erreurConnexion = true;
    }

    require_once dirname(__DIR__).'/view/login.html.php';
}

function logout(){
    init_session();
    destroy_session();
    header('Location: /login');
    exit;
}