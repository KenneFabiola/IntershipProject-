<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'TuitionController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'RegistrationController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'PaymentController.php';

include 'authorisation.php';
include 'message.php';

if (isset($_GET['section_id'])) {
    $section_id = intval($_GET['section_id']);

    $json_payment_for_finish_session = $payment_controller->findPaymentForfinishSession($section_id);
    $payment_for_finish_session = json_decode($json_payment_for_finish_session, true);

    if (!empty($payment_for_finish_session)) {
        // Supposons que le champ 'months' est dans le premier enregistrement
        $session_name = htmlspecialchars($payment_for_finish_session[0]['months'], ENT_QUOTES, 'UTF-8');
        $school_year = htmlspecialchars($payment_for_finish_session[0]['school_year'], ENT_QUOTES, 'UTF-8');
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
                            Montant Total versé
                        </th>
                        <th scope="col" class="px-6 py-3 border border-slate-600">
                            Date de payment
                        </th>
                        <th scope="col" class="px-6 py-3 border border-slate-600">
                            Payement enregistrer par
                        </th>
                </thead>
                <?php


                ?>
                <tbody>
                    <?php if (isset($payment_for_finish_session['error'])) : ?>
                        <tr>
                            <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($payment_for_finish_session['error']); ?></td>
                        </tr>
                    <?php elseif (!empty($payment_for_finish_session)) : ?>
                        <?php foreach ($payment_for_finish_session as $payment_for_finish_session_data) : ?>
                            <tr>

                                <td class="py-2 px-4 border border-slate-700 "><?= $payment_for_finish_session_data['id']; ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= $payment_for_finish_session_data['registration_id']; ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_for_finish_session_data['first_name']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_for_finish_session_data['last_name']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_for_finish_session_data['program_name']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_for_finish_session_data['level_name']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_for_finish_session_data['total_to_paid']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_for_finish_session_data['total_paid']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_for_finish_session_data['created_at']); ?></td>
                                <td class="py-2 px-4 border border-slate-700 "><?= htmlspecialchars($payment_for_finish_session_data['created_by_username']); ?></td>
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