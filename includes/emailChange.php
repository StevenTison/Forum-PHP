<?php

// On configure la base de données
$serveur = "localhost";
$user = "root";
$password = "";
$bdd = "forum";

function valid_donnees($donnees)
{
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

// On vérifie le nouvel e-mail donné par l'utilisateur
$emailNew = valid_donnees($_POST["emailChangeInput"]);

if (!empty($emailNew)) {
    if (
        !empty($emailNew)
        && filter_var($emailNew, FILTER_VALIDATE_EMAIL)
    ) {
        try {
            // On se connecte à la base de données
            $con = new PDO("mysql:host=" . $serveur . ';dbname=' . $bdd, $user, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // On vérifie que le formulaire a été soumis
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // On récupère les données du formulaire de connexion
                $emailNew = $_POST["emailChangeInput"];

                // On prépare la requête SQL pour UPDATE l'email de l'utilisateur
                $req = $con->prepare('UPDATE utilisateur SET email = ? WHERE email = ?');
                $req->execute([$emailNew, $_SESSION['email']]);

                // On redéfinie l'email de la session
                $_SESSION['email'] = $emailNew;
                header('Location:../views/account.php');
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }
}

// On ferme la connexion à la base de données
$con = null;
?>