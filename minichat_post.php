<?php 
//setcookie('author', $_POST['author'], time() + 3600*24*7, null, null, false, true); // Créer un nouveau cookie pour retenir le pseudo de l'utilisateur sécurisé (!XSS).
//setcookie('chsndate', $_POST['chsndate'], time() + 60, null, null, false, true); // Crée un cookie pour les gens voulant afficher les messages d'un jour précédent.
?> 

<?php 
try {
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' .$e->getMessage());
}

//on ajoute un message dans la table minichat
$pseudo = empty($_POST ['pseudo']) ? '' : $_POST['pseudo'];
// if (empty($_POST['pseudo'])){
//     $_POST['pseudo']='';
// } else{
//     $_POST['pseudo']=$_POST['pseudo'];
// }
$commentaire= empty($_POST['commentaire']) ? '' : $_POST['commentaire'];
// if (empty($_POST['commentaire'])){
//     $_POST['commentaire']='';
// } else{
//     $_POST['commentaire']=$_POST['commentaire'];
// }

$req = $bdd->prepare('INSERT INTO  minichat (pseudo, message) VALUE(?, ?)');
$req->execute(array($_POST['pseudo'], $_POST['commentaire']
));
header('location:minichat.php');