
<?php

session_start();
$login = "";
$password = "";

if (empty($_SESSION['login'])) {
    ?>
    <form action="inscription.php" method="post">
        Login: <input type="text" name="login" value="" required/>

        Password: <input type="password" name="password" value="" required/>

        Confirm password : <input type="password" name="cpassword" value="" required/>

        <input type="submit" name="connexion" value="Connexion" />
    </form>
<?php


    if (isset($_POST['connexion'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        if($_POST['password'] != $_POST['cpassword'])
        {
            echo "Your password and confirmed password doesn't match";
        }
        else{

        
        $connexion = mysqli_connect("localhost","root","","livreor");
        $requete = "SELECT login FROM utilisateurs WHERE login = \"$login\"";
        $query = mysqli_query($connexion, $requete);
        $resultat = mysqli_fetch_array($query);

        if(!empty($resultat))
        {
            echo "Your login is already taken by a worshiper of Chtulhu";
        }
        else
        {
            $requete2 = "INSERT INTO utilisateurs(login, password) VALUES (\"$login\",\"$password\")";
            $query = mysqli_query($connexion, $requete2);
            $_SESSION['login'] = $_POST['login'] ;
            $_SESSION['password'] = $_POST['password'] ;
            header("location:index.php");
        }
    }
     
    }
}
else
{
    echo "You are already a worshiper of Chtulu";
}

?>