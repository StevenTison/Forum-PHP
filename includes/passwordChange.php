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

// On vérifie le nouveau mot de passe donné par l'utilisateur
$mdpCurrent = valid_donnees($_POST['passwordCurrent']);
$mdpNew = valid_donnees($_POST['passwordChangeInput']);
$mdpVerify = valid_donnees($_POST['passwordVerify']);

// On se connecte à la base de données
try {
    $con = new PDO("mysql:host=" . $serveur . ';dbname=' . $bdd, $user, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // On récupére et associe l'email au mot de passe
    $stmt = $con->prepare('SELECT password FROM utilisateur WHERE email = ?');
    $stmt->execute([$_SESSION['email']]);
    $result = $stmt->fetch((PDO::FETCH_ASSOC));

} catch (PDOException $error) {
    echo 'N°' . $error->getCode() . '<br/>';
    die('Erreur : ' . $error->getMessage() . '<br/>');
}

if (
    $result
    && !empty($mdpCurrent)
    && password_verify($mdpCurrent, $result['password'])
    && !empty($mdpNew)
    && strlen($mdpNew) >= 8
    && preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#^+\-\[\]])[A-Za-z\d#^+\-\[\]]{8,}$/", $mdpNew)
    && !empty($mdpVerify)
    && $mdpNew === $mdpVerify
) {
    try {
        // On hash le mot de passe avant de l'envoyer
        $hash = password_hash($mdpNew, PASSWORD_BCRYPT);

        // On prépare les données à insérer dans la base de données
        $req = $con->prepare("UPDATE utilisateur SET password = ? WHERE email = ?");
        $req->execute([$hash, $_SESSION['email']]);

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

// On ferme la connexion avec la base de données
$con = null;
?>