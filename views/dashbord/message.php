<?php
// check if session is defined;
// alert-dismissible show that alert can be close fade show add an animation effect
if (isset($_SESSION['error'])) : ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $_SESSION['error'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['success'])) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $_SESSION['success'] ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>




<?php if (isset($_SESSION['error'])) : ?>

    <div role="alert">
        <div class="bg-gradient-to-r from-red-500 via-red-500 to-red-500 text-white font-bold rounded-t px-4 py-2 w-full">
            Attention
        </div>
        <div class="border border-t-0 border-red-400 rounded-b bg-red-100 px-4 py-3 text-red-700">
            <P><?= $_SESSION['error'] ?></P>

        </div>

    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>