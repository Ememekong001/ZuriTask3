<?php
session_start();  
$error = "";
$email = "";
$db = file("users.txt");
$db_str = file_get_contents("users.txt");
$reset_db = file("reset.txt");
$success = false;
$email_arr = [];
$pass_arr = [];

/* Signup */
if (isset($_POST["signup"])) {

    if (empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["confirmpass"]) || empty($_POST["username"]) || empty($_POST["phone"])) {
        $error = "Please fill in all fields!";
    } 
    elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    }
    elseif ($_POST["password"] !== $_POST["confirmpass"]) {
        $error = "The two passwords do not match!";
    }
    elseif (strlen($_POST["password"]) < 8) {
        $error = "Password must be 8 characters or more!";
    }
    else {
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $phone = htmlspecialchars($_POST["phone"]);
        $password = $_POST["password"];
        
        //search file
        for ($i=0; $i < count($db); $i++) { 
            if (explode(" ", $db[$i])[0] == $email) {
                array_push($email_arr, explode(" ", $db[$i])[0]);
            }
        }
        if (count($email_arr) == 0) {
            $success = true;
            if (filesize("users.txt") == 0) {
                file_put_contents("users.txt", $email." ".$password." ".$username." ".$phone);
            } else {
                file_put_contents("users.txt", $db_str."\n".$email." ".$password." ".$username." ".$phone);
            }
            
        }
        else {
            $error = "Email already exists!";
        }
    }
}
elseif (isset($_POST["login"])) {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        $error = "Please fill in all fields!";
    } else {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $session_items = [];
        

        for ($j=0; $j < count($db); $j++) { 
            if (explode(" ", $db[$j])[0] == $email) {
                array_push($pass_arr, explode(" ", $db[$j])[1]);
                array_push($session_items, explode(" ", $db[$j])[2]);
                array_push($session_items, explode(" ", $db[$j])[3]);
            }
        }
        if(!in_array($password, $pass_arr)){
            $error = "Wrong email or password";
        }
        else {
            $_SESSION["email"] = $email;
            $_SESSION["name"] = $session_items[0];
            $_SESSION["phone"] = $session_items[1];
            header("location: ./index.php");
            die;
        }
        
        
    }
    
}
elseif (isset($_POST["getemail"])) {
    if (empty($_POST["email"])) {
        $error = "Please fill in email field!";
    } else {
        $email = $_POST["email"];

        for ($k=0; $k < count($db); $k++) { 
            if (explode(" ", $db[$k])[0] == $email) {
                array_push($email_arr, explode(" ", $db[$k])[0]);
            }
        }
        if (count($email_arr) !== 0) {
                $token = rand(10000000, 99999999);
                $_SESSION["reset"] = true;
                $_SESSION["email"] = $email;
                $_SESSION["code"] = $token;
                if (filesize("users.txt") == 0) {
                    file_put_contents("reset.txt", $email." ".$token);
                } else {
                    file_put_contents("reset.txt", file_get_contents("reset.txt")."\n".$email." ".$token);
                }
                
                header("location:verifycode.php");
            } else {
                $error = "This email does not exist in our system!";
            }
            
        
    }
    
}
elseif (isset($_POST["verifycode"])) {
   if (empty($_POST["token"])) {
       $error = "Please input 8-digit code!";
   } else {
       $token = $_POST["token"];
        $user_arr = [];

       for ($l=0; $l <count($reset_db) ; $l++) { 
           if (explode(" ", $reset_db[$l])[1] == $token) {
                array_push($user_arr, explode(" ", $reset_db[$l])[0]);
           }
       }

       if (count($user_arr) !==0) {
           header("location:changepass.php");
       } else {
           $error = "Invalid or expired token!";
       }
       
   }
   
}

elseif (isset($_POST["resetpass"])) {
    if (empty($_POST["confirmnewpass"]) || empty($_POST["newpass"])) {
        $error = "Please fill in all fields!";
    }
    elseif ($_POST["confirmnewpass"] !== $_POST["newpass"]) {
        $error = "The two passwords do not match";
    } 
    elseif (strlen($_POST["newpass"]) < 8) {
       $error = "Password must be 8 characters or more!";
    }
    else {
        $email = $_SESSION["email"];
        $newpass = $_POST["newpass"];
        $ind = [];

        for ($m=0; $m < count($db); $m++) { 
            if (explode(" ", $db[$m])[0] == $email) {
                array_push($ind, $m);
                array_push($ind, explode(" ", $db[$m])[2]);
                array_push($ind, explode(" ", $db[$m])[3]);
            }
        }
        unset($db[$ind[0]]);
        $success = true;
        file_put_contents("users.txt", implode("", $db)."\n".$email." ".$newpass." ".$ind[1]." ".$ind[2]);
        
    }
    
    
    
}
else {
    //header("location:./");
}