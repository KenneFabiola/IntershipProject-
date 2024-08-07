<!-- add new student -->
<div id="addStudentModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">


  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-700 "> Ajout d'un nouvel utilisateur </h3>
      <button type="button" id="closeStudentModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">
      <form method="POST" action="../../api/controllers/StudentController.php" id="registerFormByAdmin" class="space-y-4">

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
          <!-- <div>
                  <input type="password" id="password" name="pwd" placeholder="••••••••" class=" bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                </div> -->

        </div>

        <div class="justify-between flex text-sm font-meduim">

          <button type="button" id="closeAddModal" class="px-4 py-2 text-white bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 rounded-md hover:bg-gray-600 focus:outline focus-ring cursor-pointer">Annuler</button>
          <input value="Enregister" type="submit" name="addStudent" class="px-4 py-2 bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus-ring cursor-pointer ">
        </div>
      </form>
    </div>
  </div>
</div>
</div>





<!-- delete modal for student -->

<div id="deleteStudent" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden ">


  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-700 "> Gestion des étudiants </h3>

      <button type="button" id="closeeModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick=" closeStudent()">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">

      <h3 class="mb-5 text-lg font-normal text-gray-900 dark:text-gray-400">
        Voulez vous vraiment supprimer cet étudiant ? <span id="refStudentId"></span>
      </h3>

      <form action="../../api/controllers/StudentController.php" method="POST">
        <input type="text" name="deleteStudentById" id="deleteStudentById" class="text-white">
        <input value="Oui" href="" type="submit" name="deleteStudent" type="button" id="deleteStudent" class="text-black cursor:pointer rounded-lg border border-red-200  bg-red-600 focus:ring-red-300 text-center py-2 px-2 hover:text-red-100">
      </form>
      <button type="button" id="coverrModal" class="text-black cursor:pointer bg-blue-600 py-2 px-2 ms-3 text-sm font-meduim text-gray-900 focus:outline-none rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100" onclick="closeStudent()">
        Non
      </button>

    </div>
  </div>
</div>




<!-- update student -->

<div id="editStudentModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-700 "> Modification d'un étudiant</h3>
      <button type="button" id="closeAddModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeEditStudentModal()">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">
      <form method="POST" action="../../api/controllers/StudentController.php" id="registerFormByAdmin" class="space-y-4">

        <div class="space-y-8">
          <div>
            <input type="hidden" id="updateStudentById" name="updateStudentById" class="text-white">
            <input type="hidden" value="<?= $_SESSION['id']; ?>" name="last_modified_by" class="text-white">

            <input type="hidden" id="usernameUser" name="usernameUser" placeholder="Username" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="text" id="updateStudentUsername" name="username" placeholder="Username" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="text" id="updateStudentFirstname" name="first_name" placeholder="Firstname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="text" id="updateStudentLastname" name="last_name" placeholder="Lastname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="email" id="updateStudentEmail" name="email" placeholder="Email" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>

        </div>

        <div class="justify-between flex text-sm font-meduim">

          <button type="button" id="closeAddModal" class="cursor-pointer text-white bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2" onclick="closeEditStudentModal()">Annuler</button>
          <input value="Enregister" type="submit" name="updateStudent" class="cursor-pointer text-white bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2">
        </div>
      </form>
    </div>
  </div>
</div>


<!-- add user account -->

<div id="studentAccount" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">


  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-700 "> Compte utilisateur d'un étudiant </h3>
      <button type="button" id="closeAddModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeButton()">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">
      <form method="POST" action="../../api/controllers/StudentController.php" id="" class="space-y-4">

        <div class="space-y-8">
          <div>
            <input type="text" class="text-gray-900" id="studentId" name="studentId">
            <input type="text" id="usernameAccount" name="username" placeholder="Username" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="text" id="firstNameAccount" name="first_name" placeholder="Firstname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="text" id="lastNameAccount" name="last_name" placeholder="Lastname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <div>
            <input type="email" id="emailAccount" name="email" placeholder="Email" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
          <!-- <div>
                  <input type="password" id="password" name="pwd" placeholder="••••••••" class=" bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300">
                </div> -->
          <div>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 1) : ?>
              <select name="role" id="accountRole" onchange="getAccountRole()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>Choisir une fonction</option>
                <?php foreach ($roles as $roledata) : ?>
                  <option value="<?= htmlspecialchars($roledata['role_name']); ?>" data-accountRoleId="<?= $roledata['id']; ?>">
                    <?= htmlspecialchars($roledata['role_name']); ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <input type="text" class="text-gray-900" name="role_id" id="accountRoleId">

            <?php endif; ?>
          </div>
        </div>

        <div class="justify-between flex text-sm font-meduim">

          <button type="button" id="closeAddModal" class="cursor-pointer text-white bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2" onclick="closeButton()">Annuler</button>
          <input value="Enregister" type="submit" name="studentAccount" class="cursor-pointer text-white bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2">
        </div>
      </form>
    </div>
  </div>
</div>
</div>







<div id="disableStudent" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden ">


  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-700 "> Descativation du compte de <span id="disableName"></span> </h3>

      <button type="button" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeDisableStudent()">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">

      <h3 class="mb-5 text-lg font-normal text-gray-900 dark:text-gray-400">
        Voulez vous vraiment desactiver ce compte ?
      </h3>

      <form action="../../api/controllers/StudentController.php" method="POST">
        <input type="hidden" name="studentIdDisable" id="studentIdDisable" class="text-gray-900">
        <input value="Oui" href="" type="submit" name="disableAccount" type="button" id="deleteStudent" class="text-black cursor:pointer rounded-lg border border-red-200  bg-gradient-to-r from-red-500 via-red-500 to-red-500 focus:ring-red-300 text-center py-2 px-2 hover:text-red-100">
        <button type="button" class="text-black cursor:pointerbg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 py-2 px-2 ms-3 text-sm font-meduim text-gray-900 focus:outline-none rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100" onclick="closeDisableStudent()">
          Non
        </button>
      </form>

    </div>
  </div>
</div>