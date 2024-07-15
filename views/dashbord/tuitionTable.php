     
<div class="px-2 py-2">


<!-- table to get user -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <div class="pb-4 bg-white dark-bg-gray-900">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="absolute inset-y-0 rtl:inset-r-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap= "round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                  </svg>
            </div>
            <input type="text" id="table-search" class="block pt-2 ps-10 text-sm text-gray-900 rpunded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500">   
        </div>      
    </div>
        
<div class="flex justify-between">
    <!-- <button type="button" id="openAddModal"  class="cursor-pointer text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-meduim rounded-lg text-sm px-3 py-3 text-center me-2 mb-2" onclick="openAddModalTuition(this)">
      <i class="fas fa-user-plus"></i>  New Tuition
    </button> -->
</div>

    <!-- table -->
   
          <table class="w-full text-sm text-left rtl-text-right text-gray-900 border-collapse border border-slate-500 ">
              <thead class="text-xs text-gray-700 uppercase bg-blue-300 ">
                  <tr>
                      
                      <th scope="col" class="px-6 py-3 border border-slate-600 " >
                          id
                      </th>
                      <th scope="col" class="px-6 py-3 border border-slate-600">
                        filières
                      </th>
                      <th scope="col" class="px-6 py-3 border border-slate-600">
                        Id filières
                      </th>
                      <th scope="col" class="px-6 py-3 border border-slate-600">
                       Niveau
                      </th>
                      <th scope="col" class="px-6 py-3 border border-slate-600">
                        Sections
                      </th>
                      <th scope="col" class="px-6 py-3 border border-slate-600">
                        Amount
                      </th>
                      <th scope="col" class="px-6 py-3 border border-slate-600">
                       Crée par
                      </th>
                      <th scope="col" class="px-6 py-3 border border-slate-600">
                       Modifier Par
                      </th>
                     
                      <th scope="col" class="px-6 py-3 border border-slate-600">
                          Action
                      </th>
                  </tr>
              </thead>
              <?php
              

              ?>
              <tbody>
              <?php if (isset($tuitions['error'])): ?>
                    <tr>
                        <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($tuitions['error']); ?></td>
                    </tr>
                <?php elseif (!empty($tuitions)): ?>
                    <?php foreach ($tuitions as $tuitiondata): ?>
                        <tr>
                       
                            <td class="py-2 px-4 border border-slate-700 "><?= $tuitiondata['id']; ?></td>
                            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($tuitiondata['program']); ?></td>
                            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($tuitiondata['program_id']); ?></td>
                            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($tuitiondata['level_name']); ?></td>
                            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($tuitiondata['section']); ?></td>
                            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($tuitiondata['amount']); ?></td>
                            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($tuitiondata['created_by']); ?></td>
                            <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($tuitiondata['last_modified_by']); ?></td>
                           
    
                             <td class="py-2 px-4 border border-slate-700 ">
                              <div class="justify between">
                                  <a href="#"  data-tuition_id = "<?= $tuitiondata['id'] ?>"  
                                  data-program_tuition = "<?= $tuitiondata['program'] ?>"  
                                  data-programid_tuition = "<?= $tuitiondata['program_id'] ?>"  
                                  data-tuition_level = "<?= $tuitiondata['level_name'] ?>" 
                                  data-tuition_amount = "<?= $tuitiondata['amount'] ?>"
                                  data-tuition_section = "<?= $tuitiondata['section'] ?>"
                                  
                                  class="font-meduim text-blue-600 hover:underline" onclick="openEditModalTuition(this)"><i class="fas fa-edit"></i></a> 
                                

                                  <button  data-user= "<?= $userdata['id'] ?>" class="font-meduim text-red-600 hover:underline" onclick="openDeleteModal(this)"><i class="fas fa-trash"></i></button> 
                                
                              </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="py-2 px-4">Aucun utilisateur trouvé.</td>
                    </tr>
                <?php endif; ?>
              </tbody>     
                    
          </table>
     
</div>                
</div>




