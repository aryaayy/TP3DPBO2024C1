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

$view = new Template('templates/skinform.html');

$mainTitle = 'Update Player';
$dataTeam = null;
$dataCountry = null;
$form = null;

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $player->getPlayerById($id);
    if (isset($_POST['btn-add'])) {
        if ($player->updateData($id, $_POST, $_FILES) > 0) {
            echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'detail.php?id=$id';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'detail.php?id=$id';
            </script>";
        }
    }
    $player = $player->getResult();

    while($data = $team->getResult()){
        $dataTeam .= '<option value="'.$data['team_id'].'" '.($data['team_id'] == $player['team_id'] ? "selected" : "").'>'.$data['team_name'].'</option>';
    }

    while($data = $country->getResult()){
        $dataCountry .= '<option value="'.$data['country_id'].'" '.($data['country_id'] == $player['country_id'] ? "selected" : "").'>'.$data['country_name'].'</option>';
    }

    $form = '<div class="col gx-2 gy-3 justify-content-center">
    <form action="updatePlayer.php?id='.$id.'" method="post" role="form" id="form-add" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="'.$player['player_id'].'">
        <div class="mb-3">
            <label for="player_name" class="form-label">Nickname</label>
            <input type="text" class="form-control" id="player_name" name="player_name" value="'.$player['player_name'].'" required>
        </div>
        <div class="mb-3">
            <label for="player_realname" class="form-label">Nama asli</label>
            <input type="text" class="form-control" id="player_realname" name="player_realname" value="'.$player['player_realname'].'" required>
        </div>
        <div class="mb-3">
            <label for="player_age" class="form-label">Umur</label>
            <input type="text" class="form-control" id="player_age" name="player_age" value="'.$player['player_age'].'" required>
        </div>
        <div class="mb-3">
            <label for="team_id" class="form-label">Team</label>
            <select class="form-select" aria-label="Category" id="team_id" name="team_id" required>
                '.
                $dataTeam
                .'
            </select>
        </div>
        <div class="mb-3">
            <label for="country_id" class="form-label">Country</label>
            <select class="form-select" aria-label="Category" id="country_id" name="country_id" required>
                '.
                $dataCountry
                .'
            </select>
        </div>

        <div class="mb-3">
            <label for="player_photo" class="form-label">Foto</label>
            <br>
            <img src="assets/images/'.$player['player_photo'].'" alt="" width="100px">
            <br>
            <input class="form-control" type="file" id="player_photo" name="player_photo">
        </div>

        <a href="index.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
        <button type="submit" class="btn btn-primary text-white" name="btn-add" id="btn-add" form="form-add">Update</button>
    </form>
    </div>
    ';
}

// $player->close();
$team->close();
$country->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_FORM', $form);
$view->write();
