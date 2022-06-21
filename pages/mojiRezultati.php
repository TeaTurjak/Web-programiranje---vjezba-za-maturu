<?php
  include '../db/db_connect.php';
  session_start();

  echo $_SESSION['id_korisnika'];

  $stmt = $pdo->prepare('select * from rezultati where id_korisnika = :id');
  $stmt->execute(array(
  ':id' => $_SESSION['id_korisnika']
  ));
  
  $rezultatiKorisnika = $stmt->fetchAll(); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
 
  <title>Priprema za maturu iz Hrvatskog jezika</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="..\css\chart.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cdbootstrap/css/bootstrap.min.css"/>

</head>
<body>
  
  <nav class="navbar navbar-expand-sm bg-black navbar-dark fixed-top">
    <div class="container-fluid p-1">
      <a class="navbar-brand" href="#">
        <img src="..\images\gradcap.jpg" alt="Logo" style="width:40px;" class="rounded-pill">
        EasyMatura
      </a>

      <div class="text-white p-2">
        <h1>Priprema za maturu iz Hrvatskog jezika</h1>
      </div>

      <div class="d-grid gap-2 d-md-flex justify-content-md-end p-1">
      <a href="..\pages\odabirIspita.php" class="btn btn-secondary p-0.5">
            <span class="glyphicon glyphicon-th-list"></span> Nazad
        </a>
        <a href="..\pages\homepage.php" class="btn btn-secondary p-0.5">
            <span class="glyphicon glyphicon-th-list"></span> Odjava
        </a>
    </div>
    </div>
  </nav>
  

  <div class="container-fluid " style="width:100%; margin-top:100px">
    <h2 class="page-header">Rezultati:</h2>
    <?php
  for($i = 0; $i< count($rezultatiKorisnika); $i++){     
    if($rezultatiKorisnika[$i]['nizaVisa'] == '1'){
      echo '<p class="fs-6 fst-italic" > Viša </p>';
    }
    else{
      echo '<p class="fs-6 fst-italic" > Niža </p>';
    }
   
    if($rezultatiKorisnika[$i]['jk'] == '0'){
      echo '<p class="fs-6 fst-italic" > Jezik </p>';
    }
    else{
      if($rezultatiKorisnika[$i]['polazni'] == '0'){
        echo '<p class="fs-6 fst-italic" > Književnost bez polaznog teksta</p>';
      }
      else{
        echo '<p class="fs-6 fst-italic" > Književnost s polaznim tekstom</p>';
      }
     
    }
    echo '<p class="fs-6 fst-italic" > '.$rezultatiKorisnika[$i]['datum'].'</p>';
    echo '<p class="fs-6 fst-italic" > '.$rezultatiKorisnika[$i]['rezultat'].' %</p>';
  } 
    ?>
  </div> 
  
</body>

    
