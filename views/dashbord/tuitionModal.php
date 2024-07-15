<!-- delete modal for tuition-->

<div id="deleteTuition" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden ">


    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

        <!-- modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-700 "> Gestion des filières </h3>

            <button type="button" id="closeeModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="cover() ">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- body -->
        <div class="p-4 md:p-5">

            <h3 class="mb-5 text-lg font-normal text-gray-900 dark:text-gray-400">
                Voulez vous vraiment supprimer cette section ? <span id="refProgramId">3</span>
            </h3>

            <form action="../../api/controllers/TuitionController.php" method="POST" class=" justify-between">
                <input type="text" name="deleteSectionById" id="deleteProgramById" class="text-white">
                <input value="Oui" href="" type="submit" name="deleteProgram" type="button" id="deleteProgram" class="text-black cursor:pointer rounded-lg border border-red-200  bg-red-600 focus:ring-red-300 text-center py-2 px-2 hover:text-red-100">

                <div>
                    <button type="button" id="coverrModal" class="text-black cursor:pointer bg-blue-600 py-2 px-2 ms-3 text-sm font-meduim text-gray-900 focus:outline-none rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100" onclick="closeSection()">
                        Non
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


<!-- add tuition modal -->
<div id="addTuitionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">


    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

        <!-- modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-700 "> Ajouter le mountant des filières </h3>
            <button type="button" id="closeAddModalProgram" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeTuition()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- body -->
        <div class="p-4 md:p-5">
            <form method="POST" action="../../api/controllers/TuitionController.php" id="registerFormByAdmin" class="space-y-4">

                <div class="space-y-8">
                    <div>
                        <input type="hidden" class="text-gray-900" id="programId" name="program_id">
                        <input readonly type="text"  id="programName" name="program_name" placeholder="program_name" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>
                    <div>

                        <input readonly type="text" id="levelName" name="level_name" placeholder="level_name" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>
                    <div>
                        <input type="text" id="amount" name="amount" placeholder="mountant" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>
                    <div>
                        <select name="section" id="section" onchange="getSelectedSectionId()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected>Choisir une Section</option>

                            <?php foreach ($sections as $sectiondata) : ?>
                                <option value="<?= htmlspecialchars($sectiondata['school_year']); ?>" data-section-id="<?= $sectiondata['id']; ?>"><?= htmlspecialchars($sectiondata['school_year']); ?></option>
                            <?php endforeach; ?>

                        </select>
                        <input type="hidden" class="text-gray-900" name="section_id" id="sectionId">

                    </div>

                </div>

            <div class="justify-between flex text-sm font-meduim">

                <button type="button" id="closeAddModal" class="px-4 py-2 text-white bg-gradient-to-r from-gray-700 via-gray-700 to-gray-700 rounded-md hover:bg-gray-600 focus:outline focus-ring cursor-pointer" onclick="cover">Annuler</button>
                <input value="Enregister" type="submit" name="addTuition" class="px-4 py-2 bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus-ring cursor-pointer ">
            </div>
        </form>
    </div>

    </div>
</div>
</div>
</div>

<!-- add update modal -->
<div id="updateTuitionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden z-50">


    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

        <!-- modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-700 "> Ajouter le mountant des filières </h3>
            <button type="button" id="closeAddModalProgram" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeUpdate()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- body -->
        <div class="p-4 md:p-5">
            <form method="POST" action="../../api/controllers/TuitionController.php" id="registerFormByAdmin" class="space-y-4">

                <div class="space-y-8">
                    <div>
                        <input type="text" class="text-gray-900" name="last_modified_by" value="<?= $_SESSION['id'] ?>">
                        <input type="text" class="text-gray-900" id="updateById" name="updateById">
                    </div>
                    <div>
                        <input type="text" id="updateTByProgram" placeholder="program_name" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                        <input type="text" name="program_id" id="updateByProgramId">
                    </div>
                    <div>

                        <input type="text" id="updateTByLevel" name="level_name" placeholder="level_name" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>
                    <div>


                        <input type="text" id="updateTAmount" name="amount" placeholder="mountant" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                    </div>
                    <div>
                        <select name="section" id="updateTSection" onchange="updateSelectedSectionId()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option selected>Choisir une Section</option>
                            <?php foreach ($sections as $sectiondata) : ?>

                                <option value="<?= htmlspecialchars($sectiondata['school_year']); ?>" data-section-id="<?= $sectiondata['id']; ?>"><?= htmlspecialchars($sectiondata['school_year']); ?></option>
                            <?php endforeach; ?>

                        </select>
                        <input type="text" class="text-gray-900" name="section_id" id="updateSectionId">


                    </div>

                </div>
        </div>

        <div class="justify-between flex text-sm font-meduim">

            <button type="button" class="px-4 py-2 text-white bg-gradient-to-r from-gray-700 via-gray-700 to-gray-700 rounded-md hover:bg-gray-600 focus:outline focus-ring cursor-pointer" onclick="closeUpdate()">Annuler</button>
            <input value="Enregister" type="submit" name="updateTuition" class="px-4 py-2 bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus-ring cursor-pointer ">
        </div>
        </form>
    </div>
</div>
</div>
</div>

<!-- delete tuition  -->

<div id="deleteTuitionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">


    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

        <!-- modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-700 "> Gestion des Frais de scholarité </h3>

            <button type="button" id="closeModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeDeleteTuitionModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <!-- body -->
        <div class="p-4 md:p-5">

            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                Voulez vous vraiment supprimer les frais pour ce programe?
            </h3>

            <form action="../../api/controllers/TuitionController.php" method="POST">
                <input type="text" name="deleteTuitionById" id="deleteTuitionById" class="text-gray-900">
                <input value="Oui" href="" type="submit" name="deleteTuition" type="button" id="delete" class="text-black cursor:pointer rounded-lg border border-red-200  bg-red-600 focus:ring-red-300 text-center py-2 px-2 hover:text-red-100">
            </form>
            <button type="button" id="coverModal" class="text-black cursor:pointer bg-blue-600 py-2 px-2 ms-3 text-sm font-meduim text-gray-900 focus:outline-none rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100" onclick="closeDeleteTuitionModal()">
                Non
            </button>

        </div>
    </div>
</div>