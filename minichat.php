<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="minichat.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mini chat</title>
</head>

<body>
    <h1> Laissez votre commentaire </h1>

    <div id='comment'>

        <form method='post' action='minichat_post.php'>
            <!--on envoie vers le traitement -->
            <label for='pseudo' class='nomlabel'> pseudo :</label>
            <input class="champ" type="text" name="pseudo">
            <br>
            <br>
            <label for='commentaire' class="nomlabel"> message : </label>
            <textarea class="champ" name="commentaire" rows="8" cols="45"> </textarea>
            <br>
            <br>
            <input id="validation" type="submit" value="poster">
        </form>
    </div>
    <div id='zonecommentaire'>
        <?php 
//connection à la base de données
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    } catch (Exception $e) {
        die('Erreur : ' .$e->getMessage());
    }

//récupération des 10 derniers messages les plus récents et on modifie le format de la date
    $reponse = $bdd->query('SELECT date, pseudo, message, DATE_FORMAT(date, "%d %m %Y %Hh%imin%ss") AS datefr FROM minichat WHERE pseudo!="" AND message!="" ORDER BY id DESC LIMIT 0,10');

//afficher les 10 derniers messages
    while ($donnees = $reponse->fetch()) {
        echo '<p>' . $donnees['datefr'] . ' ' . '<strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
    }
// Termine le traitement de la requête
$reponse->closeCursor();
    ?>
    </div>

</body>

</html>