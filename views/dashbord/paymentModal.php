<!-- add payment -->

<div id="addPayment" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-700 "> Enregistrement d'un payement pour l'etudiant <span class="text-gray-900" id="usernameRegistration"></span> </h3>
      <button type="button" id="closeAddModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeAddPModal()">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">
      <form method="POST" action="../../api/controllers/PaymentController.php" id="registerFormByAdmin" class="space-y-4">

        <div class="space-y-8">
          <input type="hidden" name="registrationId" id="registrationId">
          <input readonly type="text" id="firstname" name="first_name" placeholder="Firstname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
        </div>
        <div>
          <input readonly type="text" id="lastname" name="last_name" placeholder="Lastname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
        </div>
        <div>
          <input readonly type="email" id="program_name" name="email" placeholder="Email" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
        </div>
        <div>
          <input readonly type="email" id="level_name" name="email" placeholder="Email" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
        </div>
        <div>
          <input type="number" id="amount" name="amount" placeholder="montant versé" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
        </div>


    </div>

    <div class="justify-between flex text-sm font-meduim">

      <button type="button" id="closeAddModal" class="cursor-pointer text-white bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2" onclick="closeAddPModal()">Annuler</button>
      <input value="Enregister" type="submit" name="addPayment" class="cursor-pointer text-white bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2">
    </div>
    </form>
  </div>
</div>
</div>

<!-- edit last payment -->

<div id="updatePayment" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-700 "> Modifier le dernier payement de cet étudiant <span class="text-gray-900" id="usernameRegistration"></span> </h3>
      <button type="button" id="closeAddModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeUpdatePModal()">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">
      <form method="POST" action="../../api/controllers/PaymentController.php" id="registerFormByAdmin" class="space-y-4">

        <div class="space-y-8">
          <input type="hidden" value="<?= $_SESSION['id'] ;?>" name="last_modified_by">
          <input type="hidden" class="text-white" name="paymentId" id="paymentId">
          <input type="hidden" class="text-white" name="registration_id" id="idRegistration">
          <input readonly type="text" id="firstNameP" name="first_name" placeholder="Firstname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
        </div>
        <div>
          <input readonly type="text" id="lastNameP" name="last_name" placeholder="Lastname" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
        </div>
        <div>
          <input type="number" id="lastAmount" name="amount" placeholder="montant versé" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
        </div>


    </div>

    <div class="justify-between flex text-sm font-meduim">

      <button type="button" id="closeAddModal" class="cursor-pointer text-white bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2" onclick="closeUpdatePModal()">Annuler</button>
      <input value="Enregister" type="submit" name="updatePayment" class="cursor-pointer text-white bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-4 py-2 text-center me-2 mb-2">
    </div>
    </form>
  </div>
</div>
</div>

<!-- make receipt -->
 <div>
  <h3>Reçu de payement</h3>
  <p></p>
 </div>