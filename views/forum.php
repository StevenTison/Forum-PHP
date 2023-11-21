<?php
require_once "../includes/head.php"
?>

<head>
    <title>Forum</title>
    <link rel="stylesheet" href="../css/forum.css">
</head>

<body>

    <header>
        <p class="bienvenue">Bienvenue <span class="nom"></span> <span class="prenom"></span>.</p>
        <p class="dateCo">Nous sommes le <span class="jourSem"></span> <span class="dateDay"></span> <span
                class="dateMonth"></span> <span class="dateYear"></span>.</p>
        <p class="heureCo">Vous vous êtes connecté à <span class="heure"></span>h<span class="minute"></span>.</p>
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

    <script src="/js/forum.js"></script>

</body>

</html>