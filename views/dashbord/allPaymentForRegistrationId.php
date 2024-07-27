<?php

require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'PaymentController.php';

include 'authorisation.php';
include 'message.php';

if (isset($_GET['registration_id'])) {
    $registration_id = intval($_GET['registration_id']);

    $json_payments_by_registration = $payment_controller->findPaymentsByregistration($registration_id);
    $payments_by_registration = json_decode($json_payments_by_registration,true);
    
    if (!empty($payments_by_registration)) {
        // Supposons que le champ 'months' est dans le premier enregistrement
        $first_name = htmlspecialchars($payments_by_registration[0]['first_name'], ENT_QUOTES, 'UTF-8');  
        $last_name = htmlspecialchars($payments_by_registration[0]['last_name'], ENT_QUOTES, 'UTF-8');  
    }



} ?>

<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<body>
<div class="hero_area">
 <h3 class="uppercase underline mt-6">Etape de payment de  <?= $first_name ?> <?=  $last_name; ?> </h3> 

<!-- table -->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg  px-4 py-2" id="activeSection">
<table class="w-full mt-6 mb-96 text-sm text-left rtl-text-right text-gray-900 border-collapse border border-slate-500 ">
    <thead class="text-xs text-gray-700 uppercase bg-blue-300 ">
        <tr>

            <th scope="col" class="px-6 py-3 border border-slate-600 ">
                id
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600 ">
                Registration id
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
                Montant verser
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Date de payment
            </th>
            <th scope="col" class="px-6 py-3 border border-slate-600">
                Action
            </th>
        </tr>
    </thead>
    <?php


       ?>
    <tbody>
        <?php if (isset($payments_by_registration['error'])) : ?>
            <tr>
                <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($payments_by_registration['error']); ?></td>
            </tr>
        <?php elseif (!empty($payments_by_registration)) : ?>
            <?php foreach ($payments_by_registration as $payments_by_registration_data) : ?>
                <tr>

                    <td class="py-2 px-4 border border-slate-700 "><?= $payments_by_registration_data['id']; ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= $payments_by_registration_data['registration_id']; ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payments_by_registration_data['first_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payments_by_registration_data['last_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payments_by_registration_data['program_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payments_by_registration_data['level_name']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payments_by_registration_data['amount']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payments_by_registration_data['created_at']); ?></td>
                    <td class="py-2 px-4 border border-slate-700 ">
                        <div class="justify between">
                            <button onclick="openEditPayment(this)" class="font-meduim text-blue-600 cursor-pointer hover:underline"
                            data-paymentId ="<?= $payments_by_registration_data['id']; ?>"
                             data-registrationId ="<?= $payments_by_registration_data['registration_id']; ?>"
                             data-lastAmount="<?= htmlspecialchars($payments_by_registration_data['amount']); ?>"
                             data-firstNameP="<?= htmlspecialchars($payments_by_registration_data['first_name']); ?>"
                             data-lastNameP="<?= htmlspecialchars($payments_by_registration_data['last_name']); ?>">
                            <i class="fas fa-edit text-blue-500"></i></a>

                            <a class="text-blue-500" href="generateReceipt.php?paymentId=<?= $payments_by_registration_data['id']; ?>
                            &registrationId=<?= $payments_by_registration_data['registration_id']; ?>
                            &firstName=<?= urlencode($payments_by_registration_data['first_name']); ?>
                            &lastName=<?= urlencode($payments_by_registration_data['last_name']); ?>
                            &program=<?= urlencode($payments_by_registration_data['program_name']); ?>
                            &levelName=<?= urlencode($payments_by_registration_data['level_name']); ?>
                            &amount=<?= urlencode($payments_by_registration_data['amount']); ?>
                            &createdAt=<?= urlencode($payments_by_registration_data['created_at']); ?>"  onclick="alert()">
                                <i class="fas fa-plus"></i></a>
                            

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
