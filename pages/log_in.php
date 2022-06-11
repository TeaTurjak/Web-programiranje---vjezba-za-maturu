<!DOCTYPE html>
<html lang="en">
<?php 
include '../db/db_connect.php';
session_start();
if (isset($_SESSION['ime'])){
  header('location: odabirIspita.php');
}
echo $_SESSION['ime'];
if (isset($_POST['email']) and isset($_POST['lozinka'])) {
  $stmt = $pdo->prepare('select * from korisnici where email = :email');
 
  try{
    $stmt->execute(array(
      ':email' => $_POST['email']
    ));
    $result = $stmt->fetch();
    if (password_verify($_POST['lozinka'], $result['lozinka'])){
      $_SESSION['ime'] = $_POST['ime'];
      $_SESSION['id_korisnika'] = $result['id'];
      header('location: odabirIspita.php');
    }
   
  }catch(\PDOException $e){

  }
 
}
?>
<head>
  <title>Log in</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="..\css\main.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="..\scripts\login.js"></script>

</head>
<body>
  <nav class="navbar navbar-expand-sm bg-black navbar-dark fixed-top ">
    <div class="container-fluid p-1">
      <a class="navbar-brand" href="#">
        <img src="..\images\gradcap.jpg" alt="Logo" style="width:40px;" class="rounded-pill">
        EasyMatura
      </a>
      <div class="text-white p-2">
        <h1>Priprema za maturu iz Hrvatskog jezika</h1>
      </div>

      <div class="d-grid gap-2 d-md-flex justify-content-md-end p-1">
        <a href="..\pages\homepage.php" class="btn btn-secondary p-0.5">Povratak na početnu stranicu</a>
       </div>
    </div>
  </nav>

  <div class="container-fluid " style="width:100%; margin-top:100px">
    <div class="container h-100 ">
      <div class="row">
        <div class="col mt-5">
          <div class="card" style="border-radius: 1rem;"> 
            <div class="row">

             
                <div class="card-body p-4 p-lg-5 text-black">
  
                    <div class="d-flex align-items-center mb-3 pb-1">
                        <div class="row">
                            <h1 class="fw-bold mb-0">Easy matura</h1>
                            <h5 class="fw-normal mb-2 pb-3 mt-3">Prijavi se na svoj račun</h5>
                        </div>
                    </div>

                    <form method = "post" action = "log_in.php">
                    <div class="form-outline mb-4">
                      <label class="form-label" for="e-mail_input">Email adresa:</label>
                      <input name="email" type="email" id="username" class="form-control form-control-lg" onclick="validateEmailForm()" onkeyup="validateEmailForm()" placeholder="ime.prezime@gmail.com"/>
                      <div id="error-Username" class="text-danger"></div>
                    </div>
  
                    <div class="form-outline mb-4">
                      <label class="form-label" for="pass_input">Lozinka:</label>
                      <input name="lozinka" type="password" id="password" class="form-control form-control-lg"  onclick="validatePasswordForm()" onkeyup="validatePasswordForm()" placeholder="lozinka"/>
                      <div id="error-Password" class="text-danger"></div>
                    </div>
  
                    <div class="pt-1 mb-4">
                      <button class="btn btn-dark btn-lg btn-block" type="submit" id="Login_btn" >Prijava</button>
                    </div>

                    <p class="mb-5 pb-lg-2 text-muted mt-5 mb-0">Nemaš račun? <a href="..\pages\register.php" class="fw-bold text-body"><u>Registriraj se ovdje</u></a></p>
  
                </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</body>
    



