<?php
require_once "../includes/head.php";
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

?>

<head>
    <title>Forum</title>
    <link rel="stylesheet" href="../css/forum.css">
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
        <form method="post">
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

    <main>

        <article class="categorie">
            <h2 class="titreCat">Installation pour Windows</h2>
            <p class="descriptionCat">Découvre comment installer AlgoBox sur windows 95 ou avant ! Grâce à ce guide
                d'installation AlgoBox n'aura plus aucun secret pour toi ! Tu sauras cliqué sur "Suivant" comme personne
                avant toi !</p>
            <input class="btn1" type="button" value="J'y vais !">
        </article>

        <article class="categorie">
            <h2 class="titreCat">Installation pour MacOS</h2>
            <p class="descriptionCat">Eh oui ! Parce-qu'on pense à tout le monde, même les plus démunis ! N'hésite pas à
                venir découvrir notre guide d'installation pour le meilleur système d'exploitation au monde !</p>
            <input class="btn2" type="button" value="J'y vais !">
        </article>

        <article class="categorie">
            <h2 class="titreCat">Cours et exercices</h2>
            <p class="descriptionCat">Allez viens ! On est bien ! Regarde tout ce qu'on peut faire ! Même que si tu
                viens sans faire d'histoire je te laisserai jouer avec ma boucle !</p>
            <input class="btn3" type="button" value="J'y vais !">
        </article>

    </main>

    <script src="../js/forum.js"></script>

</body>

</html>