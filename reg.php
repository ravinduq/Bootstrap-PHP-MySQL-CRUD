<?php require_once("include/config.php"); ?>
<?php
    if( isset($_POST['register']))
    {
        $un = $_POST['uname'];
        $bday = $_POST['bday'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];

        if(( $pass==$cpass ) && (!$pass="" && !$cpass=""))
        {

                $sql = "INSERT INTO user (uname,bday,email,pass) VALUES ('$un','$bday','$email','$cpass')";
                if(mysqli_query($conn,$sql))
                {
                    mysqli_close($conn);
                    $msg = "You are successfuly registered";
                }
                else
                {
                $msg = "Error in inserting data "."<br/>(". $conn->error .")";
                }
        }
        else
        {
             $msg = " Passwords is not matching..!! ";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>signin</title>
</head>
<body class="bg-info">

<div class="row mt-5">
  <div class="col-sm-auto m-auto">

            <?php if( isset($msg)) { ?>
                <div class="alert alert-warning" role="alert"><?php echo $msg; ?></div>
            <?php } ?>

        <div  class="rsrshad">
            <div class="card card-body">
                    <h1 class="text-center mb-3 text-primary">Sign Up</h1>
                    <form action="reg.php" method="POST" name="reg">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                <input type="text" id="fname" name="uname" class="form-control" placeholder="User Name" required>
                                </div>
                                <div class="col">
                                <input type="date" id="bday" name="bday" class="form-control" placeholder="Birth Day" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
                                </div>
                                <div class="col">
                                    <input type="password" id="cpass" name="cpass" class="form-control" placeholder="Confirm Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="button" value="Log in" class="btn btn-success btn-block rsranim" onclick="window.location.href='login.php'">
                                </div>
                                <div class="col">
                                    <input name="register" type="submit" value="Sign Up" class="btn btn-primary btn-block rsranim">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
    </div>
  </div>
</div>

</body>
</html>