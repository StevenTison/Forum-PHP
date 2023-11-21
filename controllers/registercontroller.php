<?php

$serveur = "localhost";
$user = "root";
$password = "";
$bdd = "forum";

$prenom = valid_donnees($_POST["prenom"]);
$nom = valid_donnees($_POST["nom"]);
$email = valid_donnees($_POST["email"]);
$mdp = valid_donnees($_POST["password"]);
$confirmPassword = valid_donnees($_POST["confirmPassword"]);

function valid_donnees($donnees)
{
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}

if (
    !empty($prenom)
    && strlen($prenom) <= 20
    && preg_match("#[A-Za-z '-]+$#", $prenom)
    && !empty($nom)
    && strlen($nom) <= 20
    && preg_match("#[A-Za-z '-]+$#", $nom)
    && !empty($email)
    && filter_var($email, FILTER_VALIDATE_EMAIL)
    && !empty($mdp)
    && strlen($mdp) >= 8
    && preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#^+\-\[\]])[A-Za-z\d#^+\-\[\]]{8,}$/", $mdp)
    && !empty($confirmPassword)
    && $mdp === $confirmPassword
) {

    try {
        $con = new PDO("mysql:host=" . $serveur . ';dbname=' . $bdd, $user, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $hash = password_hash($mdp, PASSWORD_DEFAULT);

        $req = $con->prepare("INSERT INTO utilisateur(prenom_personne, nom_personne, email, password) VALUES(:prenom, :nom, :email, :password)");
        $req->bindParam(":prenom", $prenom);
        $req->bindParam(":nom", $nom);
        $req->bindParam(":email", $email);
        $req->bindParam(":password", $hash);
        $req->execute();

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

} else {
    echo "Test";
}

?>