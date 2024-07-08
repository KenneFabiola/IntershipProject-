<?php 
 require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'ProgramController.php';

include 'authorisation.php';
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
                  <a class="nav-link" href="index.php">Accueil </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="program.php">Filière <span class="sr-only">(current)</span> </a>
                </li>
                <li class="nav-item">
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
          
  <div class="flex justify-between">
      <button type="button" id="openAddModalProgram"  class="cursor-pointer text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-3 py-3 text-center me-2 mb-2">
        <i class="fas fa-user-plus"></i>  New pogram
      </button>
  </div>

      <!-- table -->
      <table class="w-full text-sm text-left rtl-text-right text-gray-900 ">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
              <tr>
                 
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
                  Deleted
                  </th>
                  
                  <th scope="col" class="px-6 py-3">
                      Action
                  </th>
              </tr>
          </thead>
          <?php
          

          ?>
          <tbody>
          <?php if (isset($programs['error'])): ?>
                <tr>
                    <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($users['error']); ?></td>
                </tr>
            <?php elseif (!empty($programs)): ?>
                <?php foreach ($programs as $programdata): ?>
                    <tr>
                        <td class="py-2 px-4"><?= htmlspecialchars($programdata['id']); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($programdata['program_name']); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($programdata['descriptive']); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($programdata['duration']); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($programdata['created_by_username']); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($programdata['last_modified_by_username']); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($programdata['created_at']); ?></td>
                        <td class="py-2 px-4"><?= htmlspecialchars($programdata['deleted']); ?></td>
                        <td class="py-2 px-4">
                            <div class="justify between">
                                        <a href="#" id="" data-student_id= "<?= $studentdata['id'] ?>" 
                                        data-student_username= "<?= $studentdata['username'] ?>"
                                        data-firstname= "<?= $studentdata['last_name'] ?>"
                                        data-lastname= "<?= $studentdata['pwd'] ?>"
                                        data-email= "<?= $studentdata['program']?>"
                                        data-pwd= "<?= $userdata['pwd'] ?>"
                                        class="font-meduim text-blue-600 hover:underline" onclick="openEditModal(this)"><i class="fas fa-edit"></i></a> 
                                      

                                        <button  data_program_id= "<?= $programdata['id'] ?>" class="font-meduim text-red-600 hover:underline" onclick="openProgram(this)"><i class="fas fa-trash"></i></button> 
                              </div>
                        </td>
                        
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

<?php include'programModal.php';?>

<?php include'footer.php'; ?>

</body>
</html>