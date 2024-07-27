
<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'SectionController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'StudentController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'TuitionController.php';
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'RegistrationController.php';


include 'authorisation.php';
include 'message.php';


if (isset($_GET['section_id'])) {
  $section_id = intval($_GET['section_id']);
  $json_student_register_by_session = $registration_controller->studentRegisterBySession($section_id);
  $student_register_by_session = json_decode($json_student_register_by_session,true);

  $json_program = $tuition_controller->findProgramBySession($section_id);
  $program_by_session = json_decode($json_program,true);

} 

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'head.php'; ?>

<body>
<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top py-1" style="background-color:#313858;">
        <div class="container-fluid">
          <div class="top_nav_container py-1" class="h-8 w-8">
            <img src="../../assets/images/logo1.png" alt="" srcset="" class="h-8 ">
            <p style="color:white">IFP LEADER EN INFORMATIQUE</p>
          </div>
        </div>
      </div>
      <div class="header_bottom  py-1">
        <div class="container-fluid ">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand text-lg" href="#">
              <span>
                IFPLI
              </span>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ">
                <li class="nav-item">
                  <a class="nav-link" href="#">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="program.php">Filière </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="student.php">Etudiant</a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link cursor-pointer " href="education.php" onclick="openEducatio(this)">Scolarité</a>
                </li>
                <form action="../../api/controllers/AuthentificateController.php" method="POST">
                  <input type="hidden" name="logout" value="true">
                  <li class="nav-item">
                    <button type="submit" class="nav-link cursor-pointer">Déconnexion</button>
                  </li>
                </form>

                <li class="nav-item">
                  <a class="nav-link" href="profil.php">Profil</a>
                </li>
              </ul>
            </div>
          </nav>
        </div>
      </div>
    </header>
 <h3>Nouvel enregistrement pour cette session</h3>
<div class="inset-0 flex items-center justify-center space-x-96">

<div class=" bg-white mb-96 mt-10 p-6 items-center rounded-lg shadow-lg max-w-md w-full justify-center">
    <h5 class="italic text-base font-medium hover:text-blue-600 cursor-pointer">Enregistrer un nouvel étudiant</h5>
<div >
  <form action="../../api/controllers/RegistrationController.php" method="POST">
    <div class="space-y-4">
        <div>
            <select  id="unRegisterStudentId" onchange="getStudentUnRegistrationId()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
              <option selected>enregistrer un nouvel etudiant</option>
              <?php foreach ($student_register_by_session as $student_register_by_session_data) : ?>
                <option value="<?= htmlspecialchars($student_register_by_session_data['first_name']); ?>" data-unRegisterStudentId="<?= $student_register_by_session_data['id']; ?>">
                  <?= htmlspecialchars($student_register_by_session_data['first_name']); ?>
                  <?= htmlspecialchars($student_register_by_session_data['last_name']); ?>

                </option>
              <?php endforeach; ?>
            </select>
            <input type="hidden" class="text-gray-900" name="registrationStudentId" id="unregisterStudentId">
        </div>
        <div>
          <input value="<?= $_GET['section_id'] ?>" type="hidden" class="text-gray-900" name="registrationSectionId" id="registrationSectionId">
        </div>
        <div>
          <select name="programRegistrationId" id="programRegistrationId" onchange="getProgramRegistrationId()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option selected>Choisir le programme</option>
            <?php foreach ($program_by_session as $program_by_session_data) : ?>
              <option value="<?= htmlspecialchars($program_by_session_data['program_name']); ?>" data-programRegistrationId="<?= $program_by_session_data['id']; ?>">
                <?= htmlspecialchars($program_by_session_data['program_name']); ?>
                <?= htmlspecialchars($program_by_session_data['level_name']); ?>
              </option>
            <?php endforeach; ?>
          </select>
          <input type="hidden" class="text-gray-900" name="registrationProgramId" id="registrationProgramId">
        </div>
        <div class="justify-between flex text-sm font-meduim">
          <a href="education.php" type="button" id="closeAddModal" class="px-4 py-2 text-white bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 rounded-md hover:bg-gray-600 focus:outline focus-ring cursor-pointer">Annuler</a>
          <input value="Enregister" type="submit" id="addRegistrationButton" name="addRegistration" class="px-4 py-2 bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus-ring cursor-pointer ">
        </div>
    </div>
</form>
</div>
</div>


<div class=" hidden bg-white mb-96 mt-10 p-6 items-center rounded-lg shadow-lg max-w-md w-full justify-center">
    <h5 class="italic text-base font-medium hover:text-blue-600 cursor-pointer">Ajout d'un enregistrement </h5>
<div >
  <form action="../../api/controllers/RegistrationController.php" method="POST">
    <div class="space-y-4">
        <div >
            <select id="studentRegistrationId" onchange="getStudentRegistrationId()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
              <option selected>Choisir un etudiant enregistrer</option>
              <?php foreach ($register_student  as $registerstudentdata) : ?>
                <option value="<?= htmlspecialchars($registerstudentdata['username']); ?>" data-studentRegistrationId="<?= $registerstudentdata['id']; ?>">
                  <?= htmlspecialchars($registerstudentdata['first_name']); ?>
                  <?= htmlspecialchars($registerstudentdata['last_name']); ?>

                </option>
              <?php endforeach; ?>
            </select>
            <input type="hidden" class="text-gray-900" name="registrationStudentId"  id="registrationStudentId">
        </div>
        <div>
          <input value="<?= $_GET['section_id'] ?>" type="hidden" class="text-gray-900" name="registrationSectionId" id="registrationSectionId">
        </div>
        <div>
          <select name="programRegistrationId" id="programRegistrationId" onchange="getProgramRegistrationId()" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            <option selected>Choisir le programme</option>
            <?php foreach ($programs as $program_by_session_data) : ?>
              <option value="<?= htmlspecialchars($program_by_session_data['program_name']); ?>" data-programRegistrationId="<?= $program_by_session_data['id']; ?>">
                <?= htmlspecialchars($program_by_session_data['program_name']); ?>
                <?= htmlspecialchars($program_by_session_data['level_name']); ?>
              </option>
            <?php endforeach; ?>
          </select>
          <input type="hidden" class="text-gray-900" name="registrationProgramId" id="registrationProgramId">
        </div>
        <div class="justify-between flex text-sm font-meduim">
          <a href="education.php" type="button" id="closeAddModal" class="px-4 py-2 text-white bg-gradient-to-r from-gray-600 via-gray-600 to-gray-600 rounded-md hover:bg-gray-600 focus:outline focus-ring cursor-pointer">Annuler</a>
          <input value="Enregister" type="submit" id="addRegistrationButton" name="addRegistration" class="px-4 py-2 bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus-ring cursor-pointer ">
        </div>
    </div>
</form>
</div>
</div>
</div>
<?php
 include 'footer.php';
 include 'paymentModal.php';
  ?>

</body>
</html>