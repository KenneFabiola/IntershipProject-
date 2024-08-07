<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'UserController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'RoleController.php';
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
                <li class="nav-item active">
                  <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="program.php">Filière </a>
                </li>
                <li class="nav-item">
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

    <div>

      <!-- <p class="hover:text-blue-500 cursor-pointer"> Bienvenu dans votre espace <?php echo $_SESSION['username']; ?></p> -->
    </div>
    <div class="px-2 py-2">

      <button type="button" class="cursor-pointer text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-3 py-3 text-center me-2 mb-2" onclick="viewUser(this)">
        <i class="fas fa-user-plus"></i> Utilisateur
      </button>
      <!-- table to get user -->
      <div id="userTable" class=" hidden relative overflow-x-auto shadow-md sm:rounded-lg">
        <button type="button" class="end-10 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeViewUser()">
          <i class="fas fa-times"></i>
        </button>
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
          <button type="button" class="cursor-pointer text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-3 py-3 text-center me-2 mb-2" onclick="openAddUser(this)">
            <i class="fas fa-user-plus"></i> New user
          </button>
        </div>

        <!-- table -->

        <table class="w-full text-sm text-left rtl-text-right text-gray-900 border-collapse border border-slate-500 ">
          <thead class="text-xs text-gray-700 uppercase bg-blue-300 ">
            <tr>

              <th scope="col" class="px-6 py-3 border border-slate-600 ">
                id
              </th>
              <th scope="col" class="px-6 py-3 border border-slate-600">
                Username
              </th>
              <th scope="col" class="px-6 py-3 border border-slate-600">
                Firstname
              </th>
              <th scope="col" class="px-6 py-3 border border-slate-600">
                Lastname
              </th>
              <th scope="col" class="px-6 py-3 border border-slate-600">
                Email
              </th>
              <th scope="col" class="px-6 py-3 border border-slate-600">
                Fonction
              </th>


              <th scope="col" class="px-6 py-3 border border-slate-600">
                Action
              </th>
            </tr>
          </thead>
          <?php


          ?>
          <tbody>
            <?php if (isset($users['error'])) : ?>
              <tr>
                <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($users['error']); ?></td>
              </tr>
            <?php elseif (!empty($users)) : ?>
              <?php foreach ($users as $userdata) : ?>
                <tr>

                  <td class="py-2 px-4 border border-slate-700 "><?= $userdata['id']; ?></td>
                  <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($userdata['username']); ?></td>
                  <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($userdata['first_name']); ?></td>
                  <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($userdata['last_name']); ?></td>
                  <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($userdata['email']); ?></td>
                  <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($userdata['role_name']); ?></td>
                  <td class="py-2 px-4 border border-slate-700 ">
                    <div class="justify between">
                      <a href="#" id="" data-user="<?= $userdata['id'] ?>" data-username="<?= $userdata['username'] ?>" data-firstname="<?= $userdata['first_name'] ?>" data-lastname="<?= $userdata['last_name'] ?>" data-email="<?= $userdata['email'] ?>" data-roleId="<?= $userdata['role_id'] ?>" data-roleName="<?= $userdata['role_name'] ?>" class="font-meduim text-blue-600 hover:underline" onclick="openEditUserModal(this)"><i class="fas fa-edit"></i></a>


                      <button data-deleteUser="<?= $userdata['id'] ?>" data-check_role="<?= $userdata['role_id'] ?>" class="font-meduim text-red-600 hover:underline" onclick="openDeleteModal(this)"><i class="fas fa-trash"></i></button>

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

      </div>
    </div>
    <script>
      function viewUser(button) {
        document.getElementById('userTable').classList.remove('hidden');
      }

      function closeViewUser() {
        document.getElementById('userTable').classList.add('hidden');

      }
    </script>
    <?php include 'UserModal.php' ?>
    <?php include 'educationTab.php' ?>
    <?php include 'footer.php' ?>
</body>
</html>