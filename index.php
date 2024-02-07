<!DOCTYPE html>
<html lang="it">
<head>
  <title>TPSit.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <meta name="author" content="Bernardi Nicola">
  <meta name="description" content="TPSitcom, il primo Twitter dell'informatica">
  <style>
      table {
          border:solid;
          width:100%;
      }
      td, tr {
          border:solid;
          font:100%;
          text-align:center;
          height:60px;
      }
      label {
          display:block;
          text-align:center;
      }
      input {
          width:100%;
          text-align:center;
      }
      input[type=submit] {
          margin-left:0px;
          margin-top:5px;
          margin-bottom:10px;
      }
      input[type=text] {
        width:100%;
        text-align:center;
      }
      form {
        text-align:center;
      }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">TPSIT.com</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="php/search.php">Search</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Chat</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile" href="php/profilo.php">Profilo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="php/accesso.php" id="log">Accedi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="php/registrazione.php" id="reg">Registrati</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="" id="logout" style="display:none;" onclick="document.cookie='logged=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>TPSIT.com</h1>
  <p>Il social per gli informatici</p> 
</div>
      <?php
          require("php/mustuse.php");
      ?>
  
<div class="container mt-5">
  <div class="row">
    <div class="col-sm-4">
    </div>
    
    <div class="col-sm-4">
      
    </div>
    
    <div class="col-sm-4">
      <?php
        //require("php/dbpdo.php");
      ?>
    </div>
    
  </div>
</div>

</body>
</html>
