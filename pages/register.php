<!DOCTYPE html>
<html lang="en">
<?php 
include '../db/db_connect.php';
session_start();
if (isset($_POST['ime']) and isset($_POST['email'])  and isset($_POST['lozinka']) and isset($_POST['lozinka_confirm'])) {
    $stmt = $pdo->prepare('insert into korisnici (ime_prezime, email, lozinka) values (:ime , :email, :lozinka)');
   $password = password_hash($_POST['lozinka'], CRYPT_BLOWFISH);
    try{
      $stmt->execute(array(
        ':ime' => $_POST['ime'],
        ':email' => $_POST['email'],
        ':lozinka' => $password
      ));
      $stmt = $pdo->prepare('select * from korisnici where email = :email');
      $stmt->execute(array(   
        ':email' => $_POST['email']
      ));
      $result = $stmt->fetch();
      $id_korisnika = $result['id'];
      $_SESSION['ime'] = $_POST['ime'];
      $_SESSION['id_korisnika'] =  $id_korisnika;
    }catch(\PDOException $e){

    }
    header('location: odabirIspita.php');
}
?>
<head>
  <title>Registracija</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="..\css\main.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="..\scripts\register.js"></script>
</head>
<body>

  <nav class="navbar navbar-expand-sm bg-black navbar-dark fixed-top ">
    <div class="container-fluid p-1">
      <a class="navbar-brand" href="#">
        <img src="..\images\gradcap.jpg" alt="Logo" style="width:40px;" class="rounded-pill">
        EasyMatura
      </a>
      <div class="text-white  p-2">
        <h1>Priprema za maturu iz Hrvatskog jezika</h1>
    </div>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end p-1">
      <a href="..\pages\homepage.php" class="btn btn-secondary p-0.5">
          <span class="glyphicon glyphicon-th-list"></span> Povratak na početnu stranicu
      </a>
  </div>


  </nav>

  <div class="container-fluid " style="width:100%; margin-top:100px">
    <section class="vh-100" >
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6">
              <div class="card" style="border-radius: 15px;">
                <div class="card-body p-5">
                  <h2 class="text-uppercase text-center mb-5">Kreiraj novi račun</h2>
    
                  <form method = "post" action = "register.php">
    
                    <div class="form-outline mb-4">
                      <label class="form-label">Korisničko ime</label>
                      <input name = "ime" type="text" id="regname" class="form-control form-control-lg" onclick="validateRegUserNameForm()" onkeyup="validateRegUserNameForm()" aria-describedby="regnameHelp" placeholder="ime prezime"/>
                      <div id="error-Username" class="text-danger"></div>
                    </div>
    
                    <div class="form-outline mb-4">
                      <label class="form-label" for="form3Example3cg">E-mail adresa:</label>
                      <input name="email" type="email" id="regemail" class="form-control form-control-lg" onclick="validateRegEmailForm()" onkeyup="validateRegEmailForm()" aria-describedby="emailHelp" placeholder="test.test@gmail.com" />
                      <div id="error-Email" class="text-danger"></div>
                    </div>
    
                    <div class="form-outline mb-4">
                      <label class="form-label">Lozinka:</label>
                      <input name="lozinka" type="password" id="regpass" class="form-control form-control-lg" onclick="validateRegPasswordForm()" onkeyup="validateRegPasswordForm()" aria-describedby="passwordHelp" placeholder="lozinka"/>
                      <div id="error-Password" class="text-danger"></div>
                    </div>
    
                    <div class="form-outline mb-4">
                      <label class="form-label" >Ponovljena lozinka:</label>
                      <input name="lozinka_confirm" type="password" id="regpassagain" class="form-control form-control-lg" onclick="validateRegPasswordAgainForm()" onkeyup="validateRegPasswordAgainForm()" aria-describedby="passwordHelp" placeholder="ponovljena lozinka"/>
                      <div id="error-PasswordAgain" class="text-danger"></div>
                    </div>
    
                    <div class="d-flex justify-content-center">
                      <button type="submit" class="btn btn-success btn-block btn-dark">Registriraj se</button>
                    </div>
    
                    <p class="text-center text-muted mt-5 mb-0">Već imaš račun? <a href="..\pages\log_in.php" class="fw-bold text-body"><u>Prijavi se ovdje</u></a></p>
    
                  </form>
    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
    
  
</body>
    



