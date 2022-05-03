<!DOCTYPE html>
<html lang="en">
<?php 
include '../db/db_connect.php';
session_start();
$stmt = $pdo->prepare('select odgovori.odgovorValue , pitanja.pitanjeValue from odgovori  right join pitanja on pitanja.id = pitanja_id where pitanja.nizaVisa = :nizaVis and pitanja.jezikKnjizevnost = :jK and pitanja.imaTekst = :polazni');
$stmt->execute(array(
  ':nizaVis' => $_SESSION['razina'],
  ':jK' => $_SESSION['kategorija'],
  ':polazni' => $_SESSION['polazniTekst']
));
$result = $stmt->fetchAll();
//echo var_dump($result);
echo '<pre>' . var_export($result, true) . '</pre>';
?>
<head>
  <title>Priprema za maturu iz Hrvatskog jezika</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <script src="..\scripts\odabirIspita.js"></script>

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
        <a href="..\pages\log_in.php" class="btn btn-secondary p-0.5">
            <span class="glyphicon glyphicon-th-list"></span> Odjava
        </a>
        </div>
    </div>
  </nav>

    
 <div class="container-fluid p-lg-5 mt-5">
     <h1 class="text-center">Ispit iz područja: Književnost bez polaznog teksta</h1>




     <div class="container-fluid d-flex justify-content-center" id="pitanje" style="border: 2px groove black; width:1000px" >
        <div class="row">
        <?php 
        $counter = 1;
        for($i = 0; $i< count($result); $i++){
          //if($_SESSION['polazni'] == 1) TODO dodati ako ima polazni onda 30 pitanja u suprotnom 25
            if($_SESSION['polazniTekst'] == 1){
   
              echo '<p class="fs-6 fst-italic" id="polazniTekst"></p>';
    
            }

            if($i==0 || $i%4 == 0){
           
            echo '<p id="pitanje" class="fs-5" style= "width:500px;">'. ($counter) .'. '.$result[$i]['pitanjeValue'].'</p>';
            $counter+=1;
            for($j = 0; $j < 4; $j++){
                
                echo ' <div class="list-group">
                <label class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" value="">
                 '.$result[$j]['odgovorValue'].'
                </label>
    
                
            </div>';
            }
           
          }
           

        }
        ?>

        
        
         
        

     </div>
     </div>




  </div>
     

  <div class="mb-5 d-flex justify-content-center">
      <button class="btn btn-success btn-lg btn-block" type="submit" id="Exit_btn">Završi test</button>
  </div>

</body>

    



