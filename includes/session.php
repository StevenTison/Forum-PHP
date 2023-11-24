<?php

// Démarrer la session
session_start();

// On configure la base de données
$serveur = "localhost";
$user = "root";
$password = "";
$bdd = "forum";

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'e-mail posté au moment du login
    $email_posted = $_POST['emailLog'];

    try {
        // Connexion à la base de données
        $con = new PDO("mysql:host=" . $serveur . ';dbname=' . $bdd, $user, $password);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête SQL pour récupérer le nom, prénom et email depuis la table utilisateur
        $sql = "SELECT nom_personne, prenom_personne, email FROM utilisateur WHERE email = :emailLog";

        // Préparation de la requête
        $stmt = $con->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':emailLog', $email_posted);

        // Exécution de la requête
        $stmt->execute();

        // Récupération des résultats
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // On récupère l'heure et la date de connexion
        $dateCo = new DateTime("now", new DateTimeZone("Europe/Paris"));

        if ($row) {
            // Vérifier l'e-mail
            if ($email_posted === $row['email']) {
                // Stocker les données dans la session
                $_SESSION['nom'] = $row['nom_personne'];
                $_SESSION['prenom'] = $row['prenom_personne'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['heure'] = $dateCo->format('H:i');
                $_SESSION['date'] = $dateCo->format('d-m-Y');
            } else {
                // Mot de passe incorrect
                echo "Mot de passe incorrect. Veuillez réessayer.";
            }
        } else {
            // Aucun utilisateur trouvé avec l'email donné
            echo "Aucun utilisateur trouvé avec cet e-mail.";
        }

    } catch (PDOException $e) {
        // Gestion des erreurs de la base de données
        echo "Erreur : " . $e->getMessage();
    }

    // Fermer la connexion à la base de données
    $con = null;
}
?>