
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
$login = "";
$password = "";

if (empty($_SESSION['login'])) {
    ?>
    <div class="form-style-connexion">
    <form action="" method="post">
        Login: <input type="text" name="login" value="" required/>

        Password: <input type="password" name="password" value="" required/>

        Confirm password : <input type="password" name="cpassword" value="" required/>

        <input type="submit" name="connexion" value="Connexion" />
    </form>
</div> 
<?php


    if (isset($_POST['connexion'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if($_POST['password'] != $_POST['cpassword'])
        {
            ?>
            <div class="error">
                <span>
                   Your password and confirmed password doesn't match
             </span>
             </div>
             <?php
        }
        else{

        
        $connexion = mysqli_connect("localhost","root","","livreor");
        $requete = "SELECT login FROM utilisateurs WHERE login = \"$login\"";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_array($query);

        if(!empty($resultat))
        {
            ?>
            <div class="error">
                <span>
                   Your login is already taken by a worshiper of Chtulhu
             </span>
             </div>
             <?php
        }
        else
        {
            $requete2 = "INSERT INTO utilisateurs(login, password) VALUES (\"$login\",\"$password\")";
            $query = mysqli_query($connexion, $requete2);
            header("location:connexion.php");
        }
    }
     
    }
}
else
{
    ?>
    <div class="error">
        <span>
           You are already known as a worshiper of Chtulhu
     </span>
     </div>
     <?php
}

?>
</main>
</body>
</html>