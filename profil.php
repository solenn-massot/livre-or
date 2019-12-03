<?php

session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profil</title>
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
$login = $_SESSION['login'];
$password = $_SESSION['password'];


?>
<div class="form-style-connexion">
<form action="profil.php" method="post">
        Login: <input placeholder="<?php echo"$login"?>" type="text" name="login" value="" required/>

        Password: <input type="password" name="password" value="" required/>

        Confirm password : <input type="password" name="cpassword" value="" required/>

        <input type="submit" name="connexion" value="Connexion" />
    </form>
</div>

<?php

if(isset($_POST['connexion']))
{
    $newlogin = $_POST['login'];
    $newpassword = $_POST['password'];
    if($_POST['password'] != $_POST['cpassword'])
    {
        ?>
    <div class="error">
                <span>
                   Your passwords doesn't match
             </span>
             </div>
             <?php
    }
    else
    {
        $connexion = mysqli_connect("localhost","root","","livreor");
        $requete = "SELECT * FROM utilisateurs WHERE login = \"$newlogin\" AND password = \"$password\"";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_array($query);
        $id = $resultat['id'];

        if(!empty($resultat))
        {
            $update = "UPDATE utilisateurs SET login =\"$newlogin\", password = \"$newpassword\" WHERE id = \"$id\"";
            $query2 = mysqli_query($connexion, $update);
            $_SESSION['login'] = $newlogin ; 
            $_SESSION['password'] = $newpassword;
            header("location:profil.php");
        }
        else
        {
            ?>
    <div class="error">
                <span>
                   The login is already taken
             </span>
             </div>
             <?php
        }
    }
}
}
else
{
    ?>
    <div class="error">
                <span>
                   You need to be a worshiper of Chthulhu to see this page
             </span>
             </div>
             <?php
}

?>
</main>
</body>
</html>
