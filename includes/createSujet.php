<?php

// On configure la base de données
$serveur = "localhost";
$user = "root";
$password = "";
$bdd = "forum";

// On se connecte à la base de données
$con = new PDO("mysql:host=" . $serveur . ';dbname=' . $bdd, $user, $password);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// On vérifie les données rentrées par l'utilisateur
$title = valid_donnees($_POST['titre']);
$message = valid_donnees($_POST['message']);

// Fonction pour vérifier les données
function valid_donnees($donnees)
{
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

// On s'assure que les champs ne soient pas vides
if (!empty($title) && !empty($message)) {
    try {
        // On récupère l'heure et la date de connexion
        $date = new DateTime("now", new DateTimeZone("Europe/Paris"));
        $dateString = $date->format("d/m/Y - H:i");

        // On insère les données dans la base de données
        $req = $con->prepare('INSERT INTO sujet(nom_sujet, message_sujet, date_sujet) VALUES(:nom, :message, :date)');
        $req->bindParam(':nom', $title, PDO::PARAM_STR);
        $req->bindParam(':message', $message, PDO::PARAM_STR);
        $req->bindParam(':date', $dateString, PDO::PARAM_STR);
        $req->execute();

    } catch (Exception $e) {
        $msg = $e->getMessage();
    }
    header('Location:../views/installation.php');
}

// On arrête la connexion à la base de données
$con = null;

?>