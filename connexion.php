<?php

session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign in</title>
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
if(empty($_SESSION['login']))
{
    ?>
<div class="form-style-connexion">
<form action="connexion.php" method="post">
    Login: <input type="text" name="login" value="" required />
     
    Password: <input type="password" name="password" value="" required/>
     
    <input type="submit" name="connexion" value="Connexion" />
</form>
</div>
<?php
if(isset($_POST['connexion']))
{
    if(empty($_POST['login']))
    {
        ?>
        <div class="error">
        <span>
           Your login is missing
     </span>
     </div>
     <?php
    }
    else
    {
        if(empty($_POST['password']))
        {
            ?>
                <div class="error">
                <span>
                  Your password is missing
             </span>
             </div>
             <?php
        }
        else
        {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $connexion = mysqli_connect("localhost","root","","livreor");
            if(!$connexion)
            {
                ?>
                <div class="error">
                <span>
                   Chtulhu is not available
             </span>
             </div>
             <?php
            }
            else
            {
                $requete = "SELECT login, password FROM utilisateurs WHERE login = \"$login\" AND password = \"$password\"";
                $query = mysqli_query($connexion, $requete);
                $resultat = mysqli_fetch_array($query);

                if(!empty($resultat))
                {   
                    if($_POST['password'] == $resultat['password'] && $_POST['login'] == $resultat['login'])
                    {
                        $_SESSION['login'] = $_POST['login'] ;
                        $_SESSION['password'] = $_POST['password'] ;
                        header("location:index.php");
                    }
                    else
                    {
                       ?>
                       <div class="error">
                       <span>
                           Your password have been eat by Chtulhu
                    </span>
                    </div>
                    <?php
                    }
                }
                else
                {
                    ?>
                    <div class="error">
                    <span>
                        Your login have been eat by Chtulhu
                 </span>
                    </div>
                 <?php
                }
                
            }
        }
    }
}


}
else{
    ?>
    <div class="error">
        <span>
            You are already known as a worshiper
        </span>
    </div>
</main>
    <?php
}
?>
</body>
</html>
