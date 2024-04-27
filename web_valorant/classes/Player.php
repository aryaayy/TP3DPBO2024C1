<?php

class Player extends DB
{
    function getPlayerJoin()
    {
        $query = "SELECT * FROM player JOIN team ON player.team_id=team.team_id JOIN country ON player.country_id=country.country_id";

        return $this->execute($query);
    }

    function getPlayerJoinSorted($data)
    {
        $sortBy = $data['sort_by'];
        $sortOrder = $data['sort_order'];

        $query = "SELECT * FROM player JOIN team ON player.team_id=team.team_id JOIN country ON player.country_id=country.country_id ORDER BY $sortBy $sortOrder";
        return $this->execute($query);
    }

    function getPlayer()
    {
        $query = "SELECT * FROM player";
        return $this->execute($query);
    }

    function getPlayerById($id)
    {
        $query = "SELECT * FROM player JOIN team ON player.team_id=team.team_id JOIN country ON player.country_id=country.country_id WHERE player_id=$id";
        return $this->execute($query);
    }

    function searchPlayer($keyword)
    {
        $query = "SELECT * FROM player JOIN team ON player.team_id=team.team_id JOIN country ON player.country_id=country.country_id WHERE player.player_name LIKE '%$keyword%' OR team.team_name LIKE '%$keyword%' OR country.country_name LIKE '%$keyword%' ORDER BY player.player_id";
        return $this->execute($query);
    }

    function addData($data, $file)
    {
        $name = $data['player_name'];
        $realname = $data['player_realname'];
        $age = $data['player_age'];
        $team_id = $data['team_id'];
        $country_id = $data['country_id'];
        $photo = $file['player_photo']['name'];
        $tempPhoto = $file['player_photo']['tmp_name'];
        $direktori = 'assets/images/'.$photo;
        $isMoved = move_uploaded_file($tempPhoto, $direktori);
        if(!$isMoved){
            $photo = 'icon.png';
        }
        
        $query = "INSERT INTO player VALUES ('', '$name', '$realname', '$age', '$photo', '$country_id', '$team_id')";
        return $this->executeAffected($query);
    }
    
    function updateData($id, $data, $file)
    {
        $name = $data['player_name'];
        $realname = $data['player_realname'];
        $age = $data['player_age'];
        $team_id = $data['team_id'];
        $country_id = $data['country_id'];
        $photo = $file['player_photo']['name'];

        if($photo == ""){
            $query = "UPDATE player SET player_age='$age', player_name='$name', player_realname='$realname', team_id=$team_id, country_id=$country_id WHERE player_id=$id";
        }
        else{
            $tempPhoto = $file['player_photo']['tmp_name'];
            $direktori = 'assets/images/'.$photo;
            $isMoved = move_uploaded_file($tempPhoto, $direktori);
            if(!$isMoved){
                $photo = 'icon.png';
            }
            $query = "UPDATE player SET player_photo='$photo', player_age='$age', player_name='$name', player_realname='$realname', team_id=$team_id, country_id=$country_id WHERE player_id=$id";
        }
        return $this->executeAffected($query);
    }

    function deleteData($id)
    {
        $query = "DELETE FROM player WHERE player_id=$id";
        return $this->executeAffected($query);
    }
}
