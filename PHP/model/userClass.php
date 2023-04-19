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

        public function getUserById($idUser) {
            $query = "SELECT * FROM users WHERE id=:idUser";
            $result=$this->prepare($query);
            $result->bindParam(':idUser', $idUser);
            $result->execute();

            $resultUser = $result;
            foreach ($resultUser as $row) {
                $nameUser = $row['username'];
            }
            return $nameUser;
        }


        //Checks if the username exists or not in the DB
        public function checkUsername($username) {
            $query = "SELECT * FROM users WHERE username=?";
            $result = $this->prepare($query);
            $result->bindParam(1, $username);
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
        public function checkLoginPassword($username, $password) {
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

        public function checkPassword($username, $password) {
            $query = "SELECT * FROM users WHERE username=?";
            $result = $this->prepare($query);
            $result->bindParam(1, $username);
            $result->execute();

            foreach($result as $res){
                if($password === $res['cryptPassword']){
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

        public function getEmail($user) {
            $query = "SELECT * FROM users WHERE username=:user";
            $result=$this->prepare($query);
            $result->bindParam(':user', $user);
            $result->execute();

            foreach ($result as $row) {
                $email = $row['mail'];
            }
            return $email;
        }

        public function getEmailById($userid) {
            $query = "SELECT * FROM users WHERE id=:id";
            $result=$this->prepare($query);
            $result->bindParam(':id', $userid);
            $result->execute();

            foreach ($result as $row) {
                $email = $row['mail'];
            }
            return $email;
        }


        public function getUserWithEmail($email) {
            $query = "SELECT * FROM users WHERE mail=:mail";
            $result=$this->prepare($query);
            $result->bindParam(':mail', $email);
            $result->execute();

            foreach ($result as $row) {
                $username = $row['username'];
            }
            return $username;
        }

        public function getIdToken($token) {
            $query = "SELECT * FROM users WHERE token=:token";
            $result=$this->prepare($query);
            $result->bindParam(':token', $token);
            $result->execute();

            foreach ($result as $row) {
                $idUser = $row['id'];
            }
            return $idUser;
        }


        public function setToken($token, $email) {
            $query = "UPDATE users SET token=:token WHERE mail=:mail";
            $result=$this->prepare($query);
            $result->bindParam(':token', $token);
            $result->bindParam(':mail', $email);
            $result->execute();
        }


        public function updateUsername($username, $userId) {
            $query = "UPDATE users SET username=:user WHERE id=:id";
            $result=$this->prepare($query);
            $result->bindParam(':user', $username);
            $result->bindParam(':id', $userId);
            $result->execute();
        }

        public function updateEmail($email, $userId) {
            $query = "UPDATE users SET mail=:mail WHERE id=:id";
            $result=$this->prepare($query);
            $result->bindParam(':mail', $email);
            $result->bindParam(':id', $userId);
            $result->execute();
        }

        public function updatePassword($password, $userId) {
            $query = "UPDATE users SET cryptPassword=:pass WHERE id=:id";
            $result=$this->prepare($query);
            $result->bindParam(':pass', $password);
            $result->bindParam(':id', $userId);
            return $result->execute();
        }


        public function addTeam($name, $arrayPokemon, $userId) {
            $nullValue = null;
            $zeroValue = 0;
            $query = "INSERT INTO teams(teamName, pokemon1, pokemon2, pokemon3, pokemon4, pokemon5, pokemon6, votes, userId) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $result = $this->prepare($query);

            $result->bindParam(1, $name);
            for($i = 1; $i <= 6; $i++){
                if(isset($arrayPokemon[$i])){
                    $result->bindParam(($i+1), $arrayPokemon[$i]);
                } else{
                    $result->bindParam(($i+1), $nullValue);
                }
            }
            $result->bindParam(8, $zeroValue);
            $result->bindParam(9, $userId);

            return $result->execute();
        }

        public function deleteTeam($teamId) {  // NEW FUNCTION (DELETES TEAM FROM TABLE)
            $query = "DELETE FROM teams WHERE id=:teamId";
            $result=$this->prepare($query);
            $result->bindParam(':teamId', $teamId);
            return $result->execute();
        }


        public function updateTeam($name, $arrayPokemon, $teamId) {
            $nullValue = null;
            $query = "UPDATE teams SET teamName = ?, pokemon1 = ?, pokemon2 = ?, pokemon3 = ?, pokemon4 = ?, pokemon5 = ?, pokemon6 = ? WHERE id = ?";
            $result = $this->prepare($query);

            $result->bindParam(1, $name);
            for($i = 1; $i <= 6; $i++){
                if(isset($arrayPokemon[$i])){
                    $result->bindParam(($i+1), $arrayPokemon[$i]);
                } else{
                    $result->bindParam(($i+1), $nullValue);
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

        public function checkExistTeam() {
            $query = "SELECT * FROM teams";
            $result = $this->prepare($query);
            $result->execute();

            foreach($result as $res) { 
                if($res['teamName'] !== ""){
                    return true;
                }else{
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


        public function getUserByTeamId($teamId) {
            $query = "SELECT * FROM teams WHERE id=:teamId";
            $result=$this->prepare($query);
            $result->bindParam(':teamId', $teamId);
            $result->execute();

            foreach($result as $row) {
                $userId = $row["userId"];
            }
            return $userId;
        }


        public function showTeams($idUser) {
            $query = "SELECT * FROM teams WHERE userId=?";
            $result=$this->prepare($query);
            $result->bindParam(1, $idUser);
            $result->execute();

            $arrayTeams=$result->fetchAll();
            return $arrayTeams;
        }

        public function showAllTeams() {
            $query = "SELECT * FROM teams";
            $result=$this->prepare($query);
            $result->execute();

            $arrayTeams=$result->fetchAll();
            return $arrayTeams;
        }
    }
?>