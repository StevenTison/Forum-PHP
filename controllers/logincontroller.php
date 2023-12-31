<?php
// On configure la base de données
$serveur = "localhost";
$user = "root";
$password = "";
$bdd = "forum";

// On récupère et vérifie les données entrées par l'utilisateur
$email = valid_donnees($_POST["emailLog"]);
$mdp = valid_donnees($_POST["passwordLog"]);
function valid_donnees($donnees)
{
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

// Vérifie que les champs ne soient pas vides
if (
    !empty($email)
    && !empty($mdp)
) {
    try {
        $con = new PDO("mysql:host=" . $serveur . ';dbname=' . $bdd, $user, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // On vérifie que le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // On récupère les données du formulaire de connexion
            $email = $_POST["emailLog"];
            $mdp = $_POST["passwordLog"];

            // On prépare la requête SQL pour récupérer le hashage du mot de passe
            $req = $con->prepare("SELECT password FROM utilisateur WHERE email = ?");
            $req->execute([$email]);

            // On récupère le résultat de la requête
            $result = $req->fetch();

            if ($result && password_verify($mdp, $result['password'])) {
                require_once "../includes/session.php";
                header("Location:../views/forum.php");
            } else {
                header("Location:../index.php");
            }
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    header("Location:../index.php");
}
?>