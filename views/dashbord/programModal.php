<!-- add new program -->
<div id="addProgramModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">


<div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-700 "> Ajouter une filière  </h3>
        <button type="button" id="closeAddModalProgram" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeAddProgram()">
      <i class="fas fa-times"></i>
    </button>            
    </div>
<!-- body -->
    <div  class="p-4 md:p-5">
    <form method="POST" action="../../api/controllers/ProgramController.php" id="addProgram" class="space-y-4">
    <span id="error" class="text-sm text-red-500"></span>
      
          <div class="space-y-8">
                <div>
                    <input type="hidden" value="<?= $_SESSION['id'] ?>" name="created_by">
                    <input type="hidden" value="<?= $_SESSION['id'] ?>" name="last_modified_by">
                    <span class="text-sm" id="addProgramNameError"></span>
                    <input type="text" id="addProgramName" name="program_name" placeholder="program_name" class="bg-gray-50 mt-1 block w-full px-3 py-2  rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" >
                </div>
                <div>
                  <span class="text-sm" id="addLevelNameError"></span>
                    <input type="text" id="addLevelName" name="level_name" placeholder="niveau" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" >
                </div>
                <div>
                  <span class="text-sm" id="addDescribeError"></span>
                  <input type="text" id="addDescribe" name="descriptive" placeholder="description" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" >
                </div>
                <div>
                  <span class="text-sm" id="addDurationError"></span>
                  <input type="text" id="addDuration" name="duration" placeholder="duration" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" >
                </div>
                
                </div>
          </div>

          <div class="justify-between flex text-sm font-meduim">
              <button type="button" id="closeAddModal"  class="px-4 py-2 text-white bg-gray-700 rounded-md hover:bg-gray-600 focus:outline focus-ring cursor-pointer" onclick="closeAddProgram()">Annuler</button>
              <input value="Enregister" type="submit" id="addProgramButton" name="addProgram" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus-ring cursor-pointer ">
         </div>
    </form>
    </div>
</div>
</div>
</div>


<!-- update program -->
<div id="updateProgramModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">


<div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-700 "> Modifier une filière  </h3>
        <button type="button" id="closeAddModalProgram" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeUpdateProgramModal()">
      <i class="fas fa-times"></i>
    </button>            
    </div>
<!-- body -->
    <div  class="p-4 md:p-5">
    <form method="POST" action="../../api/controllers/ProgramController.php" id="registerFormByAdmin" class="space-y-4">
      
          <div class="space-y-8">
                <div>
                    <input type="hidden" name="last_modified_by" id="" value="<?= $_SESSION['id'] ?>">
                    <input type="text" name="updateProgramById" id="updateProgramById">
                    <input type="text" id="updateProgramName" name="program_name" placeholder="program_name" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
                <div>
                  <input type="text" id="updateLevelName" name="level_name" placeholder="level_name" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
                <div>
                  <input type="text" id="updateProgramDescription" name="descriptive" placeholder="describe" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
                <div>
                  <input type="text" id="updateProgramDuration" name="duration" placeholder="duration" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
                
                </div>
          </div>

          <div class="justify-between flex text-sm font-meduim">

              <button type="button" id="closeAddModal"  class="px-4 py-2 text-white bg-gray-700 rounded-md hover:bg-gray-600 focus:outline focus-ring cursor-pointer" onclick="closeUpdateProgramModal()">Annuler</button>
              <input value="Enregister" type="submit" name="updateProgram" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus-ring cursor-pointer ">
         </div>
    </form>
    </div>
</div>
</div>
</div>



<!-- delete modal for program-->

<div id="deleteProgram" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden ">


<div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-700 "> Gestion des filières </h3>
        
        <button type="button" id="closeeModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeDeleteProgram()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">
       
             <h3 class="mb-5 text-lg font-normal text-gray-900 dark:text-gray-400">
                 Voulez vous vraiment supprimer cette filière ? <span class="text-sm" id="refProgramId">3</span>
             </h3>

             <form action="../../api/controllers/ProgramController.php" method="POST">
                     <input type="text" name="deleteProgramById" id="deleteProgramById" class="text-gray-900">
                     <input value="Oui" href="" type="submit"  name="deleteProgram" type="button" id="deleteProgram" class="text-black cursor:pointer rounded-lg border border-red-200  bg-red-600 focus:ring-red-300 text-center py-2 px-2 hover:text-red-100">
            </form>
            <button type="button" id="coverrModal" class="text-black cursor:pointer bg-blue-600 py-2 px-2 ms-3 text-sm font-meduim text-gray-900 focus:outline-none rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100" onclick="closeDeleteProgram()">
                Non
            </button>
        
    </div>
</div>
</div>

