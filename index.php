<?php
require_once "includes/head.php";
?>

<head>
    <title>Accueil</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>

    <div class="titre">
        <h1>Bienvenue chez les fans d'Algobox</h1>
    </div>

    <div class="regLog">
        <input class="regLogBtn1" type="button" value="S'enregistrer">
        <input class="regLogBtn2" type="button" value="Se connecter">
    </div>

    <div class="container hidden register">
        <form action="controllers/registercontroller.php" method="POST" id="register" class="form">
            <h2>S'enregistrer</h2>
            <div class="form-field">
                <label for="nom">Nom :</label>
                <input type="text" name="nom" id="nom" autocomplete="off">
                <small></small>
            </div>

            <div class="form-field">
                <label for="prénom">Prénom :</label>
                <input type="text" name="prenom" id="prenom" autocomplete="off">
                <small></small>
            </div>

            <div class="form-field">
                <label for="email">Email :</label>
                <input type="text" name="email" id="email" autocomplete="off">
                <small></small>
            </div>

            <div class="form-field">
                <label for="password">Mot de passe :</label>
                <input type="password" name="password" id="password" autocomplete="off">
                <small></small>
            </div>


            <div class="form-field">
                <label for="confirmPassword">Confirmer votre mot de passe :</label>
                <input type="password" name="confirmPassword" id="confirmPassword" autocomplete="off">
                <small></small>
            </div>

            <div class="form-field">
                <input class="btn" type="submit" value="S'enregistrer">
            </div>
        </form>
    </div>

    <div class="container hidden login">
        <form action="controllers/logincontroller.php" method="POST" id="login" class="form">
            <h2>Se connecter</h2>

            <div class="form-field">
                <label for="email">Email:</label>
                <input type="text" name="emailLog" id="emailLog" autocomplete="off">
                <small></small>
            </div>

            <div class="form-field">
                <label for="password">Mot de passe :</label>
                <input type="password" name="passwordLog" id="passwordLog" autocomplete="off">
                <small></small>
            </div>

            <div class="form-field">
                <input class="btn" type="submit" value="Se connecter">
            </div>
        </form>
    </div>

    <script src="js/script.js"></script>

</body>

</html>