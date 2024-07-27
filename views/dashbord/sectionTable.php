<!-- table -->
<h5>Sections actives pour l'année académique en cours</h5>
<div class="items-center relative overflow-x-auto shadow-md sm:rounded-lg px-4 py-2" id="activeSection">
  <table class="w-full text-sm text-left rtl-text-right text-gray-900 border-collapse border border-slate-500 ">
    <thead class="text-xs text-gray-700 uppercase bg-blue-300 ">
      <tr>
        <th scope="col" class="px-6 py-3 border border-slate-600 ">Id</th>
        <th scope="col" class="px-6 py-3 border border-slate-600">Année académique</th>
        <th scope="col" class="px-6 py-3 border border-slate-600">Session de</th>
        <th scope="col" class="px-6 py-3 border border-slate-600">Date de création</th>
        <th scope="col" class="px-6 py-3 border border-slate-600">Créé par</th>
        <th scope="col" class="px-6 py-3 border border-slate-600">Statut</th>
        <th scope="col" class="px-6 py-3 border border-slate-600">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if (isset($sections['error'])) : ?>
        <tr>
          <td colspan="7" class="py-2 px-4"><?= htmlspecialchars($sections['error']); ?></td>
        </tr>
      <?php elseif (!empty($sections)) : ?>
        <?php foreach ($sections as $sectiondata) : ?>
          <tr>
            <td class="py-2 px-4 border border-slate-700 "><?= $sectiondata['id']; ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($sectiondata['school_year']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($sectiondata['months']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($sectiondata['created_at']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($sectiondata['created_by']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($sectiondata['statut']); ?></td>
            <td class="py-2 px-4 border border-slate-700 ">
              <div class="flex space-x-2">
                <a href="#" data-sectionId="<?= $sectiondata['id'] ?>" data-updateSchoolYear="<?= $sectiondata['school_year'] ?>" data-updateMonth="<?= $sectiondata['months'] ?>" class="font-medium text-blue-600 hover:underline" onclick="openUpdateSessionModal(this)">Modifier</a>
                <button data_section_id="<?= $sectiondata['id'] ?>" class="font-medium text-red-600 hover:underline" onclick="openFinishModal(this)">Terminer</button>

                <div class="flex space-x-2">
                  <div class="relative">
                    <button data-section_idT="<?= $sectiondata['id'] ?>" class="font-medium text-blue-600 hover:underline" onclick="openDropdownTuition(this)">
                      Frais de scolarité<i class="fas fa-chevron-down"></i>
                    </button>
                    <div id="dropdownTuition_<?= $sectiondata['id'] ?>" class="hidden absolute right-0 mt-1 z-50 bg-white shadow-lg rounded-lg">
                      <button id="closeMse" class="right-0 flex text-red-500" onclick="closeDropdownTuition(<?= $sectiondata['id'] ?>)"><i class="fas fa-times"></i></button>
                      <a href="viewTuition.php?section_id=<?= $sectiondata['id']; ?>" class="block border-b border-gray-200 px-4 py-2"><i class="fas fa-eye text-blue-500"></i> voir les frais de scolarité</a>
                    </div>
                  </div>
                  <div class="relative">
                    <button data-section_id="<?= $sectiondata['id'] ?>" class="font-medium text-blue-600 hover:underline" onclick="openDropdownR(this)">
                      Enregistrement <i class="fas fa-chevron-down"></i>
                    </button>
                    <div id="dropdownRegistration_<?= $sectiondata['id'] ?>" class="hidden absolute right-0 mt-1 z-50 bg-white shadow-lg rounded-lg">
                      <button id="closeMse" class="right-0 flex text-red-500" onclick="closeDropdownRegistration(<?= $sectiondata['id'] ?>)"><i class="fas fa-times"></i></button>                      
                      <!-- <button class="block border-b border-gray-200 px-4 py-2" onclick="openNewRegistration(<?= $sectiondata['id']; ?>)"><i class="fas fa-plus text-blue-500 m-1"></i>Ajouter</button> -->
                      <a href="newRegistration.php?section_id=<?= $sectiondata['id']; ?>" class="block border-b border-gray-200 px-4 py-2"><i class="fas fa-plus m-1 text-blue-500"></i>Ajouter</a>

                      <a href="viewRegistration.php?section_id=<?= $sectiondata['id']; ?>" class="block border-b border-gray-200 px-4 py-2"><i class="fas fa-eye m-1 text-blue-500"></i>voir les enregistrements</a>
                    </div>
                  </div>
                </div>
                <div class="relative">
                  <button data-section_idPayment="<?= $sectiondata['id'] ?>" class="font-medium text-blue-600 hover:underline" onclick="openDropdownP(this)">
                    Payment <i class="fas fa-chevron-down"></i>
                  </button>
                  <div id="dropdownPayment_<?= $sectiondata['id'] ?>" class="hidden absolute right-0 mt-1 z-50 bg-white shadow-lg rounded-lg">
                    <button id="closeMse" class="right-0 flex text-red-500" onclick="closeDropdownPayment(<?= $sectiondata['id'] ?>)"><i class="fas fa-times"></i></button>
                    <!-- Retirez le bouton duplicata -->
                    <a href="" class="block border-b border-gray-200 px-4 py-2"><i class="fas fa-plus text-blue-500 m-1"></i>Ajouter</a>
                    <a href="viewPayment.php?section_id=<?= $sectiondata['id'] ?>" class="block border-b border-gray-200 px-4 py-2"><i class="fas fa-eye m-1 text-blue-500"></i>voir les paiements en cours</a>
                    <a href="finishPayment.php?section_id=<?= $sectiondata['id'] ?>" class="block border-b border-gray-200 px-4 py-2"><i class="fas fa-eye m-1 text-blue-500"></i>voir les paiements terminés</a>
                  </div>
                </div>

            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="7" class="py-2 px-4">Aucune session trouvée.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>


  <!-- inactive section -->

  <div class="pb-4 bg-white dark-bg-gray-900">
    <label for="table-search" class="sr-only">Search</label>
    <div class="relative mt-1">
      <h5>Liste des section terminé</h5>

      <div class="absolute inset-y-0 rtl:inset-r-0 flex items-center ps-3 pointer-events-none">
        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
        </svg>
      </div>
      <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 rpunded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
    </div>
  </div>
  <!-- table -->
  <table class="w-full text-sm text-left rtl-text-right text-gray-900 border-collapse border border-slate-500 ">
    <thead class="text-xs text-gray-700 uppercase bg-blue-300 ">
      <tr>

        <th scope="col" class="px-6 py-3 border border-slate-600 ">
          Id
        </th>
        <th scope="col" class="px-6 py-3 border border-slate-600">
          Année académique
        </th>
        <th scope="col" class="px-6 py-3 border border-slate-600">
          Session de
        </th>
        <th scope="col" class="px-6 py-3 border border-slate-600">
          Date de création
        </th>
        <th scope="col" class="px-6 py-3 border border-slate-600">
          Créé par
        </th>
        <th scope="col" class="px-6 py-3 border border-slate-600">
          Modifié par
        </th>
        <th scope="col" class="px-6 py-3 border border-slate-600">
          Statut
        </th>


        <th scope="col" class="px-6 py-3 border border-slate-600">
          Action
        </th>
      </tr>
    </thead>
    <?php


    ?>
    <tbody>
      <?php if (isset($inactive_section['error'])) : ?>
        <tr>
          <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($inactive_section['error']); ?></td>
        </tr>
      <?php elseif (!empty($inactive_section)) : ?>
        <?php foreach ($inactive_section as $inactive_section_data) : ?>
          <tr>

            <td class="py-2 px-4 border border-slate-700 "><?= $inactive_section_data['id']; ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($inactive_section_data['school_year']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($inactive_section_data['months']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($inactive_section_data['created_at']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($inactive_section_data['created_by']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($inactive_section_data['last_modified_by']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($inactive_section_data['statut']); ?></td>
            <td class="py-2 px-4 border border-slate-700 ">
              <div class="space-x-2">
                <div class="relative inline-block">
                  <button data-section_id="<?= $sectiondata['id'] ?>" class="font-meduim text-blue-600 hover:underline" onclick="openDropdownRT(this)">
                    <!-- <i class="fas fa-clipboard-list"></i> -->
                    Enregistrement <i class="fas fa-chevron-down"></i>
                  </button>
                  <div id="dropdownRegistrationT_<?= $sectiondata['id'] ?>" class="hidden absolute right-0 mt-1 z-50 bg-white shadow-lg rounded-lg">
                    <button id="closeMse" class="right-0 flex text-red-500"><i class="fas fa-times"></i></button>
                    <a href="viewFinishRegistration.php?section_id=<?= $inactive_section_data['id'] ?>" class="block hover:text-red-500  border-b border-gray-200 px-4 py-2">Enregistrement pour cette session</a>
                  </div>
                </div>
                <a href="paymentForFinishSession.php?section_id=<?= $inactive_section_data['id']; ?>">payement</a>
                  <div id="dropdownPaymentT" class="hidden absolute right-0 mt-1 z-50 bg-white shadow-lg rounded-lg">
                    <button id="closeMse" class="right-0 flex text-red-500"><i class="fas fa-times"></i></button>
                    <a href="" class="block hover:text-red-500  border-b border-gray-200 px-4 py-2">Payment pour cette session</a>
                  </div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="5" class="py-2 px-4">Aucune session terminée trouver.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <script>
    function closeMultiDropdownE(dropdownId) {
      alert();
      document.getElementById(dropdownId).classList.add('hidden');
    }
  </script>