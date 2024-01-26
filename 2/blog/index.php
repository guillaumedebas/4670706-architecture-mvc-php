<?php
// Connexion à la base de données
try {
   $database = new PDO('mysql:host=localhost;dbname=oldblog;charset=utf8', 'root', '');
} catch (Exception $e) {
   die('Erreur : ' . $e->getMessage());
}

// On récupère les 5 derniers billets
$statement = $database->query("SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5");

$post = [];
while ($row = $statement->fetch()) {
   $post = [
      'title' => $row['titre'],
      'content' => $row['contenu'],
      'frenchCreationDate' => $row['date_creation_fr'],
   ];

   $posts[] = $post;
}
?>

<!DOCTYPE>
<html>

<head>
   <meta charset="utf-8" />
   <title>Le blog de l'AVBN</title>
   <link href="style.css" rel="stylesheet" />
</head>

<body>
   <h1>Le super blog de l'AVBN !</h1>
   <p>Derniers billets du blog :</p>

   <?php
   
   foreach($posts as $post) {
   ?>
      <div class="news">
         <h3>
            <?php echo htmlspecialchars($post['title']); ?>
            <em>le <?php echo $post['frenchCreationDate']; ?></em>
         </h3>
         <p>
            <?php
            // On affiche le contenu du billet
            echo nl2br(htmlspecialchars($post['content']));
            ?>
            <br />
            <em><a href="#">Commentaires</a></em>
         </p>
      </div>
   <?php
   } 
   ?>
</body>

</html>