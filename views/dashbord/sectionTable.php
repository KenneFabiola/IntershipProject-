<!-- table -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-2/3 w-2/3 px-4 py-2" id="activeSection">
  <table class="w-full text-sm text-left rtl-text-right text-gray-900 border-collapse border border-slate-500 ">
    <thead class="text-xs text-gray-700 uppercase bg-blue-300 ">
      <tr>

        <th scope="col" class="px-6 py-3 border border-slate-600 ">
          id
        </th>
        <th scope="col" class="px-6 py-3 border border-slate-600">
          date de création
        </th>
        <th scope="col" class="px-6 py-3 border border-slate-600">
          année académique
        </th>
        <th scope="col" class="px-6 py-3 border border-slate-600">
          créé par
        </th>
        <th scope="col" class="px-6 py-3 border border-slate-600">
          modifié par
        </th>
        <th scope="col" class="px-6 py-3 border border-slate-600">
          statut
        </th>


        <th scope="col" class="px-6 py-3 border border-slate-600">
          Action
        </th>
      </tr>
    </thead>
    <?php


    ?>
    <tbody>
      <?php if (isset($sections['error'])) : ?>
        <tr>
          <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($sections['error']); ?></td>
        </tr>
      <?php elseif (!empty($sections)) : ?>
        <?php foreach ($sections as $sectiondata) : ?>
          <tr>

            <td class="py-2 px-4 border border-slate-700 "><?= $sectiondata['id']; ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($sectiondata['created_at']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($sectiondata['school_year']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($sectiondata['created_by_username']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($sectiondata['last_modified_by_username']); ?></td>
            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($sectiondata['statut']); ?></td>
            <td class="py-2 px-4 border border-slate-700 ">
              <div class="justify between space-x-2">
                <a href="#" id="" data-user="<?= $sectiondata['id'] ?>" data-username="<?= $userdata['username'] ?>" data-firstname="<?= $userdata['first_name'] ?>" data-lastname="<?= $userdata['last_name'] ?>" data-email="<?= $userdata['email'] ?>" data-pwd="<?= $userdata['pwd'] ?>" class="font-meduim text-blue-600 hover:underline" onclick="openEditModal(this)"><i class="fas fa-edit"></i></a>


                <button data_section_id_tuition="<?= $sectiondata['id'] ?>" class="font-meduim text-blue-900 hover:underline" onclick="openAddTuition(this)"><i class="fas fa-credit-card"></i></button>
                <button data_section_id_tuition="<?= $sectiondata['id'] ?>" class="font-meduim text-blue-900 hover:underline" onclick="openTuitionBySection(this)"><i class="fas fa-credit-card"></i></button>
                <button data_section_id_tuitio="<?= $sectiondata['id'] ?>" class="font-meduim text-blue-400 hover:underline" onclick="openFinishModal(this)"><i class="fas fa-save"></i></button>
                <button data_section_id="<?= $sectiondata['id'] ?>" class="font-meduim text-red-600 hover:underline" onclick="openFinishModal(this)"><i class="fas fa-check"></i></button>
                <button data-user="<?= $sectiondata['id'] ?>" class="font-meduim text-red-600 hover:underline" onclick="openDeleteModal(this)"><i class="fas fa-trash"></i></button>


              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else : ?>
        <tr>
          <td colspan="5" class="py-2 px-4">Aucun utilisateur trouvé.</td>
        </tr>
      <?php endif; ?>
    </tbody>

  </table>

</div>
</div>
</div>
<!-- inactive section -->

<!-- table to get user -->


  <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-2/3 px-4 py-2" id="finishsection">
    <div class="pb-4 bg-white dark-bg-gray-900">
      <label for="table-search" class="sr-only">Search</label>
      <div class="relative mt-1">
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
            id
          </th>
          <th scope="col" class="px-6 py-3 border border-slate-600">
            date de création
          </th>
          <th scope="col" class="px-6 py-3 border border-slate-600">
            année académique
          </th>
          <th scope="col" class="px-6 py-3 border border-slate-600">
            créé par
          </th>
          <th scope="col" class="px-6 py-3 border border-slate-600">
            modifié par
          </th>
          <th scope="col" class="px-6 py-3 border border-slate-600">
            statut
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
              <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($inactive_section_data['created_at']); ?></td>
              <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($inactive_section_data['school_year']); ?></td>
              <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($inactive_section_data['created_by_username']); ?></td>
              <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($inactive_section_data['last_modified_by_username']); ?></td>
              <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($inactive_section_data['statut']); ?></td>
              <td class="py-2 px-4 border border-slate-700 ">
                <div class="justify between">
                  <a href="#" id="" data-user="<?= $inactive_section_data['id'] ?>" data-username="<?= $userdata['username'] ?>" data-firstname="<?= $userdata['first_name'] ?>" data-lastname="<?= $userdata['last_name'] ?>" data-email="<?= $userdata['email'] ?>" data-pwd="<?= $userdata['pwd'] ?>" class="font-meduim text-blue-600 hover:underline" onclick="openEditModal(this)"><i class="fas fa-edit"></i></a>


                  <button data-user="<?= $inactive_section_data['id'] ?>" class="font-meduim text-red-600 hover:underline" onclick="openDeleteModal(this)"><i class="fas fa-trash"></i></button>


                </div>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr>
            <td colspan="5" class="py-2 px-4">Aucun utilisateur trouvé.</td>
          </tr>
        <?php endif; ?>
      </tbody>

    </table>

  </div>
</div>

<!-- active section for new tuition -->
<div class="space-y-2">
  <div class="block">
    <?php foreach ($sections as $sectiondata) : ?>
      <select name="" id="">
        <option selected>Choisir une section </option>
        <option value="<?= htmlspecialchars($sectiondata['school_year']); ?>"><?= htmlspecialchars($sectiondata['school_year']); ?></option>
      </select>
    <?php endforeach; ?>
  </div>
</div>