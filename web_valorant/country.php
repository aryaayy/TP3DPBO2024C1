<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Country.php');
include('classes/Template.php');

$country = new Country($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$country->open();
$country->getCountry();

$view = new Template('templates/skintabel.html');

$mainTitle = 'Country';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Negara</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'country';

while ($row = $country->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $row['country_name'] . '</td>
    <td style="font-size: 22px;">
        <a href="updateCountry.php?id=' . $row['country_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="deleteCountry.php?id=' . $row['country_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
    </td>
    </tr>';
    $no++;
}

$country->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TABEL', $data);
$view->write();
