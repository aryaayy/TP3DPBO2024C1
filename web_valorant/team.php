<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Team.php');
include('classes/Template.php');

$team = new Team($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$team->open();
$team->getTeam();

$view = new Template('templates/skintabel.html');

$mainTitle = 'Team';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Kode Team</th>
<th scope="row">Nama Team</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'team';

while ($row = $team->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $row['team_code'] . '</td>
    <td>' . $row['team_name'] . '</td>
    <td style="font-size: 22px;">
        <a href="updateTeam.php?id=' . $row['team_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="deleteTeam.php?id=' . $row['team_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
    </td>
    </tr>';
    $no++;
}

$team->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TABEL', $data);
$view->write();
