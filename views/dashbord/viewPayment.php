<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'TuitionController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'RegistrationController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'PaymentController.php';

include 'authorisation.php';
include 'message.php';

if (isset($_GET['section_id'])) {
    $section_id = intval($_GET['section_id']);

    $json_payment_by_session = $payment_controller->getAllPaymentBySession($section_id);
    $payment_by_session = json_decode($json_payment_by_session, true);

    if (!empty($payment_by_session)) {
        // Supposons que le champ 'months' est dans le premier enregistrement
        $session_name = htmlspecialchars($payment_by_session[0]['months'], ENT_QUOTES, 'UTF-8');
        $school_year = htmlspecialchars($payment_by_session[0]['school_year'], ENT_QUOTES, 'UTF-8');
    }
} ?>

<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>

<body>
    <div class="hero_area">
        <h3 class="uppercase underline mt-6">Payment pour la session de <?= $session_name; ?> de l'année academique <?= $school_year; ?> </h3>

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
                    <?php if (isset($payment_by_session['error'])) : ?>
                        <tr>
                            <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($payment_by_session['error']); ?></td>
                        </tr>
                    <?php elseif (!empty($payment_by_session)) : ?>
                        <?php foreach ($payment_by_session as $payment_by_session_data) : ?>
                            <tr>

                                <td class="py-2 px-4 border border-slate-700 "><?= $payment_by_session_data['id']; ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= $payment_by_session_data['registration_id']; ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_by_session_data['first_name']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_by_session_data['last_name']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_by_session_data['program_name']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_by_session_data['level_name']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_by_session_data['total_to_paid']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_by_session_data['total_paid']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_by_session_data['remaining']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_by_session_data['created_at']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_by_session_data['created_by_username']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 ">
                                    <div class="justify between">
                                       <div class="relative">
                                       <button data-registrationDropdown="<?= $payment_by_session_data['registration_id']; ?>" class="font-meduim text-blue-600 hover:underline cursor:pointer" onclick="openDropdownPaymentForStudent(this)">
                                            Payement<i class="fas fa-chevron-down"></i></button>
                                        <div id="dropdownStudentPayment_<?= $payment_by_session_data['registration_id']; ?>" class="hidden absolute right-0 mt-1 z-50 bg-white rounded shadow-lg">
                                            <button id="closeDropdownStudentPayment" class="right-0 flex text-red-500" onclick="closeDropdownStudentPayemnt(<?= $payment_by_session_data['registration_id']; ?>)">
                                                <i class="fas fa-times"></i>
                                                <a href="updatePayment.php?registration_id=<?= $payment_by_session_data['registration_id']; ?> "
                                                 class="block border-b border-gray-200 px-4 py-2 font-meduim text-blue-600 cursor-pointer ">

                                                    Modifier son dernier payment</a>
                                                <button class="block border-b border-gray-200 px-4 py-2 font-meduim text-blue-600 cursor-pointer"
                                                 data-registrationIdForP="<?= $payment_by_session_data['registration_id']; ?>"
                                                  data-firstnameForP="<?= htmlspecialchars($payment_by_session_data['first_name']); ?>" 
                                                  data-lastnameForP="<?= htmlspecialchars($payment_by_session_data['last_name']); ?>"
                                                   data-programNameForP="<?= htmlspecialchars($payment_by_session_data['program_name']); ?>"
                                                    data-levelNameForP="<?= htmlspecialchars($payment_by_session_data['level_name']); ?>"
                                                     onclick="addPayment(this)">Ajouter</button>
                                                     <a href="allPaymentForRegistrationId.php?registration_id=<?= $payment_by_session_data['registration_id']; ?>" class="block border-b border-gray-200 px-4 py-2 font-meduim text-blue-600 cursor-pointer ">Etablir ses reçus</a>
                                            </button>
                                        </div>

                                       </div>


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