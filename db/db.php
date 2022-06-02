<?php 
include 'db_connect.php';
if(isset($_POST['id'])){
    $odgovori = $pdo->prepare('select * from odgovori where pitanja_id = :id and tocanOdg = 1');
          $odgovori->execute(array(
            ':id' => $_POST['id'],
          ));
          $odgovoriResult = $odgovori->fetch();
          echo json_encode($odgovoriResult);
}

?>