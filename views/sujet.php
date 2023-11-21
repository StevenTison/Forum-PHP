<?php
require_once "../includes/head.php"
?>

<head>
    <title>Sujet</title>
    <link rel="stylesheet" href="../css/sujet.css">
</head>

<body>

    <header>
        <p class="bienvenue">Bienvenue <span class="nom"></span> <span class="prenom"></span>.</p>
        <p class="dateCo">Nous sommes le <span class="jourSem"></span> <span class="dateDay"></span> <span
                class="dateMonth"></span> <span class="dateYear"></span>.</p>
        <p class="heureCo">Vous vous êtes connecté à <span class="heure"></span>h<span class="minute"></span>.</p>
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