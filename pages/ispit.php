<?php 
include '../db/db_connect.php';
session_start();
$stmt = $pdo->prepare('select * from pitanja where nizaVisa = :nizaVis and jezikKnjizevnost = :jK and imaTekst = :polazni order by rand()');
$stmt->execute(array(
  ':nizaVis' => $_SESSION['razina'],
  ':jK' => $_SESSION['kategorija'],
  ':polazni' => $_SESSION['polazniTekst']
));
$result = $stmt->fetchAll();
if($_SESSION['polazniTekst'] == 1){
    $tekst = $pdo->prepare('select * from pitanja left join tekst on pitanja_id = pitanja.id where nizaVisa = :nizaVis and jezikKnjizevnost = :jK and imaTekst = :polazni order by rand()');
    $tekst->execute(array(
        ':nizaVis' => $_SESSION['razina'],
        ':jK' => $_SESSION['kategorija'],
        ':polazni' => $_SESSION['polazniTekst']
      ));
    $resultTekst = $tekst->fetchAll();
}
if (!isset($_POST['rezultat'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Priprema za maturu iz Hrvatskog jezika</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="..\scripts\ispit.js"></script>

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
        <a href="..\pages\log_in.php" class="btn btn-secondary p-0.5">
            <span class="glyphicon glyphicon-th-list"></span> Odjava
        </a>  
        </div>
    </div>
  </nav>

    
 <div class="container-fluid p-lg-5 mt-5">
 <?php 
 $kategorija = "";
 $polazniTekst = "";
    if($_SESSION['kategorija'] == 0){
        $kategorija = "Jezik";
    }
    else{
        $kategorija = "Književnost";
    }

    if($_SESSION['kategorija'] == 1){
        if($_SESSION['polazniTekst'] == 1){
            $polazniTekst = "s polaznim tekstom";
        }
        else{
            $polazniTekst = "bez polaznog teksta";
        }
    }
    
     echo'<h1 class="text-center">Ispit iz područja: '. ($kategorija) .' '.($polazniTekst).'</h1>';


     ?>

     <div class="container-fluid d-flex justify-content-center" id="pitanje" style="border: 2px groove black; width:1000px" >
        <div class="row">
        <?php 
        $counter = 1;
        
        $counterJezik=25;
        $counterPolazni=30;
        $counterBezPolazni=25;


        if($kategorija=="Jezik"){
          for($i = 0; $i< $counterJezik; $i++){
            //if($_SESSION['polazni'] == 1) TODO dodati ako ima polazni onda 30 pitanja u suprotnom 25
             
            $odgovori = $pdo->prepare('select * from odgovori where pitanja_id = :id order by rand()');
            $odgovori->execute(array(
              ':id' => $result[$i]['id'],
            ));
            $odgovoriResult = $odgovori->fetchAll();
            //echo '<pre>' . var_export($odgovoriResult, true) . '</pre>';
           
            if($_SESSION['polazniTekst'] == 1 && $i%3==0){
                echo '<p class="fs-6 fst-italic" id="polazniTekst"> '.$resultTekst[$i]['tekstValue'].'</p>';
            }
               
              echo '<p id="pitanje" class="fs-5" style= "width:500px;">'. ($counter) .'. '.$result[$i]['pitanjeValue'].'</p>';
              $counter+=1;
           
              for($j = 0; $j < count($odgovoriResult); $j++){
                  echo ' <div class="list-group">
                  <label class="list-group-item">
                      <input class="form-check-input me-1" type="radio" value="" name="'.$odgovoriResult[$j]['pitanja_id'].'" id="'.$odgovoriResult[$j]['id'].'">
                   '.$odgovoriResult[$j]['odgovorValue'].'
                  </label> 
              
                    </div>';
              }          
          }
        }
        if($kategorija=="Književnost"){
          if($polazniTekst=="s polaznim tekstom"){
            for($i = 0; $i< $counterPolazni; $i++){
              //if($_SESSION['polazni'] == 1) TODO dodati ako ima polazni onda 30 pitanja u suprotnom 25
               
              $odgovori = $pdo->prepare('select * from odgovori where pitanja_id = :id order by rand()');
              $odgovori->execute(array(
                ':id' => $result[$i]['id'],
              ));
              $odgovoriResult = $odgovori->fetchAll();
              //echo '<pre>' . var_export($odgovoriResult, true) . '</pre>';
             
              if($_SESSION['polazniTekst'] == 1 && $i%3==0){
                  echo '<p class="fs-6 fst-italic" id="polazniTekst"> '.$resultTekst[$i]['tekstValue'].'</p>';
              }
                 
                echo '<p id="pitanje" class="fs-5" style= "width:500px;">'. ($counter) .'. '.$result[$i]['pitanjeValue'].'</p>';
                $counter+=1;
             
                for($j = 0; $j < count($odgovoriResult); $j++){
                    echo ' <div class="list-group">
                    <label class="list-group-item">
                        <input class="form-check-input me-1" type="radio" value="" name="'.$odgovoriResult[$j]['pitanja_id'].'" id="'.$odgovoriResult[$j]['id'].'">
                     '.$odgovoriResult[$j]['odgovorValue'].'
                    </label> 
                
                      </div>';
                }          
            }
          }

          if($polazniTekst=="bez polaznog teksta"){
            for($i = 0; $i< $counterBezPolazni; $i++){
              //if($_SESSION['polazni'] == 1) TODO dodati ako ima polazni onda 30 pitanja u suprotnom 25
               
              $odgovori = $pdo->prepare('select * from odgovori where pitanja_id = :id order by rand()');
              $odgovori->execute(array(
                ':id' => $result[$i]['id'],
              ));
              $odgovoriResult = $odgovori->fetchAll();
              //echo '<pre>' . var_export($odgovoriResult, true) . '</pre>';
             
              if($_SESSION['polazniTekst'] == 1 && $i%3==0){
                  echo '<p class="fs-6 fst-italic" id="polazniTekst"> '.$resultTekst[$i]['tekstValue'].'</p>';
              }
                 
                echo '<p id="pitanje" class="fs-5" style= "width:500px;">'. ($counter) .'. '.$result[$i]['pitanjeValue'].'</p>';
                $counter+=1;
             
                for($j = 0; $j < count($odgovoriResult); $j++){
                    echo ' <div class="list-group">
                    <label class="list-group-item">
                        <input class="form-check-input me-1" type="radio" value="" name="'.$odgovoriResult[$j]['pitanja_id'].'" id="'.$odgovoriResult[$j]['id'].'">
                     '.$odgovoriResult[$j]['odgovorValue'].'
                    </label> 
                
                      </div>';
                }          
            }
          }

        }
        
        /*
        for($i = 0; $i< count($result); $i++){
          //if($_SESSION['polazni'] == 1) TODO dodati ako ima polazni onda 30 pitanja u suprotnom 25
           
          $odgovori = $pdo->prepare('select * from odgovori where pitanja_id = :id');
          $odgovori->execute(array(
            ':id' => $result[$i]['id'],
          ));
          $odgovoriResult = $odgovori->fetchAll();
          //echo '<pre>' . var_export($odgovoriResult, true) . '</pre>';
         
          if($_SESSION['polazniTekst'] == 1 && $i%3==0){
              echo '<p class="fs-6 fst-italic" id="polazniTekst"> '.$resultTekst[$i]['tekstValue'].'</p>';
          }
             
            echo '<p id="pitanje" class="fs-5" style= "width:500px;">'. ($counter) .'. '.$result[$i]['pitanjeValue'].'</p>';
            $counter+=1;
         
            for($j = 0; $j < count($odgovoriResult); $j++){
                echo ' <div class="list-group">
                <label class="list-group-item">
                    <input class="form-check-input me-1" type="radio" value="" name="'.$odgovoriResult[$j]['pitanja_id'].'" id="'.$odgovoriResult[$j]['id'].'">
                 '.$odgovoriResult[$j]['odgovorValue'].'
                </label> 
            
                  </div>';
            }          
        }
        */
        ?>      
 
     </div>
     </div>
  </div>
     

  <div class="mb-5 d-flex justify-content-center">
      <a class="btn btn-success btn-lg btn-block" type="submit" id="Exit_btn">Završi test</a>
      <a class="btn btn-success btn-lg btn-block" style="display:none" type="submit" id="Završni_btn">Završi pregled</a>
  </div>
</body>
  <?php 
}

  if (isset($_POST['rezultat'])){
    //$rezultat = $_POST['rezultat'];
    $rezultat = trim($_POST['rezultat'], ' ');
    echo $rezultat;
    
    $stmt = $pdo->prepare('insert into rezultati (id_korisnika, nizaVisa, jk, rezultat, polazni) values (:id_korisnika, :nizaVisa, :jk, :rezultat, :polazni)');
      try{
        $stmt->execute(array(
          ':id_korisnika' => $_SESSION['id_korisnika'],
          ':nizaVisa' => $_SESSION['razina'],
          ':jk' => $_SESSION['kategorija'],
          ':rezultat' => $_POST['rezultat'],
          ':polazni' => $_SESSION['polazniTekst'],
        ));
        
      }catch(\PDOException $e){
  
      }
  }       
        
   ?>   


    



