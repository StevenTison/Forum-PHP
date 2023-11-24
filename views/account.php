<?php
require_once "../includes/head.php";
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>

<head>
    <title>Votre compte</title>
    <link rel="stylesheet" href="../css/account.css">
</head>

<body>

    <div class="compte">
        <div class="prenomDiv">
            <p class="prenom">Votre prénom :
                <span>
                    <?php echo $_SESSION['prenom'] ?>
                </span>
            </p>
        </div>
        <div class="nomDiv">
            <p class="nom">Votre nom :
                <span>
                    <?php echo $_SESSION['nom'] ?>
                </span>
            </p>
        </div>
        <div class="emailDiv">
            <p class="email">Votre email :
                <span>
                    <?php echo $_SESSION['email'] ?>
                </span>
            </p>
            <form method="post">
                <button type="submit" name="emailChange" class="emailChange">
                    Changer votre e-mail :
                </button>
                <?php
                if (isset($_POST['emailChange'])) {
                    echo "<input type='text' name='emailChangeInput' id='emailChangeInput'>
                          <button type='submit' name='emailSubmit' class='emailSubmit'>Valider</button>";
                }
                if (isset($_POST["emailChangeInput"])) {
                    require_once "../includes/emailChange.php";
                }
                ?>
            </form>
        </div>
        <form method="post">
            <div class="passwordDiv">
                <button type="submit" name="password" class="password">
                    Changer votre mot de passe :
                </button>
                <?php
                if (isset($_POST["password"])) {
                    echo "<input type='password' name='passwordCurrent' id='passwordCurrent' class='passwordCurrent'>
                    <input type='password' name='passwordChangeInput' id='passwordChangeInput' class='passwordChangeInput'>
                    <input type='password' name='passwordVerify' id='passwordVerify' class='passwordVerify'>
                    <button type='submit' name='passwordSubmit' class='passwordSubmit'>Valider</button>";
                }
                if (isset($_POST["passwordSubmit"])) {
                    require_once "../includes/passwordChange.php";
                }
                ?>
        </form>
    </div>
    </div>

</body>