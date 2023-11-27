<?php

// On configure la base de données
$serveur = "localhost";
$user = "root";
$password = "";
$bdd = "forum";

// On se connecte à la base de données
$con = new PDO("mysql:host=" . $serveur . ';dbname=' . $bdd, $user, $password);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// On va récupérer les données de la base de données pour créer les sujets
$req = 'SELECT * FROM sujet';
$res = $con->query($req);
$lignes = $res->fetchAll(PDO::FETCH_ASSOC);

// On arrête la connexion à la base de données
$con = null;

?>