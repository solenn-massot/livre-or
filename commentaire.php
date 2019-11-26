<?php
if(!empty($_SESSION['login'])){
?>
<form action="livre-or.php" method="post">

    Worship your master: <input placeholder="Chtulhu is great !" type="textarea" name="comments" value="" required />

    <input type="submit" name="send" value="send" />
</form>

<?php

if (isset($_POST['send'])) {
    $login = $_SESSION['login'];
    $comment = $_POST["comments"];
    $connexion = mysqli_connect("localhost", "root", "", "livreor");
    $requetelog = "SELECT id FROM utilisateurs WHERE login = '$login'";
    $querylog = mysqli_query($connexion, $requetelog);
    $resultatlog = mysqli_fetch_assoc($querylog);
    $logid = $resultatlog["id"];
    $requete = "INSERT INTO commentaires (commentaire,id_utilisateur,date) VALUE (\"$comment\",$logid,NOW())";
    $query = mysqli_query($connexion, $requete);
    header("location:livre-or.php");
}
}
else
{
    echo "You need to be a worshiper of Chlulhu to encense Him";
}

?>