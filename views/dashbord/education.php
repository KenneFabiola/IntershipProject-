<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'TuitionController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'SectionController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'StudentController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'RegistrationController.php';

include 'authorisation.php';
include 'message.php';


?>

<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body>
<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top py-1" style="background-color:#313858;">
        <div class="container-fluid">
          <div class="top_nav_container py-1" class="h-8 w-8">
            <img src="../../assets/images/logo1.png" alt="" srcset="" class="h-8 ">
            <p style="color:white">IFP LEADER EN INFORMATIQUE</p>
          </div>
        </div>
      </div>
      <div class="header_bottom  py-1">
        <div class="container-fluid ">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand text-lg" href="#">
              <span>
                IFPLI
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ">
                <li class="nav-item">
                  <a class="nav-link" href="dashbord.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="program.php">Filière </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="student.php">Etudiant</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link cursor-pointer " href="education.php">Scolarité</a>
                </li>
                <form action="../../api/controllers/AuthentificateController.php" method="POST">
                  <input type="hidden" name="logout" value="true">
                  <li class="nav-item">
                    <button type="submit" class="nav-link cursor-pointer">Déconnexion</button>
                  </li>
                </form>

                <li class="nav-item">
                  <a class="nav-link" href="profil.php">Profil</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
    <div class="px-2">

      <!-- table to get user -->
      <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="pb-4 bg-white dark-bg-gray-900">
          <label for="table-search" class="sr-only">Search</label>
          <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 flex items-center ps-3 pointer-events-none">
              <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
              </svg>
            </div>
            <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>


        <div class="absolute top-0 right-0">
          <div class="mt-4 pr-6">
            <button type="button" class=" inline-flex items-center cursor-pointer text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-3 py-3 text-center me-2 mb-2" onclick="openMultiDropdown(this)">
              Section <i class="fas fa-caret-down"></i>
            </button>

            <button type="button" class="inline-flex overflow-auto items-center cursor-pointer text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-3 py-3 text-center me-2 mb-2">
              Statistique <i class="fas fa-caret-down"></i>
            </button>
          </div>
          <!-- section -->
          <div id="optionForSection" class="block hidden absolute right-0 mt-1 z-50 bg-white shadow-lg rounded-lg divide-y divide-gray-900 bg-white w-44 rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none ">

            <ul class="py-1 text-sm text-gray-700 z-40">
              <button onclick="closeMultiDropdownS()"><i class="fas fa-times"></i></button>
              <li>
                <button class="block px-4 py-2" id="sectionButton"><i class="fas fa-add">Ajouter</i></button>
                <a href="#activeSection" class="block px-4 py-2"><i class="fas fa-eye"></i>Voir les sessions active</a>
                <a href="#finishSection" class="block px-4 py-2"><i class="fas fa-eye"></i>Voir les sessions session terminée</a>
              </li>

            </ul>
          </div>

        </div>

        <?php
        include 'sectionTable.php';
        // include 'tuitionTable.php';
        // include 'registrationTable.php';
        include 'sectionModal.php';
        include 'tuitionModal.php';
        include 'registrationModal.php';
        include 'footer.php';
        ?>
</body>

</html>