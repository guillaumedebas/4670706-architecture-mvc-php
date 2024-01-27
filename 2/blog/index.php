<?php
// We connect to database
try {
   $database = new PDO('mysql:host=localhost;dbname=oldblog;charset=utf8', 'root', '');
} catch (Exception $e) {
   die('Erreur : ' . $e->getMessage());
}

// We retrieve the 5 last blog posts.
$statement = $database->query(
   "SELECT id, titre, contenu, DATE_FORMAT(date_creation, '%d/%m/%Y à %Hh%imin%ss') AS 
   date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5"
   );

$post = [];
while ($row = $statement->fetch()) {
   $post = [
      'title' => $row['titre'],
      'content' => $row['contenu'],
      'frenchCreationDate' => $row['date_creation_fr'],
   ];

   $posts[] = $post;

}
require('templates/homepage.php');
?>