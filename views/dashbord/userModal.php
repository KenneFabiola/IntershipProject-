<div id="addUserModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">


  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-700 "> Ajout d'un nouvel utilisateur </h3>
      <button type="button"  class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeAddUser()">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">
      <form method="POST" action="../../api/controllers/UserController.php" id="registerFormByAdmin" class="space-y-4">

        <div class="space-y-8">
          <div>
            <input type="text" id="username" name="username" placeholder="Username" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="text" id="first_name" name="first_name" placeholder="Firstname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="text" id="last_name" name="last_name" placeholder="Lastname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="email" id="email" name="email" placeholder="Email" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="password" id="password" name="pwd" placeholder="••••••••" class=" bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">
          </div>
          <div>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) : ?>
              <select name="role" id="role" onchange="getSelectedRoleId()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Choisir une fonction</option>
                <?php foreach ($roles as $roledata) : ?>
                  <option value="<?= htmlspecialchars($roledata['role_name']); ?>" data-role_id="<?= $roledata['id']; ?>">
                    <?= htmlspecialchars($roledata['role_name']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <input type="text" class="text-gray-900" name="role_id" id="roleId">

            <?php endif; ?>
          </div>
        </div>

        <div class="justify-between flex text-sm font-meduim">

          <button type="button"  class="cursor-pointer text-white bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2" onclick="closeAddUser()">Annuler</button>
          <input value="Enregister" type="submit" name="submit" class="cursor-pointer text-white bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2">
        </div>
      </form>
    </div>
  </div>
</div>
</div>


<!-- modal delete -->
<div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">


  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-700 "> Gestion des utilisateurs </h3>

      <button type="button" id="closeModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeDeleteModal()">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">

      <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
        Voulez vous vraiment supprimer cet utilisateur? <span id="refId">4</span>
      </h3>

      <form action="../../api/controllers/UserController.php" method="POST">
      <input type="hidden" class="text-gray-900" id="checkRoleId" name="role_id">

        <input type="hidden" name="deleteById" id="deleteById" class="text-white">
        <input value="Oui" href="" type="submit" name="delete" type="button" id="delete" class="text-black cursor:pointer rounded-lg border border-red-200  bg-red-600 focus:ring-red-300 text-center py-2 px-2 hover:text-red-100">
      </form>
      <button type="button" id="coverModal" class="text-black cursor:pointer bg-blue-600 py-2 px-2 ms-3 text-sm font-meduim text-gray-900 focus:outline-none rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100" onclick="closeDeleteModal()">
        Non
      </button>

    </div>
  </div>
</div>



<!-- update modal -->

<div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-700 "> Modification d'un utilisateur </h3>
      <button type="button" id="closeAddModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeEditModal()">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">
      <form method="POST" action="../../api/controllers/UserController.php" id="registerFormByAdmin" class="space-y-4">

        <div class="space-y-8">
          <div>
            <input type="text" id="updateById" name="updateById">
            <input type="text" id="updateUsername" name="username" placeholder="Username" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="text" id="updateFirstname" name="first_name" placeholder="Firstname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="text" id="updateLastname" name="last_name" placeholder="Lastname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="email" id="updateEmail" name="email" placeholder="Email" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>

          <div>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) : ?>
              <select name="role" id="updateRoleName" onchange="getUpdateRoleId()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Choisir une fonction</option>
                <?php foreach ($roles as $roledata) : ?>
                  <option value="<?= htmlspecialchars($roledata['role_name']); ?>" data-updateRoleId ="<?= $roledata['id']; ?>">
                    <?= htmlspecialchars($roledata['role_name']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <input type="text" class="text-gray-900" name="role_id" id="updateRoleId">

            <?php endif; ?>
          </div>

        </div>

        <div class="justify-between flex text-sm font-meduim">

          <button type="button" id="closeAddModal" class="cursor-pointer text-white bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2" onclick="closeEditModal()">Annuler</button>
          <input value="Enregister" type="submit" name="update" class="cursor-pointer text-white bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2">
        </div>
      </form>
    </div>
  </div>
</div>