<div id="modalSignUp" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">


  <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
      <h3 class="text-xl font-semibold text-gray-700 "> Inscription </h3>
      <button type="button" id="closeSignUp" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white">
        <i class="fas fa-times"></i>
      </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">
      <form id="registerForm" class="space-y-4" method="POST" action="../api/controllers/UserController.php">

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
            <input type="password" id="password" name="pwd" placeholder="••••••••" class=" bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
          </div>
        </div>

        <div class="justify-center items-center">
          <input value="S'inscrire" type="submit" name="signUp" class=" w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus-ring cursor-pointer ">
        </div>
      </form>

      <div class=" justify-between flex text-sm font-meduim text gray dark:text-gray-300">
        Vous avez déjà un compte? <button href="" class="text-blue-700 hover:underline dark:text-blue-500" id="openModal" onclick="openSignIn(this)">Se connecter</button>
      </div>
    </div>
  </div>

</div>

