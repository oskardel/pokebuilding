<?php
    class User extends Model 
    {
        //Inserts new user into the DB
        public function insertUser($username, $password, $email) {
            $defaultTeams = 0;
            $defaultLevel = 1;

            $query = "INSERT INTO users(username, cryptPassword, mail, teams, userLevel) VALUES (?, ?, ?, ?, ?)";
            $result = $this->prepare($query);
            $result->bindParam(1, $username);
            $result->bindParam(2, $password);
            $result->bindParam(3, $email);
            $result->bindParam(4, $defaultTeams);
            $result->bindParam(5, $defaultLevel);

            return $result->execute();
        }

        
        //Returns the ID of the username
        public function getIdUser($user) {
            $query = "SELECT * FROM users WHERE username=:user";
            $result = $this->prepare($query);
            $result->bindParam(':user', $user);
            $result->execute();
             
            $resultUser = $result;
            foreach ($resultUser as $row) {
                $nameUser = $row['id'];
            }
            return $nameUser;
        }


        //Checks if the username exists or not in the DB
        public function checkUsername($username) {
            $query = "SELECT * FROM users WHERE username=?";
            $result = $this->prepare($query);
            $result->bindParam(1, $email);
            $result->execute();

            foreach($result as $res){
                if($username === $res['username']){
                    return true;
                } else{
                    return false;
                }
            }
        }


        //Checks if the password is correct or not
        public function checkPassword($username, $password) {
            $query = "SELECT * FROM users WHERE username=?";
            $result = $this->prepare($query);
            $result->bindParam(1, $username);
            $result->execute();
            foreach($result as $res){
                $checkPass = crypt($password, $res['cryptPassword']);
                if($checkPass === $res['cryptPassword']){
                    return true;
                } else{
                    return false;
                }
            }
        }


        //Checks if the email exists or not in the DB
        public function checkEmail($email) {
            $query = "SELECT * FROM users WHERE mail=?";
            $result = $this->prepare($query);
            $result->bindParam(1, $email);
            $result->execute();

            foreach($result as $res){
                if($email === $res['mail']){
                    return true;
                } else{
                    return false;
                }
            }
        }


        public function addTeam($name, $arrayPokemon, $userId) {
            $prueba = null;
            $query = "INSERT INTO teams(teamName, pokemon1, pokemon2, pokemon3, pokemon4, pokemon5, pokemon6, userId) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $result = $this->prepare($query);

            $result->bindParam(1, $name);
            for($i = 1; $i <= 6; $i++){
                if(isset($arrayPokemon[$i])){
                    $result->bindParam(($i+1), $arrayPokemon[$i]);
                } else{
                    $result->bindParam(($i+1), $prueba);
                }
            }
            $result->bindParam(8, $userId);

            return $result->execute();
        }


        public function updateTeam($name, $arrayPokemon, $teamId) {
            $prueba = null;
            $query = "UPDATE teams SET teamName = ?, pokemon1 = ?, pokemon2 = ?, pokemon3 = ?, pokemon4 = ?, pokemon5 = ?, pokemon6 = ? WHERE id = ?";
            $result = $this->prepare($query);

            $result->bindParam(1, $name);
            for($i = 1; $i <= 6; $i++){
                if(isset($arrayPokemon[$i])){
                    $result->bindParam(($i+1), $arrayPokemon[$i]);
                } else{
                    $result->bindParam(($i+1), $prueba);
                }
            }
            $result->bindParam(8, $teamId);

            return $result->execute();
        }


        public function addNumberTeam($user) {
            $query = "UPDATE users SET teams = teams + 1 WHERE id=:idUser";
            $result=$this->prepare($query);
            $result->bindParam(':idUser', $user);
            $result->execute();
        }


        public function checkTeamName($team) {
            $query = "SELECT * FROM teams WHERE teamName=:team";
            $result = $this->prepare($query);
            $result->bindParam(':team', $team);
            $result->execute();

            foreach($result as $res){
                if($team === $res['teamName']){
                    return true;
                } else{
                    return false;
                }
            }
        }


        public function getTeamId($team) {
            $query = "SELECT * FROM teams WHERE teamName=:team";
            $result=$this->prepare($query);
            $result->bindParam(':team', $team);
            $result->execute();

            foreach ($result as $row) {
                $teamId = $row['id'];
            }
            return $teamId;
        }


        public function showTeams($idUser) {
            $query = "SELECT * FROM teams WHERE userId=?";
            $result=$this->prepare($query);
            $result->bindParam(1, $idUser);
            $result->execute();

            $arrayTeams=$result->fetchAll();
            return $arrayTeams;
        }
    }
?>