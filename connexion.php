<?php

session_start();

if(empty($_SESSION['login']))
{
if(isset($_POST['connexion']))
{
    if(empty($_POST['login']))
    {
        echo "The login is missing";
    }
    else
    {
        if(empty($_POST['password']))
        {
            echo "The password is missing";
        }
        else
        {
            $login = $_POST['login'];
            $password = $_POST['password'];
            $connexion = mysqli_connect("localhost","root","","livreor");
            if(!$connexion)
            {
                echo "Chtulhu could not be reached, try later";
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
                        echo "Your password have been eat by Chtulhu";
                    }
                }
                else
                {
                    echo "Your login have been eat by Chtulhu";
                }
                
            }
        }
    }
}


?>

<form action="connexion.php" method="post">
    Login: <input type="text" name="login" value="" />
     
    Password: <input type="password" name="password" value="" />
     
    <input type="submit" name="connexion" value="Connexion" />
</form>
<?php
}
else{
    ?>
    <div>
        <span>
            Vous êtes déjà connecté
        </span>
    </div>
    <?php
}

