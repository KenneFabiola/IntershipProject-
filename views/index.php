<!DOCTYPE html>
<html>


<?php include'head.php'; ?>

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top py-1" style="background-color:#313858;">
        <div class="container-fluid">
          <div class="top_nav_container py-1">
            <img src="../assets/images/logo1.png" alt="" srcset="" style="height: 50px;width: 50px;">
            <p style="color:white">IFP LEADER EN INFORMATIQUE</p>
          </div>

        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.html">
              <span>
               IFPLI
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ">
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link cursor-pointer" id="openSignUp" >Inscription</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link cursor-pointer" id="openModal">Connexion</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Bienvenue à l'IFPLI !
                    </h1>
                    <p>
                      Bienvenu sur le site de l'institut de formation professionnel le Leader en Informatique
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="../assets/images/defili4.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Bienvenue à l'IFPLI !
                    </h1>
                    <p>
                      Bienvenu sur le site de l'institut de formation professionnel le Leader en Informatique.
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="../assets/images/infographe1.jpg" alt="" class="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Bienvenue à l'IFPLI !
                    </h1>
                    <p>
                      Bienvenu sur le site de l'institut de formation professionnel le Leader en Informatique.
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                  <img src="../assets/images/MI_4.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h1>
                      Bienvenue à l'IFPLI !
                    </h1>
                    <p>
                      Bienvenu sur le site de l'institut de formation professionnel le Leader en Informatique.
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="../assets/images/temoignage1.jpg" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="carousel_btn_box">
          <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div> -->
      </div>
    </section>
  </div>

<!-- sign_in-->
 <?php include 'signIn.php'; ?>
<!-- modal sign_up -->
<?php include 'signUp.php'; ?>
<!-- footer -->
<?php include'footer.php'; ?>
</body>
</html>