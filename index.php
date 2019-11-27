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
        <img id="logo-nav" src="image/sigil.png"/>
        <li><a class="link-nav" href="profil.php">Profil</a></li>
        <li><a class="link-nav" href="livre-or.php">The book</a></li>
        <li><a class="link-nav"  href="commentaire.php">Comments</a></li>
    </nav>
    </header>
    <main>
<?php

if(!empty($_SESSION['login']))
    {
    ?>
    <div class="div-index">
        <span class="text-index">Hello <?php echo $_SESSION['login']?> <br/>
        We have been waiting for you <br />
        You can edit your profil <a class="link-index" href="profil.php">here</a><br />
        You can read the prayer of your siblings <a class="link-index" href="livre-or.php">here</a><br />
        Praise Chtulhu ! 
    </span>
    </div>
    <form action="index.php" method="post">
<input class="button1" type="submit" name="deconnexion" value="log out" />
    </form>
    <?php

    if(isset($_POST['deconnexion']))
    {
        session_unset();
        session_destroy();
        header("location:index.php");

    }

    ?>
    <?php
    }
    else
    {
    ?>
    <div class="div-index">
        <span class="text-index">
            You are not a worshiper of Chtulhu yet. <br />
            You can register as one of us <a class="link-index" href="inscription.php">here</a><br />
        </span>
    </div>
    </main>
    <?php
    }

?>

</body>
</html>

