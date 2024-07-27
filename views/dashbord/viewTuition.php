<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'TuitionController.php';
include 'authorisation.php';
include 'message.php';

if (isset($_GET['section_id'])) {
    $section_id = intval($_GET['section_id']);
   
    $json_tuition_by_session = $controller->getAlltuitionForSessionId($section_id);
    $tuition_by_session = json_decode($json_tuition_by_session,true);

    if(!empty($tuition_by_session)) {
        $months = htmlspecialchars($tuition_by_session[0]['months']);
        $school_year = htmlspecialchars($tuition_by_session[0]['school_year']);
    }
} ?>

<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>
<body>
<div class="hero_area">
 <h3 class="uppercase underline mt-2">Prix des filières pour la session de <?= $months; ?> de l'année academique <?= $school_year; ?> </h3> 
 <div class="px-2 py-2">

<!-- table -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg  px-4 py-2" id="activeSection">
<table class="w-full text-sm text-left rtl-text-right text-gray-900 border-collapse border border-slate-500 ">
    <thead class="text-xs text-gray-700 uppercase bg-blue-300 ">
        <tr>

            <th scope="col" class="px-6 py-3 border border-slate-600 ">
                id
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Année Academique       
             </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Session
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Filiere
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Niveau
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                mountant
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Action
            </th>
        </tr>
    </thead>
    <?php


       ?>
    <tbody>
        
        <?php if (!empty( $tuition_by_session)) : ?>
            <?php foreach ( $tuition_by_session as  $tuition_by_session_data) : ?>
                <tr>

                    <td class="py-2 px-4 border border-slate-700 "><?=  $tuition_by_session_data['id']; ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars( $tuition_by_session_data['school_year']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars( $tuition_by_session_data['months']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars( $tuition_by_session_data['program_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars( $tuition_by_session_data['level_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars( $tuition_by_session_data['amount']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 ">
                        <div class="justify between">
                            <a class="font-meduim text-blue-600 hover:underline" onclick="openEditModalTuition(this)"><i class="fas fa-edit"></i></a>

                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php else: ?>
            <tr>
                <td colspan="5" class="py-2 px-4">Aucun enregistrement trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>

</table>  
<?php include 'footer.php' ?>
</body>
</html>
