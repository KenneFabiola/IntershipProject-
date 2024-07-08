<?php
require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . 'TuitionController.php';
?>

<!DOCTYPE html>
<html>
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
                        <a class="navbar-brand text-lg" href="../index.html">
                            <span>
                                IFPLI
                            </span>
                        </a>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class=""> </span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ">
                                <li class="nav-item active">
                                    <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="program.php">Filière </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="student.php">Etudiant</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link cursor-pointer " href="education.php">Scolarité</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link cursor-pointer" href="../../logout.php">Deconnexion</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="profil.php">Profil</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </header>




        <!-- modal header -->


        <div class="space-y-2 py-4  border border-slate-600 ">
            <div class="flex items-center justify-center">
                <table class="w-2/3 text-sm text-left rtl-text-right text-gray-900 border-collapse border border-slate-500  ">
                    <thead class="text-xs text-white uppercase bg-blue-600 items-center">
                        <tr>

                            <th scope="col" class="px-4 py-3 border border-slate-600 ">
                                Filière
                            </th>
                            <th scope="col" class="px-4 py-3 border border-slate-600  justify-center ">
                                Montant
                            </th>



                        </tr>
                    </thead>
                    <?php


                    ?>
                    <tbody>
                        <?php if (isset($programs['error'])) : ?>
                            <tr>
                                <td colspan="5" class="py-2 px-4"><?= htmlspecialchars($programs['error']); ?></td>
                            </tr>
                        <?php elseif (!empty($programs)) : ?>
                            <?php foreach ($programs as $programdata) : ?>
                                <tr>


                                    <td class="py-2 px-4 border border-slate-700 "><input value="<?= htmlspecialchars($programdata['program_name']); ?>" type="text" id="program_name" name="program_name" placeholder="program_name" class="bg-gray-50 mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-300" required>
                                    </td>
                                    <td class="py-2 px-4 border  border-slate-700 "><input type="text" id="amountByProgram" name="amountByProgram" placeholder="Prix par filière" class="bg-gray-50 mt-1 block w-full  px-3 py-3  focus:outline-none focus:ring focus:border-blue-300" required>
                                    </td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="py-2 px-4">Aucune filière disponible.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
            <form action="../../api/controllers/TuitionController.php" method="POST" class="mt-4">


                <div>

                    <input type="hidden" name="deleteById" id="deleteById" class="text-white">
                    <input value="Enregister" href="" type="submit" name="delete" type="button" id="delete" class="text-white cursor:pointer rounded-lg border border-red-200  bg-gradient-to-r from-blue-600 via-blue-600 to-blue-600 focus:ring-red-300 text-center py-2 px-2 hover:text-red-100">

                </div>



            </form>

        </div>

        <?php include 'footer.php' ?>
</body>

</html>