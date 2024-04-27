<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Team.php');
include('classes/Template.php');

$team = new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$team->open();
$team->getTeam();

if (isset($_POST['btn-add'])) {
    if ($team->addTeam($_POST, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'tambahTeam.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'tambahTeam.php';
        </script>";
    }
}

$view = new Template('templates/skinform.html');

$mainTitle = 'Tambah Team';

$form = '<div class="col gx-2 gy-3 justify-content-center">
<form action="tambahTeam.php" method="post" role="form" id="form-add" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id">
    <div class="mb-3">
        <label for="team_code" class="form-label">Kode Team</label>
        <input type="text" class="form-control" id="team_code" name="team_code" required>
    </div>
    <div class="mb-3">
        <label for="team_name" class="form-label">Nama Team</label>
        <input type="text" class="form-control" id="team_name" name="team_name" required>
    </div>

    <a href="index.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
    <button type="submit" class="btn btn-primary text-white" name="btn-add" id="btn-add" form="form-add">Tambah</button>
</form>
</div>
';

$team->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_FORM', $form);
$view->write();
