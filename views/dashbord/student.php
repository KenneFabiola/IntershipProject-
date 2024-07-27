<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'StudentController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'RoleController.php';

?>

<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<?php include 'message.php'; ?>

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
                <li class="nav-item active">
                  <a class="nav-link" href="student.php">Etudiant</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link cursor-pointer " href="education.php" onclick="openEducatio(this)">Scolarité</a>
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


      <?php

      ?>
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
            <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 rpunded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
          </div>
        </div>

        <div class="flex justify-between">
          <button type="button" id="openModalStudent" class="cursor-pointer text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-3 py-3 text-center me-2 mb-2">
            <i class="fas fa-user-plus"></i> New Student
          </button>
        </div>

        <!-- table -->
        <table class="w-full text-sm text-left rtl-text-right text-gray-900 ">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>
              <!-- <th scope="col" class="p-4">
                      <div class="flex items-center">
                          <input type="checkbox" id="chechkbox-all-search" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                          <label for="checkbox-all-search" class="sr-only">check</label>
                      </div>
                  </th> -->
              <th scope="col" class="px-6 py-3">
                id
              </th>
              <th scope="col" class="px-6 py-3">
                Nom d'utilisateur
              </th>
              <th scope="col" class="px-6 py-3">
                Firstname
              </th>
              <th scope="col" class="px-6 py-3">
                Lastname
              </th>
              <th scope="col" class="px-6 py-3">
                Adresse Email
              </th>
              <th scope="col" class="px-6 py-3">
                Statut
              </th>

              <th scope="col" class="px-6 py-3">
                Crée par
              </th>
              <th scope="col" class="px-6 py-3">
                Modifié par
              </th>


              <th scope="col" class="px-6 py-3">
                Action
              </th>
              
            </tr>
          </thead>
          <?php


          ?>
          <tbody>
           
              
            <?php if (!empty($students)) : ?>
              <?php foreach ($students as $studentdata) : ?>
                <tr>
                  <td class="py-2 px-4"><?= ($studentdata['id']); ?></td>
                  <td class="py-2 px-4"><?= htmlspecialchars($studentdata['username']); ?></td>
                  <td class="py-2 px-4"><?= htmlspecialchars($studentdata['first_name']); ?></td>
                  <td class="py-2 px-4"><?= htmlspecialchars($studentdata['last_name']); ?></td>
                  <td class="py-2 px-4"><?= htmlspecialchars($studentdata['email']); ?></td>
                  <td class="py-2 px-4"><?= htmlspecialchars($studentdata['statut']); ?></td>
                  <td class="py-2 px-4"><?= htmlspecialchars($studentdata['created_by_username']); ?></td>
                  <td class="py-2 px-4"><?= htmlspecialchars($studentdata['last_modified_by_username']); ?></td>
                  <td class="py-2 px-4">
                    <div class="justify between">
                      <a href="#" data_student_id="<?= $studentdata['id'] ?>" data_student_username="<?= $studentdata['username'] ?>" data_student_firstname="<?= $studentdata['first_name'] ?>" data_student_last_name="<?= $studentdata['last_name'] ?>" data_student_email="<?= $studentdata['email'] ?>" data_student_last_modified_by_username="<?= $studentdata['last_modified_by_username'] ?>" class="font-meduim text-blue-600 hover:underline" onclick="openEditStudentModal(this)"><i class="fas fa-edit"></i></a>


                      <button data_student_id="<?= $studentdata['id'] ?>"
                       class="font-meduim text-red-600 hover:underline"
                        onclick="openStudent(this)"><i class="fas fa-trash"></i></button>

                    </div>
                  </td>
                  

                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="5" class="py-2 px-4">Aucun utilisateur trouvé.</td>
              </tr>
            <?php endif; ?>
          </tbody>

        </table>


        <!-- table -->
        <table class="w-full text-sm text-left rtl-text-right text-gray-900 ">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
            <tr>

              <th scope="col" class="px-6 py-3">
                Nom d'utilisateur
              </th>
              <th scope="col" class="px-6 py-3">
                Firstname
              </th>
              <th scope="col" class="px-6 py-3">
                Statut
              </th>
              <th scope="col" class="px-6 py-3">
                Compte utilisateur
              </th>
            </tr>
          </thead>
          <?php


          ?>
          <tbody>
            <?php if (isset($students['error'])) : ?>
              <tr>
                <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($users['error']); ?></td>
              </tr>
            <?php elseif (!empty($students)) : ?>
              <?php foreach ($students as $studentdata) : ?>
                <tr>
                  <td class="py-2 px-4"><?= htmlspecialchars($studentdata['username']); ?></td>
                  <td class="py-2 px-4"><?= htmlspecialchars($studentdata['first_name']); ?></td>
                  <td class="py-2 px-4 <?php if (htmlspecialchars($studentdata['statut']) === "etudiant") {
                                          echo "text-blue-600";
                                        } else {
                                          echo "text-red-600";
                                        } ?> "><?= htmlspecialchars($studentdata['statut']); ?></td>
                  <?php if (htmlspecialchars($studentdata['statut']) === "etudiant") { ?>

                    <td class="py-2 px-4">
                     
                        <button type="button" class="text-blue-500"
                         data-student_id="<?= $studentdata['id'] ?>"
                          data-student_username="<?= $studentdata['username'] ?>"
                            data-student_firstname="<?= $studentdata['first_name'] ?>"
                            data-student_last_name="<?= $studentdata['last_name'] ?>"
                              data-student_email="<?= $studentdata['email'] ?>"
                              onclick="openAccount(this)"><i class="fas fa-user"></i>
                            </button>
                            </td>
                      <?php } else {
                      ?>
                      <td class="py-2 px-4">
                      
                        <button type="button" class="text-red-500" data-studentIdDisable ="<?= $studentdata['id'] ?>"
                        data-studentNameDisable ="<?= $studentdata['username'] ?>"
                         onclick="disableStudent(this)">
                          <i class="fas fa-user-slash"></i>
                        </button>
                      <?php } ?>
                     
                    </td>
                   
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="5" class="py-2 px-4">Aucun Etudiant trouvé.</td>
              </tr>
            <?php endif; ?>
          </tbody>

        </table>

      </div>


      <?php include 'studentModal.php'; ?>
      <?php include 'footer.php'; ?>

</body>

</html>