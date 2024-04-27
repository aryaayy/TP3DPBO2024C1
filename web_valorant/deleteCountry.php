<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Country.php');
include('classes/Template.php');

$country = new Country($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$country->open();

if(isset($_GET['id'])){
    $id = $_GET['id'];
    if ($country->deleteCountry($id) > 0) {
        echo "<script>
            alert('Data berhasil dihapus!');
            document.location.href = 'country.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal dihapus!');
            document.location.href = 'country.php';
        </script>";
    }
}

$country->close();

?>