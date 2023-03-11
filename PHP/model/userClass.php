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
        public function checkPassword($username, $password)
        {
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

    }
?>