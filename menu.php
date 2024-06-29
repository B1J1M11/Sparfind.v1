<?php
include("server_connexion.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/headerStyle.css">
</head>
<body>

<header>
<nav class="navbar navbar-expand-lg" style="background-color: #F97000 ">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img class="logo" src="imports/logosfind.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link text-logo" aria-current="page" href="index.php">Accueil</a>
        </li>
      </ul>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <?php if (isset($_SESSION["user_id"])) {
                                        echo 
                '<img class="icon" src="imports/marker.svg" alt="">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-logo" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Meets
                    </a>
                    <ul class="dropdown-menu" style="background-color: #ff9a47">
                        <li><a class="dropdown-item text-logo" href="map.php">Carte des Meets</a></li>
                        <li><a class="dropdown-item text-logo" href="mesMeet.php">Gérer mes meets</a></li>
                    </ul>
                </li>'; }
                else {
                    echo 
                    '<img class="icon" src="imports/marker.svg" alt="">
                    <li class="nav-item">
                        <a class="nav-link text-logo" href="connexion.php">Meets</a>
                    </li>';
                }
            ?>

            <?php 
                if (isset($_SESSION["user_id"])) { echo
            '<img class="icon" src="imports/user.svg" alt="">
            <li class="nav-item">
                <a class="nav-link text-logo" href="compte.php">Mon compte</a>
            </li>'; }
            else {
                echo
                '<img class="icon" src="imports/user.svg" alt="">
                <li class="nav-item">
                    <a class="nav-link text-logo" href="connexion.php">Connexion</a>
                </li>';
            }
            ?>

            <img class="icon" src="imports/smartphone.svg" alt="">
            <li class="nav-item">
                <a class="nav-link text-logo" href="contact.php">Contact</a>
            </li>

        </ul>
    </div>
  </div>
</nav>

</header>    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>