<!DOCTYPE html>
<html>

<head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <nav>
            <li><a class="link-nav" href="index.php">Home</a></li>
            <li><a class="link-nav" href="inscription.php">Sign in</a></li>
            <li><a class="link-nav" href="connexion.php">Log in</a></li>
            <img id="logo-nav" src="image/sigil.png" />
            <li><a class="link-nav" href="profil.php">Profil</a></li>
            <li><a class="link-nav" href="livre-or.php">The book</a></li>
            <li><a class="link-nav" href="commentaire.php">Comments</a></li>
        </nav>
    </header>
    <main>
        <?php
        session_start();
        if (!empty($_SESSION['login'])) {
            ?>
            <div class="form-style-connexion">
            <form action="commentaire.php" method="post">

            Worship your master :<textarea value="comments" name="comments" placeholder="Praise the Lord " rows="6"></textarea>

                <input type="submit" name="send" value="send" />
            </form>
        </div>
        <?php

            if (isset($_POST['send'])) {
                $login = $_SESSION['login'];
                $comment = $_POST['comments'];
                $connexion = mysqli_connect("localhost", "root", "", "livreor");
                $requetelog = "SELECT id FROM utilisateurs WHERE login = '$login'";
                $querylog = mysqli_query($connexion, $requetelog);
                $resultatlog = mysqli_fetch_assoc($querylog);
                $logid = $resultatlog["id"];
                $requete = "INSERT INTO commentaires (commentaire,id_utilisateur,date) VALUE (\"$comment\",$logid,NOW())";
                $query = mysqli_query($connexion, $requete);
                header("location:livre-or.php");
            }
        } else {
            ?>
            <div class="error">
                <span>
                    You need to be a worshiper of Chtulhu to encense Him
                </span>
            </div>
        <?php
        }

        ?>