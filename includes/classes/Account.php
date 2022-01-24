<?php

class Account {
    /**
     * Connect to the database
     */
    private $conn;
    /**
     * Create error array variable
     */
    private $errorArray;

    public function __construct($conn) {
        $this->conn = $conn;
        /**
         * Set error array to empty array
         */
        $this->errorArray = array();
    }

    public function login($username, $password) {
        /**
         * Encrypt password
         */
        $password = md5($password);
        /**
         * Check if username already exists
         */
        $query = mysqli_query($this->conn, "SELECT * FROM users WHERE username='$username' AND password = '$password'");
        if(mysqli_num_rows($query) == 1) {
            return true;
        } else {
            array_push($this->errorArray, Constants::$loginFailed);
            return false;
        }
    }
    public function register($username, $firstName, $lastName, $email, $email2, $password, $password2) {
        $this->validateUsername($username);
        $this->validateFirstname($firstName);
        $this->validateLastname($lastName);
        $this->validateEmails($email, $email2);
        $this->validatePasswords($password, $password2);

        if(empty($this->errorArray) == true) {
            //Insert into database
            return $this->insertUserDetails($username, $firstName, $lastName, $email, $password);
        } else {
            return false;
        }

    }

    public function getError($error) {
        if(!in_array($error, $this->errorArray)) {
            $error = "";
        }
            return "<span class='errorMessage'>$error</span>";
    }
    /**
     * Encrypt password
     */
    private function insertUserDetails($username, $firstName, $lastName, $email, $password) {
        $encryptedPw = md5($password);
        $profilePic = "assets/images/profile_pics/20170606_190118.jpg";
        $date = date("Y-m-d");

        /**
         * Variables must be in order of data in table
         */
        $result = mysqli_query($this->conn, "INSERT INTO users VALUES ('', '$username', '$firstName', '$lastName', '$email', '$encryptedPw', '$date', '$profilePic')");

        return $result;
    }

    private function validateUsername($username) {
        if(strlen($username) > 25 || strlen($username) < 5) {
            array_push($this->errorArray, Constants::$usernameLength);
            return;
        }
        
        $checkUsernameQuery = mysqli_query($this->conn, "SELECT username FROM users WHERE username='$username'");
        if(mysqli_num_rows($checkUsernameQuery) != 0) {
            array_push($this->errorArray, Constants::$usernameTaken);
            return;
        } 
    }
    private function validateFirstName($firstName) {
        if(strlen($firstName) > 25 || strlen($firstName) < 2) {
            array_push($this->errorArray, Constants::$firstNameLength);
            return;
        }
    }
    private function validateLastName($lastName) {
        if(strlen($lastName) > 25 || strlen($lastName) < 2) {
            array_push($this->errorArray, Constants::$lastNameLength);
            return;
        }
    }
    private function validateEmails($email, $email2) {
        if($email != $email2) {
            array_push($this->errorArray, Constants::$emailMatch);
            return;
        }

        $checkEmailQuery = mysqli_query($this->conn, "SELECT email FROM users WHERE email='$email'");
        if(mysqli_num_rows($checkEmailQuery) != 0) {
            array_push($this->errorArray, Constants::$emailTaken);
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($this->errorArray, Constants::$emailInvalid);
        }

        //ToDo: Check username hasn't alreday been used.
    }
    private function validatePasswords($password, $password2) {
        if($password != $password2) {
            array_push($this->errorArray, Constants::$passwordsDoNotMatch);
            return;
        }
        /**
         * Check that password doesn't contain any symbols
         */
        if(preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($this->errorArray, Constants::$passwordNotAlphanumeric);
            return;
        }

        if(strlen($password) > 35 || strlen($password) < 5) {
            array_push($this->errorArray, Constants::$passwordLength);
            return;
        }
    }
    
}

?>