<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'TuitionController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'RegistrationController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'PaymentController.php';

include 'authorisation.php';
include 'message.php';

if (isset($_GET['section_id'])) {
    $section_id = intval($_GET['section_id']);

    $json_finish_payment_by_session = $payment_controller->getAllFinishPaymentBySession($section_id);
    $finish_payment_by_session = json_decode($json_finish_payment_by_session,true);
   
    $session_name = 'unknown';
    $school_year = 'unknown';
    if (!empty($finish_payment_by_session)) {
        // Supposons que le champ 'months' est dans le premier enregistrement
        $session_name = htmlspecialchars($finish_payment_by_session[0]['months'], ENT_QUOTES, 'UTF-8');  
        $school_year = htmlspecialchars($finish_payment_by_session[0]['school_year'], ENT_QUOTES, 'UTF-8');  
    }elseif (empty($finish_payment_by_session)) {
        echo "Aucun payement n'a été terminé pour cette session";
    }



} ?>

<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body>
<div class="hero_area">
 <h3 class="uppercase underline mt-6">Liste des payement terminé pour la session de <?= $session_name; ?> de l'année academique <?=  $school_year; ?>  </h3> 

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
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Montant à verser
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Montant déjà versé
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Reste à payer
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Date de payment
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Payement enregistrer par
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Action
            </th>
        </tr>
    </thead>
    <?php


       ?>
    <tbody>
        <?php if (isset($finish_payment_by_session['error'])) : ?>
            <tr>
                <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($finish_payment_by_session['error']); ?></td>
            </tr>
        <?php elseif (!empty($finish_payment_by_session)) : ?>
            <?php foreach ($finish_payment_by_session as $finish_payment_by_session_data) : ?>
                <tr>

                    <td class="py-2 px-4 border border-slate-700 "><?= $finish_payment_by_session_data['id']; ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($finish_payment_by_session_data['first_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($finish_payment_by_session_data['last_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($finish_payment_by_session_data['program_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($finish_payment_by_session_data['level_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($finish_payment_by_session_data['total_to_paid']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($finish_payment_by_session_data['total_paid']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($finish_payment_by_session_data['remaining']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($finish_payment_by_session_data['created_at']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($finish_payment_by_session_data['created_by']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 ">
                        <div class="justify between">
                            <a class="font-meduim text-blue-600 cursor-pointer hover:underline" data-registration-id ="<?= $finish_payment_by_session_data['id']; ?>" alert(<?= $finish_payment_by_session_data['id']; ?>)
                            
                            onclick="openEditRegistration(this)">
                            
                            <i class="fas fa-edit text-blue-500"></i></a>
                            

                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5" class="py-2 px-4">Aucun enregistrement trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>

</table>  
</div>
<?php 
include 'footer.php';
include 'paymentModal.php';
include 'registrationModal.php';
 ?>

</body>
</html>

