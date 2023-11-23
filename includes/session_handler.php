<?php

function general_connexion_bdd()
{

    // On configure la base de données
    $serveur = "localhost";
    $user = "root";
    $password = "";
    $bdd = "forum";
    $bdd_option['PDO::ATTR_EMULATE_PREPARES'] = 'FALSE';
    $bdd_option['PDO::ATTR_ERRMODE'] = 'PDO::ERRMODE_EXCEPTION';
    $bdd_option['PDO::ATTR_DEFAULT_FETCH_MODE'] = 'PDO::FETCH_ASSOC';

    // On instancie la base de données
    try {
        $conBdd = new PDO("mysql:host=" . $serveur . ';dbname=' . $bdd, $user, $password, $bdd_option);
    } catch (PDOException $e) {
        print "Erreur de connexion à la BDD ! Message : " . $e->getMessage() . "<br/>";
        die();
    }

    return $conBdd;
}

// On défini une classe Session

class Session
{

    // On crée une variable interne qui contient la connexion à la base de données
    private $conBdd;

    // On initialise la session lors de l'appel de la classe
    public function __construct()
    {

        // On ouvre la connexion à la base de données et on associe cette dernière à la variable
        $this->conBdd = general_connexion_bdd();

        // On paramètre la session
        session_set_save_handler(
            array($this, "session_ouverture"),
            array($this, "session_fermeture"),
            array($this, "session_lecture"),
            array($this, "session_ecriture"),
            array($this, "session_destruction"),
            array($this, "session_nettoyage"),
        );

        // On démarre la session
        session_start();
    }

    // Ouverture des sessions
    public function session_ouverture($savePath, $sessionID)
    {
        if ($this->conBdd) {
            // Si la connexion existe, on renvoie true
            return true;
        }
        // Si la connexion n'existe pas, on renvoie false
        return false;
    }

    // Fermeture des sessions
    public function session_fermeture()
    {

        // Nettoyage de la BDD lors de la fermeture pour ne pas attendre le nettoyage automatique
        $this->session_nettoyage(ini_get("session.gc_maxelifetime"));

        // On destruit la connexion
        $this->conBdd = null;

        // On renvoie true pour valider la fermeture
        return true;
    }

    // Lecture de la session
    public function session_lecture($sessionID)
    {

        // Création d'un date time actuel
        $datetime_actuel = new DateTime("now", new DateTimeZone('Europe/Paris'));

        // Préparation de la requête
        $requete = $this->conBdd->prepare('SELECT `data` FROM php_session WHERE `id_session` = ? LIMIT 1');

        // Exécution de la requête
        $requete->execute([$sessionID]);

        // Récupération des résultats
        $resultat = $requete->fetch(PDO::FETCH_ASSOC);

        if ($resultat == true) {
            // Mise à jour de la date
            // Préparation de la requête
            $requete = $this->conBdd->prepare('UPDATE php_session SET `update` = ? WHERE `id_session` = ?');

            // Exécution de la requête
            $requete->execute([$datetime_actuel->format('Y-m-d H:i:s'), $sessionID]);

            return $resultat['data'];
        }

        // Si quelque chose ne fonctionne pas, on ne retourne rien
        return '';

    }

    // Ecriture des sessions
    public function session_ecriture($sessionID, $sessionData)
    {

        //Création d'un date time actuel
        $datetime_actuel = new DateTime('now', new DateTimeZone('Europe/Paris'));

        // Préparation de la requête d'INSERT avec UPDATE si la données existe déjà
        $requete = $this->conBdd->prepare('INSERT INTO php_session (`id_session`, `data`, `update`) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE `data` = ?');

        // Execution de la requête
        $requete->execute([$sessionID, $sessionData, ($datetime_actuel->format('Y-m-d H:i:s')), $sessionData]);

        // Récupération des résultats
        $resultat = $requete->rowCount();

        if ($resultat >= 0) {
            // si l'INSERT ou l'UPDATE réussi, on renvoi true
            return true;
        }

        // Si quelque chose ne fonctionne pas, on renvoie false
        return false;
    }

    // Destruction des sessions
    public function session_destruction($sessionID)
    {

        // Préparation de la requête
        $requete = $this->conBdd->prepare('DELETE FROM php_session WHERE `id_session` = ?');

        // Exécution de la requête
        $requete->execute([$sessionID]);

        // Récupération des résultats
        $resultat = $requete->rowCount();

        if ($resultat >= 1) {
            // Si la suppresion a réussi, on renvoie true
            return true;
        }

        // Si quelque chose ne fonctionne pas, on renvoie false
        return false;
    }

    // Nettoyage de la base de données
    public function session_nettoyage($sessionMaxLifeTime)
    {

        // Calcul du temps d'expiration
        $timestamp_expiration = time() - $sessionMaxLifeTime;

        // Calcul de la date d'expiration UTC
        $date_expiration = new DateTime("@" . $timestamp_expiration);

        // Formatage de la date dans le bon fuseau horaire
        $date_expiration->setTimezone(new DateTimeZone("Europe/Paris"));

        // Préparation de la requête
        $requete = $this->conBdd->prepare("DELETE FROM php_session WHERE `update` <= ?");

        // Exécution de la requête
        $requete->execute([$date_expiration->format("Y-m-d H:i:s")]);

        // Récupération des résultats
        $resultat = $requete->rowCount();

        if ($resultat >= 0) {
            // Si la suppression a réussi, on renvoie true
            return true;
        }

        // Si quelque chose ne fonctionne pas, on renvoie false
        return false;
    }

}



?>