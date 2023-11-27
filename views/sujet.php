<?php
require_once "../includes/head.php";
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<head>
    <title>Sujet</title>
    <link rel="stylesheet" href="../css/sujet.css">
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
            <img src="/img/fleches-de-contour-fin-a-gauche.png">
        </div>
        <nav class="nav">
            <a href="installation.php">Installation pour Windows</a>
            <a href="installationMac.php">Installation pour Mac</a>
            <a href="installation.php">Cours et exercices</a>
        </nav>
    </div>

    <script src="../js/sujet.js"></script>

</body>

</html>