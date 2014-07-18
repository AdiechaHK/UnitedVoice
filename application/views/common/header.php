<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="UnitedVoice, United, Voice">
    <meta name="author" content="Harikrushna Adiecha">
    <link rel="shortcut icon" href=<?php echo "\"".base_url("public/img/icon.png")."\""; ?>>
    <script src=<?php echo "\"".base_url("public/js/jquery-1.10.2.min.js")."\""; ?>></script>
    <script src=<?php echo "\"".base_url("public/js/bootstrap.min.js")."\""; ?>></script>
    <title>
      <?php
      if(isset($title)) {
        echo $title;
      } else {
        echo "United Voice";  
      }
      ?>      
    </title>

    <!-- Bootstrap core CSS -->
    <link href=<?php echo "\"".base_url("public/css/bootstrap.css")."\""; ?> rel="stylesheet">
    <?php foreach ($css as $css_name) { ?>
    <link href=<?php echo "\"".base_url("public/css/".$css_name.".css")."\""; ?> rel="stylesheet">
    <?php } ?>

  </head>
  <body>

    <!-- Wrap all page content here -->
    <div id="wrap">
