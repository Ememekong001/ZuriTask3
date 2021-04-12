<?php
session_start(); 
if(!isset($_SESSION["email"])){
    header("location:./login.php");
}
$mailname = $_SESSION["email"] ;
$name = $_SESSION["name"];
$phone = $_SESSION["phone"];
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css"/>
        <title>Home</title>
        <link rel="shortcut icon" href="./img/app3.jpg"/>
        <link rel="stylesheet" href="./css/style.css"/>
    </head>
    <body>
        <!--Navbar-->
  	    <nav>
    	    <ul class="nav-ul">
     	 	    <li class="nav-li">
	        	    <img src="img/app3.jpg" class="nav-img"/>
	    	    </li>
	      	    <li class="nav-li quiz-title">Home</li>
    	  	    <li class="nav-li right">
                  <a style="float:right;color:white;" href="logout.php"><i class="fa fa-sign-out"></i>Logout</a>
      		    </li>
    	    </ul>
	    </nav>
	    <br/>
        <div class="main">
            <span align="left">Home/<a style="color:blue;cursor:pointer;">User profile</a></span>
            <br/>
            <br/>
            <div class="row">
        
                </div>
                <div class="col-sm-12">
                <h5 style="font-weight:bold;"><?php echo "Welcome $name!" ; ?></h5>
                    <div class="card details">
                        <table>
                            <tr>
                                <td class="item">Username</td>
                                <td class="value"><?php echo $name; ?></td>
                            </tr>
                            <tr>
                                <td class="item">Email</td>
                                <td class="value"><?php echo $mailname; ?></td>
                            </tr>
                            <tr>
                                <td class="item">Phone</td>
                                <td class="value"><?php echo $phone; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br/>
        
    
    </body>
</html>