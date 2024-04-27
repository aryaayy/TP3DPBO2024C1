<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Team.php');
include('classes/Country.php');
include('classes/Player.php');
include('classes/Template.php');

// buat instance player
$listPlayer = new Player($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listPlayer->open();
// tampilkan data player
$listPlayer->getPlayerJoin();

// cari player
if (isset($_POST['btn-cari'])) {
    // methode mencari data player
    $listPlayer->searchPlayer($_POST['cari']);
} else {
    // method menampilkan data player
    $listPlayer->getPlayerJoin();
}

$sortActive = isset($_POST['btn-sort']);
if($sortActive){
    $listPlayer->getPlayerJoinSorted($_POST);
}

$data = null;

// ambil data player
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listPlayer->getResult()) {
    $data .= '<div class="col gx-2 gy-3 justify-content-center">' .
        '<div class="card pt-4 px-2 player-thumbnail">
        <a href="detail.php?id=' . $row['player_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['player_photo'] . '" class="card-img-top" alt="' . $row['player_photo'] . '">
            </div>
            <div class="card-body">
                <p class="card-text player-name my-0">' . $row['team_code'] . ' ' . $row['player_name'] . '</p>
                <p class="card-text country-name my-0">' . $row['country_name'] . '</p>
                <p class="card-text team-name">' . $row['team_name'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

$form_sort = '
<form action="index.php" method="post">
    <select name="sort_by" id="sort_by">
        <option value="player_id" '. ($sortActive && $_POST['sort_by'] == 'player_id' ? 'selected' : '') .'>ID</option>
        <option value="player_name" '. ($sortActive && $_POST['sort_by'] == 'player_name' ? 'selected' : '') .'>Nickname</option>
        <option value="player_realname" '. ($sortActive && $_POST['sort_by'] == 'player_realname' ? 'selected' : '') .'>Nama asli</option>
        <option value="player_age" '. ($sortActive && $_POST['sort_by'] == 'player_age' ? 'selected' : '') .'>Umur</option>
        <option value="team_name" '. ($sortActive && $_POST['sort_by'] == 'team_name' ? 'selected' : '') .'>Nama team</option>
        <option value="country_name" '. ($sortActive && $_POST['sort_by'] == 'country_name' ? 'selected' : '') .'>Nama negara</option>
    </select>
    <select name="sort_order" id="sort_order">
        <option value="asc" '. ($sortActive && $_POST['sort_order'] == 'asc' ? 'selected' : '') .'>Ascending</option>
        <option value="desc" '. ($sortActive && $_POST['sort_order'] == 'desc' ? 'selected' : '') .'>Descending</option>
    </select>
    <button type="submit" name="btn-sort" class="btn btn-primary">Save</button>
</form>';

// tutup koneksi
$listPlayer->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_PLAYER', $data);
$home->replace('FORM_SORT', $form_sort);
$home->write();
