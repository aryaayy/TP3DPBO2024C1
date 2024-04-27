<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Team.php');
include('classes/Template.php');

$team = new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$team->open();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    if ($team->deleteTeam($id) > 0) {
        echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'team.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal dihapus!');
            document.location.href = 'team.php';
        </script>";
    }
}

$team->close();

?>