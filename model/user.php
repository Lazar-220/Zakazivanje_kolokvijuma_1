<?php
    class User{
        
        public $id;
        public $username;
        public $password;

        public function __construct($id=null,$username=null,$password=null){
            $this->id=$id;
            $this->username=$username;
            $this->password=$password;
        }

        public static function logInUser($user,mysqli $conn){

            $username = $conn->real_escape_string($user->username);
            $password = $conn->real_escape_string($user->password);

            $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

            $result=$conn->query($sql);

            if($result && $result->num_rows === 1){

                $red=$result->fetch_assoc();       //assoc - asocijativni niz , pretvara podatke iz jednog reda tabele(prvi naredni red) u kombinaciju kljuc vrednost za svaku kolonu

                $user->id=$red['id'];

                return $user;
            }else{
                return null;
            }
            
        }
    }
?>