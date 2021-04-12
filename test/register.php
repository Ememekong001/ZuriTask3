<?php
include("auth.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login | Test</title>
        <link rel="shortcut icon" href="./img/app3.jpg"/>
        <link rel="stylesheet" href="./css/style.css"/>
    </head>
    <body id="login-body">
        <center>
            <div class="card login-card">
                <h3 class="txt-b">Account Registration</h3>
                <br/>
                <center>
                    <img class="login-img" src="./img/app3.jpg"/>
                </center>
                <br/>
                <form method="POST" action="">
                    <p align="left">Email </p>
                    <input class="input-control" name="email" type="email" placeholder="Enter Email"/>
                    <br/>
                    <p align="left">Username</p>
                    <input type="text" name="username" class="input-control" placeholder="Enter Username"/>
                    <br/>
                    <p align="left">Phone number</p>
                    <input type="text" name="phone" class="input-control" placeholder="Enter Phone number"/>
                    <br/>
                    <p align="left">Password </p>
                    <input type="password" name="password" class="input-control" placeholder="Enter Password"/>
                    <br/>
                    <p align="left">Confirm Password </p>
                    <input type="password" name="confirmpass" class="input-control" placeholder="Re-enter Password"/>
                    <br/>
                    <?php
                    if($success) {
                        header("location: login.php?register_success=true");
                    }
                    else {
                        echo '<div class="error">'.$error.'</div>';
                    }
                    ?>
                    <br/>
                    <center>
                        <button class="login-btn" name="signup">Register</button>
                    </center>
                </form>
                <small>Already have an account? <a href="login.php"><i>Login</i></a></small><br/>
            </div>
        </center>
    </body>
</html>