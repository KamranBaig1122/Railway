<?php
include_once "db_con.php";

class User extends Db
{
    private $userid, $fname, $lname, $uname, $gender, $password;

    public function __construct($userid = null, $fname = null, $lname = null, $uname = null, $gender = null, $password = null)
    {
        $this->userid = $userid;
        $this->fname = $fname;
        $this->lname = $lname;
        $this->uname = $uname;
        $this->gender = $gender;
        $this->password = $password;
        parent::__construct();
    }


    public  function isUserAlreadyRegister()
    {
        $query = "SELECT * FROM users where username = '$this->uname'";
        if ($this->getConnection()->query($query)->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public  function insert($isadmin)
    {
        $this->password = md5($this->password);
        $query = "INSERT INTO `users`(`firstname`, `lastname`, `username`, `gender`, `password`,`isadmin`) VALUES ('$this->fname','$this->lname','$this->uname',$this->gender,'$this->password','$isadmin')";
        $this->getConnection()->query($query) or die("Failed to insert user");
    }

    public function login()
    {
        $this->password = md5($this->password);
        $query = "SELECT `user_id`,`username`, `status`, `isadmin` FROM `users` WHERE `username` = '$this->uname' and `password` = '$this->password'";
        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to Login");
        }
    }
    public function allUsers()
    {
        $query = "SELECT   `user_id`,`firstname`,`lastname`,`username`, `gender`,`status`, `isadmin` FROM `users`";
        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to get users");
        }
    }
    public function getUserById($id)
    {
        $query = "SELECT   `user_id`,`firstname`,`lastname`,`username`, `gender`,`status`, `isadmin` FROM `users` where `user_id` = '$id'";
        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to get users");
        }
    }

    public function switchAdmin()
    {
        $query = "UPDATE `users` SET `isadmin` = !`isadmin` WHERE `user_id` = $this->userid";
        $result = $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to update users");
        }
    }

    public function switchStatus()
    {
        $query = "UPDATE `users` SET `status` =!`status` WHERE `user_id` = $this->userid";
        $result = $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to update users");
        }
    }

    public function updateUser()
    {
        $query = "UPDATE `users` SET `firstname`='$this->fname',`lastname`='$this->lname',`username`='$this->uname',`gender`='$this->gender' WHERE `user_id` = '$this->userid'";
        $result =  $this->getConnection()->query($query);
        if ($result) {
            return $result;
        } else {
            die("Failed to update users");
        }
    }

    public function deleteUser()
    {
        echo $query = "DELETE FROM `users` WHERE `user_id` = $this->userid";
        $this->getConnection()->query($query) or die("Failed to delete user");;
    }

    public function isAuth()
    {
        $query = "SELECT   `user_id`,`status` FROM `users` where `user_id` =$this->userid";
        $result =  $this->getConnection()->query($query);
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row["status"]) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            die("Failed to get users");
        }
    }

    public function isAdmin()
    {
        $query = "SELECT   `user_id`,`isadmin` FROM `users` where `user_id` =$this->userid";
        $result =  $this->getConnection()->query($query);
        if ($result) {
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if ($row["isadmin"]) {
                    return true;
                } else {
                    return false;
                }
            }
        } else {
            die("Failed to get users");
        }
    }
}
