<?php

include 'head.php';
?>

<!DOCTYPE html>
<html>
<?php include'head.php'; ?>
<body>
<header class="header_section">
      <div class="header_top py-1" style="background-color:#313858;">
        <div class="container-fluid">
          <div class="top_nav_container py-1" class="h-8 w-8">
            <img src="../assets/images/logo1.png" alt="" srcset="" class="h-8 ">
            <p style="color:white">IFP LEADER EN INFORMATIQUE</p>
          </div>

        </div>
      </div>
      <div class="header_bottom  py-1">
        <div class="container-fluid ">
          <nav class="navbar navbar-expand-lg custom_nav-container p-1 h-4">
            <a class="navbar-brand text-lg" href="index.html">
              <span>
               IFPLI
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ">
                <li class="nav-item ">
                  <a class="nav-link" href="index.php">Accueil </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Filière </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link cursor-pointer" >Scolarité</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link cursor-pointer">Deconnexion</a>
                </li>
              <div class="flex justify">
              <li class="nav-item active">

<img class="w-10 h-10 p-1 rounded-full ring-2 ring-gray-300 dark:ring-gray-500" src="../assets/images/infographe1.jpg" alt="Bordered avatar">

                  <a class="nav-link " href="profil.php">Profil <span class="sr-only">(current)</span></a>
                </li>
              </div>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>


<?php include 'footer.php'?>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>