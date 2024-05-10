<?php require_once ("include/config.php");

if (isset($_POST['register'])) {
    $un = trim($_POST['uname']);
    $bday = trim($_POST['bday']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['pass']);
    $cpass = trim($_POST['cpass']);

    if ($pass!== $cpass) {
        $msg = "Passwords do not match.";
    } elseif (empty($pass) || empty($cpass)) {
        $msg = "Please enter a password.";
    } else {
        // Encrypt the password before inserting
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (uname, bday, email, pass) VALUES (?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $un, $bday, $email, $hashed_password);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            mysqli_close($conn);
            $msg = "You are successfully registered.";
        } else {
            $msg = "Error in inserting data: ". mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>signin</title>
</head>

<body class="bg-white">

    <div class="row mt-5">
        <div class="col-sm-auto m-auto">

            <?php if (isset($msg)) { ?>
                <div class="alert alert-warning" role="alert"><?php echo $msg; ?></div>
            <?php } ?>

            <div class="rsrshad">
                <div class="card card-body">
                    <h1 class="text-center mb-3 text-primary">Sign Up</h1>
                    <form action="reg.php" method="POST" name="reg">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="text" id="uname" name="uname" class="form-control"
                                        placeholder="User Name" onInput="checkUsername()" required>
                                    <span id="check-username"></span>
                                </div>
                                <div class="col">
                                    <input type="date" id="bday" name="bday" class="form-control"
                                        placeholder="Birth Day" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                                required>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="password" id="pass" name="pass" class="form-control"
                                        placeholder="Password" required>
                                </div>
                                <div class="col">
                                    <input type="password" id="cpass" name="cpass" class="form-control"
                                        placeholder="Confirm Password" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <input type="button" value="Log in" class="btn btn-success btn-block rsranim"
                                        onclick="window.location.href='login.php'">
                                </div>
                                <div class="col">
                                    <input name="register" type="submit" value="Sign Up"
                                        class="btn btn-primary btn-block rsranim">
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function checkUsername() {

            jQuery.ajax({
                url: "include/check_availability.php",
                data: 'uname=' + $("#uname").val(),
                type: "POST",
                success: function (data) {
                    $("#check-username").html(data);
                },
                error: function () { }
            });
        }
    </script>
</body>

</html>