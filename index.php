<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <header>
    <nav>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="inscription.php">Inscription</a></li>
        <li><a href="connexion.php">Connexion</a></li>
        <li><a href="profil.php">Profil</a></li>
        <li><a href="livre-or.php">Livre d'or</a></li>
        <li><a href="commentaire.php">Commentaire</a></li>
    </nav>
    </header>
    <main>
<?php

if(isset($_SESSION['login']))
    {
        echo "Hello ".$_SESSION['login']."We have been waiting for you";
    }
    else
    {
        echo "Your are not a worshiper of Chtulhu yet";
    }

?>
<form action="index.php" method="post">
<input type="submit" name="deconnexion" value="deconnexion" />
    </form>
    <?php

    if(isset($_POST['deconnexion']))
    {
        session_unset();
        session_destroy();
        header("location:index.php");

    }

    ?>