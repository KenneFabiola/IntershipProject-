<!-- updta registration registration -->
<div id="updateRegistration" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
<div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">
<!-- modal header -->
<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
  <h3 class="text-xl font-semibold text-gray-700 "> Modifier la filiere d'un étudiant </h3>
  <button type="button" id="closeStudentModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeUpdateRegistration()">
    <i class="fas fa-times"></i>
  </button>
</div>
<div>
  <form action="../../api/controllers/RegistrationController.php" method="POST">
   <div class="space-y-4">
   <div>
    <input type="hidden" value="<?= $_SESSION['id'] ?>" name="last_modified_by">
        <input type="hidden" class="text-gray-900" name="registrationId" id="REGID">
        <input type="hidden" class="text-gray-900" name="section_id" id="sectionId">
        <input readonly type="text"  id="registrationFirstname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
    </div>
    <div>
      <input type="hidden" class="text-gray-900" name="studentId" id="updateByStudentId">
        <input readonly type="text"  id="registrationLastname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
    </div>
    <div>
      <select id="REG" name="REG"  onchange="getUpadteRegistrationId()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      <option selected>Choisir le programme</option>
        <?php foreach ($program_by_session as $program_by_session_data) : ?>
          <option value="<?= htmlspecialchars($program_by_session_data['program_name']); ?>" data-updateProgramRegistrationId ="<?= $program_by_session_data['id']; ?>">
            <?= htmlspecialchars($program_by_session_data['program_name']); ?>
            <?= htmlspecialchars($program_by_session_data['level_name']); ?>
          </option>
        <?php endforeach; ?>
      </select>
      <input type="text" class="text-gray-900" id="changeProgramId" name="programId" >
    </div>
    
    <div class="justify-between flex text-sm font-meduim">
      <button type="button" id="closeAddModal" class="px-4 py-2 text-white bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 rounded-md hover:bg-gray-600 focus:outline focus-ring cursor-pointer" onclick="closeUpdateRegistration()">Annuler</button>
      <input value="Enregister" type="submit" id="addRegistrationButton" name="updateRegistration" class="px-4 py-2 bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus-ring cursor-pointer ">
    </div>
   </div>
</form>
<div class="space-y-4 items-center">
  <button  class="text-red-500 hover:red-700 text-sm" onclick="changeProgram(this)">Ajouter une nouvelle filière a cet étudiant?</button>
</div>
</div>
</div>
</div>


<!-- change program -->
<div id="changeProgram" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
<div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">
<!-- modal header -->
<div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
  <h3 class="text-xl font-semibold text-gray-700 "> Ajouter une nouvelle filière à cet étudiant d'un étudiant </h3>
  <button type="button" id="closeStudentModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeAddNewProgram()">
    <i class="fas fa-times"></i>
  </button>
</div>
<div>
  <form action="../../api/controllers/RegistrationController.php" method="POST">
   <div class="space-y-4">
   <div>
    <input type="hidden" value="<?= $_SESSION['id'] ?>" name="last_modified_by">
        <input type="hidden" class="text-gray-900" name="sectionId" id="sectionIdForNewProgram">
        <input type="hidden" class="text-gray-900" name="registrationId" id="NEWREGID">
        <input readonly type="text"  id="nRegistrationFirstname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
    </div>
    <div>
      <input type="hidden" class="text-gray-900" name="studentId" id="newProgramForSTudent">
        <input readonly type="text"  id="nRregistrationLastname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
    </div>
    <div>
      <select id="NREG" name="REG"  onchange="getChangeNewProgram()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
      <option selected>Choisir le programme</option>
        <?php foreach ($new_program_by_session as $new_program_by_session_data) : ?>
          <option value="<?= htmlspecialchars($new_program_by_session_data['program_name']); ?>" data-updateProgramRegistrationId ="<?= $new_program_by_session_data['id']; ?>">
            <?= htmlspecialchars($new_program_by_session_data['program_name']); ?>
            <?= htmlspecialchars($new_program_by_session_data['level_name']); ?>
          </option>
        <?php endforeach; ?>
      </select>
      <input type="text" class="text-gray-900" id="NewProgramId" name="programId" >
    </div>
    <div class="justify-between flex text-sm font-meduim">
      <button type="button" id="closeAddModal" class="px-4 py-2 text-white bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 rounded-md hover:bg-gray-600 focus:outline focus-ring cursor-pointer" onclick="closeAddNewProgram()">Annuler</button>
      <input value="Enregister" type="submit" id="addRegistrationButton" name="updateRegistration" class="px-4 py-2 bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus-ring cursor-pointer ">
    </div>
   </div>
</form>
</div>
</div>
</div>