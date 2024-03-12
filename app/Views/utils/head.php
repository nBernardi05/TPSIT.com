<!DOCTYPE html>
<html lang="it">
<head>
  <title><?= $title; ?> - TPSit.com</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <meta name="author" content="Bernardi Nicola">
  <meta name="description" content="TPSitcom, il primo Twitter dell'informatica">
  <?php
    if(isset($style)){
        echo view('utils/css/'. $style);
    }
    if(isset($script)){
        echo view('utils/js/'. $script);
    }
  ?>
  </head>
