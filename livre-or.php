<?php
session_start();


$connexion = mysqli_connect("localhost","root","","livreor");
$requete = "SELECT utilisateurs.login, commentaires.commentaire, date_format(commentaires.date,\"%e %M %Y\") FROM utilisateurs, commentaires WHERE commentaires.id_utilisateur = utilisateurs.id ORDER BY date DESC";
$query = mysqli_query($connexion, $requete);
$resultat = mysqli_fetch_all($query);
            foreach($resultat as list($a, $b, $c))
            {
                
                echo "<b>Posté le ".$c." par ".$a."<br/>".$b."</b><br/>";
            }

if(!empty($_SESSION['login']))
{
    ?>
    <a href="commentaire.php">Cliquez ici pour poster un commentaire</a>
    <?php
}
else
{
    echo "connectez vous pour poster un commentaire";
}

?>
