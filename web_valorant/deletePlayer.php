<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Player.php');
include('classes/Team.php');
include('classes/Country.php');
include('classes/Template.php');

$player = new Player($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$player->open();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    if ($player->deleteData($id) > 0) {
        echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal dihapus!');
            document.location.href = 'index.php';
        </script>";
    }
}

$player->close();

?>