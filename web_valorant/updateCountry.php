<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Country.php');
include('classes/Template.php');

$country = new Country($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$country->open();
$country->getCountry();

$view = new Template('templates/skinform.html');

$mainTitle = 'Update Country';
$dataCountry = null;
$dataCountry = null;
$form = null;

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $country->getCountryById($id);
    if (isset($_POST['btn-add'])) {
        if ($country->updateCountry($id, $_POST, $_FILES) > 0) {
            echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'country.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'country.php';
            </script>";
        }
    }
    $country = $country->getResult();

    $form = '<div class="col gx-2 gy-3 justify-content-center">
    <form action="updateCountry.php?id='.$id.'" method="post" role="form" id="form-add" enctype="multipart/form-data">
        <input type="hidden" name="id" id="id" value="'.$country['country_id'].'">
        <div class="mb-3">
            <label for="country_name" class="form-label">Nama Country</label>
            <input type="text" class="form-control" id="country_name" name="country_name" value="'.$country['country_name'].'" required>
        </div>

        <a href="index.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
        <button type="submit" class="btn btn-primary text-white" name="btn-add" id="btn-add" form="form-add">Update</button>
    </form>
    </div>
    ';
}

// $country->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_FORM', $form);
$view->write();
