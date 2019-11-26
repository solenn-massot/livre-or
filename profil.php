<?php

session_start();

$login = $_SESSION['login'];
$password = $_SESSION['password'];

echo "Hello $login";

?>

<form action="profil.php" method="post">
        Login: <input placeholder="<?php echo"$login"?>" type="text" name="login" value="" required/>

        Password: <input type="password" name="password" value="" required/>

        Confirm password : <input type="password" name="cpassword" value="" required/>

        <input type="submit" name="connexion" value="Connexion" />
    </form>

<?php

if(isset($_POST['connexion']))
{
    $newlogin = $_POST['login'];
    $newpassword = $_POST['password'];
    if($_POST['password'] != $_POST['cpassword'])
    {
        echo "Your password doesn't match";
    }
    else
    {
        $connexion = mysqli_connect("localhost","root","","livreor");
        $requete = "SELECT * FROM utilisateurs WHERE login = \"$login\" AND password = \"$password\"";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_array($query);
        $id = $resultat['id'];

        if(!empty($resultat))
        {
            $update = "UPDATE utilisateurs SET login =\"$newlogin\", password = \"$newpassword\" WHERE id = \"$id\"";
            $query2 = mysqli_query($connexion, $update);
            $_SESSION['login'] = $newlogin ; 
            $_SESSION['password'] = $newpassword;
            echo "Your information have been successfully changed";
            header("location:profil.php");
               }
    }
}


?>
