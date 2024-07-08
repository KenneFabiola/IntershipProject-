<div id="tuitionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50 overflow-auto hidden">

    <div class="w-full max-w-4xl max-h-screen overflow-auto bg-white p-6 rounded-lg shadow-lg  justify-between">
        <form action="../../api/controllers/TuitionController.php" method="POST" class="mt-4">

            <!-- modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-700 "> Définir les frais de scolarité de chaque program pour la section en cours </h3>
                <button type="button" id="closeTuition" class="end-2.5 t-0 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeTuition()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="flex-grow overflow-y-auto mt-4">
                <input type="text" name="sectionIdForTuition" id="sectionIdForTuition" class="text-gray-900"> <span id="refIdSection"></span>


                <table class="w-full text-sm text-left rtl-text-right text-gray-900 border-collapse border border-slate-500  ">
                    <thead class="text-xs text-white uppercase bg-blue-600">
                        <tr>
                            <th scope="col" class="px-4 py-3 border border-slate-600 justify-center flex">
                                id
                            </th>
                            <th scope="col" class="px-4 py-3 border border-slate-600 ">
                                Filière
                            </th>

                            <th scope="col" class="px-4 py-3 border border-slate-600  justify-center ">
                                Montant
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (isset($programs['error'])) : ?>
                            <tr>
                                <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($programs['error']); ?></td>
                            </tr>
                        <?php elseif (!empty($programs)) : ?>
                            <?php foreach ($programs as $program_data) : ?>
                                <tr>

                                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($program_data['id']); ?>
                                        <input type="text" value="<?= ($program_data['id']); ?>" >
                                    </td>
                                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($program_data['program_name']); ?>
                                        <input type="text" name="programs[<?= $program_data['id'] ?>]['program_name'] " id="program" value="<?= htmlspecialchars($programdata['program_name']); ?>">
                                    </td>
                                    <td class="py-2 px-4 border border-slate-700 ">
                                        <input type="number" id="amount" name="programs[<?= $program_data['id'] ?>]['amount']" placeholder="amount" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="py-2 px-4">Aucune filière disponible.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
            <div class="p-4 md:p-5">
                <div class="flex justify-between">
                    <div>
                        <button type="button" id="coverModal" class="text-white cursor:pointer bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 py-2 px-2 ms-3 text-sm font-meduim text-gray-900 focus:outline-none rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:ring-4 focus:ring-gray-100" onclick="closeTuition()">
                            Annuler
                        </button>
                    </div>
                    <div>

                        <input value="Enregister" href="" type="submit" name="addTuition" type="button" id="delete" class="text-white cursor:pointer rounded-lg border border-red-200  bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 focus:ring-red-300 text-center py-2 px-2 hover:text-red-100">
                    </div>

                </div>

            </div>
        </form>
    </div>
</div>



<!-- delete modal for tuition-->

<div id="deleteTuition" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden ">


    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full justify-between">

        <!-- modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-700 "> Gestion des filières </h3>

            <button type="button" id="closeeModal" class="end-2.5 text-gray-700 bg-transparent  rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center hover:bg-blue-gray-900:text-white" onclick="closeSection()">
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