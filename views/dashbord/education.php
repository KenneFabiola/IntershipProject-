<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'TuitionController.php';
?>


<!DOCTYPE html>
<html>
<?php include'head.php'; ?>
<body>
  <div class="hero_area">
    <!-- header section strats -->
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
                  <a class="nav-link" href="dashbord.php">Accueil </a>
                </li>
                <li class="nav-item ">
                  <a class="nav-link" href="program.php">Filière <span class="sr-only">(current)</span> </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link cursor-pointer" >Scolarité</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link cursor-pointer">Deconnexion</a>
                </li>
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
                    <path stroke="currentColor" stroke-linecap= "round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
              </div>
              <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 rpunded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">   
          </div>      
      </div>
          
  <div class="flex justify-start content-start">
      <button type="button" id="sectionButton"  class="cursor-pointer text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-3 py-3 text-center me-2 mb-2">
        <i class="fas fa-user-plus"></i>  New Section
      </button>
      <button type="button" id="registrationButton"  class="cursor-pointer text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-3 py-3 text-center me-2 mb-2" onclick="openRegistration(this)" >
        <i class="fas fa-save"></i>  New Registration
      </button>
      <button href="tuitionTable.php" type="button" id="tuitionButton"  class="cursor-pointer text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-3 py-3 text-center me-2 mb-2" onclick="openAddTuition()" >
        <i class="fas fa-credit-card"></i>  New Tuition
      </button>
  </div>

      <!-- table -->
      <table class="w-full text-sm text-left rtl-text-right text-gray-900 ">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
              <tr>
                  <th scope="col" class="p-4">
                      <div class="flex items-center">
                          <input type="checkbox" id="chechkbox-all-search" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                          <label for="checkbox-all-search" class="sr-only">check</label>
                      </div>
                  </th>
                  <th scope="col" class="px-6 py-3">
                      id
                  </th>
                  <th scope="col" class="px-6 py-3">
                     Nom de la filière
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Frais de scolarité
                  </th>
                  <th scope="col" class="px-6 py-3">
                      Durée 
                  </th>
                  <th scope="col" class="px-6 py-3">
                     Créer par 
                  </th>
                  <th scope="col" class="px-6 py-3">
                     Modifier par
                  </th>
                  <th scope="col" class="px-6 py-3">
                  Date de création
                  </th>
                  
                  <th scope="col" class="px-6 py-3">
                      Action
                  </th>
              </tr>
          </thead>
          <?php
          

          ?>
          <tbody>
          <?php if (isset($tuition['error'])): ?>
                <tr>
                    <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($users['error']); ?></td>
                </tr>
            <?php elseif (!empty($tuition)): ?>
                <?php foreach ($tuition as $tuitiondata): ?>
                    <tr>
                        <td class="py-2 px-4"><?= $tuitiondata->getId(); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($tuitiondata->getSectionId()); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($tuitiondata->getProgram()); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($tuitiondata->getProgramId()); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($tuitiondata->getAmount()); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($tuitiondata->getCreatedBy()); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($tuitiondata->getLastModifiedBy()); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($tuitiondata-> getDeleted()); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($tuitiondata->getDeleted()); ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="py-2 px-4">Aucun utilisateur trouvé.</td>
                </tr>
            <?php endif; ?>
          </tbody>     
                
      </table>
                  
  </div>                




<?php include'sectionModal.php';?>
<?php include'tuitionModal.php';?>
<?php include'footer.php'; ?>

</body>
</html>