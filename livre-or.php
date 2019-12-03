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
        if (!empty($_SESSION['login'])) {
            ?>
            <a class="button1" href="commentaire.php">Click here to worship our master</a>
        <?php
        } else {
            ?>
            <div class="error">
                <span>
                    Log in to worship our master
                </span>
            </div>
        <?php
        }

        $connexion = mysqli_connect("localhost", "root", "", "livreor");
        $requete = "SELECT utilisateurs.login, commentaires.commentaire, date_format(commentaires.date,\"%e %M %Y\") FROM utilisateurs, commentaires WHERE commentaires.id_utilisateur = utilisateurs.id ORDER BY date ASC";
        //ASC puisque mon css est en flex column reverse
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_all($query);
        foreach ($resultat as list($a, $b, $c)) {

            ?>
            <div class="book">
                <h1 id="book-h1">Post the <?php echo $c ?> by <?php echo $a ?></h1> <br />
                <span id="text-book"><?php echo $b ?> <br />
                </span>
            </div>

        <?php
        }
        ?>
        </main>
    </body>
        </html>