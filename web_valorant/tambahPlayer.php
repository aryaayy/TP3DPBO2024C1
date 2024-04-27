<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Player.php');
include('classes/Team.php');
include('classes/Country.php');
include('classes/Template.php');

$player = new Player($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$player->open();
$player->getPlayer();

$team = new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$team->open();
$team->getTeam();

$country = new Country($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$country->open();
$country->getCountry();

if (isset($_POST['btn-add'])) {
    if ($player->addData($_POST, $_FILES) > 0) {
        echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'tambahPlayer.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'tambahPlayer.php';
        </script>";
    }
}

$view = new Template('templates/skinform.html');

$mainTitle = 'Tambah Player';

$dataTeam = null;

while($data = $team->getResult()){
    $dataTeam .= '<option value="'.$data['team_id'].'">'.$data['team_name'].'</option>';
}

$dataCountry = null;

while($data = $country->getResult()){
    $dataCountry .= '<option value="'.$data['country_id'].'">'.$data['country_name'].'</option>';
}

$form = '<div class="col gx-2 gy-3 justify-content-center">
<form action="tambahPlayer.php" method="post" role="form" id="form-add" enctype="multipart/form-data">
    <input type="hidden" name="id" id="id">
    <div class="mb-3">
        <label for="player_name" class="form-label">Nickname</label>
        <input type="text" class="form-control" id="player_name" name="player_name" required>
    </div>
    <div class="mb-3">
        <label for="player_realname" class="form-label">Nama asli</label>
        <input type="text" class="form-control" id="player_realname" name="player_realname" required>
    </div>
    <div class="mb-3">
        <label for="player_age" class="form-label">Umur</label>
        <input type="text" class="form-control" id="player_age" name="player_age" required>
    </div>
    <div class="mb-3">
        <label for="team_id" class="form-label">Team</label>
        <select class="form-select" aria-label="Category" id="team_id" name="team_id" required>
            <option value="" selected disabled hidden>Pilih</option>'.
            $dataTeam.'
        </select>
    </div>
    <div class="mb-3">
        <label for="country_id" class="form-label">Country</label>
        <select class="form-select" aria-label="Category" id="country_id" name="country_id" required>
            <option value="" selected disabled hidden>Pilih</option>'.
            $dataCountry.'
        </select>
    </div>

    <div class="mb-3">
        <label for="player_photo" class="form-label">Foto</label>
        <input class="form-control" type="file" id="player_photo" name="player_photo" required>
    </div>

    <a href="index.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
    <button type="submit" class="btn btn-primary text-white" name="btn-add" id="btn-add" form="form-add">Tambah</button>
</form>
</div>
';

$player->close();
$team->close();
$country->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_FORM', $form);
$view->write();
