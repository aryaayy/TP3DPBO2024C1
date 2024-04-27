<?php

class Team extends DB
{
    function getTeam()
    {
        $query = "SELECT * FROM team";
        return $this->execute($query);
    }

    function getTeamById($id)
    {
        $query = "SELECT * FROM team WHERE team_id=$id";
        return $this->execute($query);
    }

    function addTeam($data)
    {
        $code = $data['team_code'];
        $name = $data['team_name'];
        $query = "INSERT INTO team VALUES('', '$code', '$name')";
        return $this->executeAffected($query);
    }

    function updateTeam($id, $data)
    {
        $code = $data['team_code'];
        $name = $data['team_name'];
        $query = "UPDATE team SET team_code='$code', team_name='$name' WHERE team_id='$id'";
        return $this->executeAffected($query);
    }

    function deleteTeam($id)
    {
        $query = "DELETE FROM team WHERE team_id=$id";
        return $this->executeAffected($query);
    }
}
