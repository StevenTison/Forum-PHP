<?php
require_once "../includes/head.php";
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<head>
    <title>Installation</title>
    <link rel="stylesheet" href="../css/categorie.css">
</head>

<body>

    <header>
        <p class="bienvenue">Bienvenue
            <span class="nom">
                <?php echo $_SESSION['nom'] ?>
            </span>
            <span class="prenom">
                <?php echo $_SESSION['prenom'] ?>
            </span>.
        </p>
        <p class="dateCo">Nous sommes le <span>
                <?php echo $_SESSION['date'] ?>
            </span>.</p>
        <p class="heureCo">Vous vous êtes connecté à
            <span class="heure">
                <?php echo $_SESSION['heure'] ?>
            </span>.
        </p>
        <form method="post" class="compte">
            <button type="submit" name="account" class="account">
                <?php
                echo "Votre compte";
                if (isset($_POST['account'])) {
                    header('Location:../views/account.php');
                }
                ?>
            </button>
            <button type="submit" name="dc" class="dc">
                <?php
                echo "Déconnexion";
                if (isset($_POST['dc'])) {
                    session_destroy();
                    header('Location:../index.php');
                }
                ?>
            </button>
        </form>
    </header>

    <div class="navBar">
        <div class="navAff">
            <img src="../img/fleches-de-contour-fin-a-gauche.png">
        </div>
        <nav class="nav">
            <a href="installation.php">Installation pour Windows</a>
            <a href="installationMac.php">Installation pour Mac</a>
            <a href="installation.php">Cours et exercices</a>
        </nav>
    </div>

    <table class="table">
        <tr>
            <th>Sujet</th>
            <th>Premier message</th>
            <th>Date de création</th>
        </tr>
        <?php
        require_once '../controllers/sujetcontroller.php';
        //boucle foreach pour afficher chaque ligne de la requête
        foreach ($lignes as $ligne) {
            echo '<tr>
                <td><a href="sujet.php?id=' . $ligne['id_sujet'] . '">' . $ligne['nom_sujet'] . '</a></td>
                <td>' . $ligne['message_sujet'] . '</td>
                <td>' . $ligne['date_sujet'] . '</td>
            </tr>';
        }
        ?>
    </table>

    <form action="../includes/createSujet.php" method="POST" class="formSujet">
        <label for="titre">Titre de votre sujet :</label>
        <input id="titre" type="text" name="titre">




        <label for="message">Contenu de votre message :</label>
        <textarea name="message" id="message"></textarea>

        <button type="submit">Envoyer</button>
    </form>

    <script src="../js/categorie.js"></script>

</body>

</html>