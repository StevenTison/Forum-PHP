<?php

// On établi la connexion avec la base de données
require_once "connexiondb.php";

// On démarre ou reprend la session
session_start();



if (isset($_SESSION["id_utilisateur"])) {

    $userID = $_SESSION["id_utilisateur"];

} else {

    echo "ID utilisateur non défini";
}



// On effectue une requête SQL pour récupérer l'utilisateur à partir de la base de données
$requete = "SELECT id_utilisateur FROM utilisateur WHERE id_utilisateur = $userID";
$resultat = $con->query($requete);

// Vérification des résultats et attribution à la variable de session si les résultats existent
if ($resultat->rowCount() > 0) {
    $row = $resultat->fetch(PDO::FETCH_ASSOC);
    $_SESSION['nom_personne'] = $row['nom_personne'];

}

// On ferme la connexion à la base de données
$con = null;


?>