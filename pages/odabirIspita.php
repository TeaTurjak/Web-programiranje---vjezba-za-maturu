<!DOCTYPE html>
<html lang="en">
<?php 
include '../db/db_connect.php';
session_start();
echo $_SESSION['id_korisnika'];
if (isset($_POST['razina']) and isset($_POST['kategorija'])) {
 
 
  $_SESSION['razina'] = $_POST['razina'];
  $_SESSION['kategorija'] = $_POST['kategorija'];
  if(isset($_POST['polazniTekst'])){
    $_SESSION['polazniTekst'] = 1;
  }
  else{
    $_SESSION['polazniTekst'] = 0;
  }
    

  header('location: ispit.php');
  
}
?>
<head>
  <title>Priprema za maturu iz Hrvatskog jezika</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="..\css\main.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
$(document).ready(function(){
  $("#polazniCheckbox").hide();
 
  $("#knjizevnostCheck").click(function() {
    if($("#knjizevnostCheck").is(":checked")){
      $("#polazniCheckbox").show();
    }
    
    else {
      $("#polazniCheckbox").hide();
    }
  }); 
});
</script>
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
      <a href="..\pages\mojiRezultati.php" class="btn btn-secondary p-0.5">
            <span class="glyphicon glyphicon-th-list"></span> Moji rezultati
        </a>
        <a href="..\pages\homepage.php" class="btn btn-secondary p-0.5">
            <span class="glyphicon glyphicon-th-list"></span> Odjava
        </a>
        </div>
    </div>
  </nav>
    
 <div class="container-fluid p-lg-5 mt-5 bg-dark text-white">
 <p class="fs-5">Odaberi razinu:</p>

 <form action="odabirIspita.php" method="POST">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="visaCheck" name = "razina" onClick="ckChange(this)">
        <label class="form-check-label" for="visaCheckbox">
            Viša razina
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="0" id="nizaCheck" name = "razina" onClick="ckChange(this)">
        <label class="form-check-label" for="nizaCheckbox">
            Niža razina
        </label>
    </div>
 <p class="fs-5 mt-5">Odaberi kategoriju:</p>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="0" id="jezikCheck" name = "kategorija" onClick="ckChange(this)">
        <label class="form-check-label" for="jezikCheckbox">
            Jezik
        </label>
        </div>
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" id="knjizevnostCheck" name = "kategorija" onClick="ckChange(this)">
        <label class="form-check-label" for="knjizevnostCheckbox">
            Književnost
        </label>

         <div id="polazniCheckbox">
            <div class="form-check"  name="polazni">
            <input class="form-check-input" type="checkbox" value="1" id="polazniCheck" name = "polazniTekst" onClick="ckChange(this)">
            <label class="form-check-label" for="polazniCheckbox">
                S polaznim tekstom
            </label>
            </div>
            <!--  
              <div class="form-check"  name="polazni">
                <input class="form-check-input" type="checkbox" value="0" id="bezPolaznogCheck" name = "polazniTekst" onClick="ckChange(this)">
                <label class="form-check-label" for="bezPolaznogCheckbox">
                    Bez polaznog teksta
                </label>
              </div>
            -->
            
          </div>
    </div>
        <button class="btn btn-success btn-lg btn-block mt-5" type="submit" id="Start_btn">Započni test</button>
    </form>
        
 </div>


</body>

    



