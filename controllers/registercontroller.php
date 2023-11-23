<?php

// On configure la base de données
$serveur = "localhost";
$user = "root";
$password = "";
$bdd = "forum";

// On vérifie les informations écrites par l'utilisateur
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

// On se connecte à la base de données
$con = new PDO("mysql:host=" . $serveur . ';dbname=' . $bdd, $user, $password);
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// On vérifie que l'email fourni par l'utilisateur existe ou pas dans la base de données
$stmt = $con->prepare("SELECT * FROM utilisateur WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo "L'email existe déjà.";
} else {
    // On vérifie que les champs soient correctement remplis
    if (
        !empty($prenom)
        && strlen($prenom) >= 3
        && strlen($prenom) <= 20
        && preg_match("#[A-Za-z '-]+$#", $prenom)
        && !empty($nom)
        && strlen($nom) >= 3
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

        // On se connecte à la base de données et on envoie les données
        try {
            // On hash le mot de passe avant de l'envoyer
            $hash = password_hash($mdp, PASSWORD_BCRYPT);

            // On prépare les données à insérer dans la base de données
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
    }

}

?>