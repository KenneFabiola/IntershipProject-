
<div id="sectionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">


<div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-700 "> Ajouter une nouvelle section </h3>
        <button type="button" id="modalSectionClose" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white">
      <i class="fas fa-times"></i>
    </button>            
    </div>
<!-- body -->
    <div  class="p-4 md:p-5">
    <form method="POST" action="../../api/controllers/SectionController.php" id="registerFormByAdmin" class="space-y-4">
      
            <div class="space-y-8">
                <div>
                    <input type="text" id="school_year" name="school_year" placeholder="school_year" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                </div>
                
                
            </div>

          <div class="justify-between flex text-sm font-meduim">

              <button type="button" id="cover"  class="px-4 py-2 text-white bg-gray-700 rounded-md hover:bg-gray-600 focus:outline focus-ring cursor-pointer">Annuler</button>
              <input value="Enregister" type="submit" name="addSection" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus-ring cursor-pointer ">
         </div>
    </form>
    </div>
</div>
</div>
</div>

 <!-- finish section modal -->

 <div id="finishSection" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden ">


<div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

    <!-- modal header -->
    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-xl font-semibold text-gray-700 "> Gestion des sections </h3>
        
        <button type="button" id="closeeModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick=" closeSection()">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <!-- body -->
    <div class="p-4 md:p-5">
       
             <h3 class="mb-5 text-lg font-normal text-gray-900 dark:text-gray-400">
                 Voulez vous vraiment terminé cette section <span id="refSectionId">3</span>
             </h3>

             <form action="../../api/controllers/SectionController.php" method="POST">
                     <input type="text" name="finishSectionById" id="finishSectionById" class="text-white">
                     <input value="Oui" href="" type="submit"  name="finishSection" type="button" id="deleteStudent" class="text-black cursor:pointer rounded-lg border border-red-200  bg-red-600 focus:ring-red-300 text-center py-2 px-2 hover:text-red-100">
            </form>
            <button type="button"  class="text-black cursor:pointer bg-blue-600 py-2 px-2 ms-3 text-sm font-meduim text-gray-900 focus:outline-none rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100" onclick="closeSection()">
                Non
            </button>
        
    </div>
</div>
</div>