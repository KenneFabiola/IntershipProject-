<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'RegistrationController.php';


if (isset($_GET['section_id'])) {
    $section_id = intval($_GET['section_id']);
    $json_registration_by_finish_session = $registration_controller->getAllRegistrationForFinishSession($section_id);
    $registration_by_finish_session = json_decode($json_registration_by_finish_session,true);

    if (!empty($registration_by_finish_session)) {
        // Supposons que le champ 'months' est dans le premier enregistrement
        $session_name = htmlspecialchars($registration_by_finish_session[0]['months'], ENT_QUOTES, 'UTF-8');  
        $school_year = htmlspecialchars($registration_by_finish_session[0]['school_year'], ENT_QUOTES, 'UTF-8');  
    }

} ?>

<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body>
<div class="hero_area">
 <h3 class="uppercase underline mt-6">Enregistrement pour la session de <?= $session_name; ?> de l'année academique <?=  $school_year; ?>  </h3> 


 <div class="px-2 py-2">

<!-- table -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg  px-4 py-2" id="activeSection">
<table class="w-full mt-6 mb-96 text-sm text-left rtl-text-right text-gray-900 border-collapse border border-slate-500 ">
    <thead class="text-xs text-gray-700 uppercase bg-blue-300 ">
        <tr>

            <th scope="col" class="px-6 py-3 border border-slate-600 ">
                id
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Nom
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Prenom
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Filiere
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Niveau
            </th>
        </tr>
    </thead>
    <?php


       ?>
    <tbody>
        <?php if (isset($registration_by_finish_session['error'])) : ?>
            <tr>
                <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($registration_by_finish_session['error']); ?></td>
            </tr>
        <?php elseif (!empty($registration_by_finish_session)) : ?>
            <?php foreach ($registration_by_finish_session as $registration_by_finish_session_data) : ?>
                <tr>

                    <td class="py-2 px-4 border border-slate-700 "><?= $registration_by_finish_session_data['id']; ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($registration_by_finish_session_data['first_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($registration_by_finish_session_data['last_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($registration_by_finish_session_data['program_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($registration_by_finish_session_data['level_name']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5" class="py-2 px-4">Aucun enregistrement trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>

</table>  
<?php include 'footer.php' ?>
</body>
</html>
