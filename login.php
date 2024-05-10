<?php require_once ("include/config.php");

session_start();

if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $pword = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM user WHERE (uname =? or email =?)");
    $stmt->bind_param("ss", $uname, $uname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row['pass']; // assuming 'pass' is the column for hashed password
        if (password_verify($pword, $hashed_password)) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $row['uname'];
            header("Location:./index.php");
        } else {
            $msg = "Invalid password. Please try again!";
        }
    } else {
        $msg = "Username or email not found. Please try again!";
    }

    $stmt->close();
}

$conn->close();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
    </style>
    <title>login</title>
</head>

<body class="bg-white">

    <?php if (isset($msg)) { ?>
        <div class="alert alert-warning" role="alert">
            <?php echo $msg; ?>
        </div>
    <?php } ?>
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="card">
            <div class="card-body">

                <h1 class="text-center mb-3 text-success">Login</h1>
                <form action="login.php" method="POST" name="login">
                    <div class="form-group">
                        <input type="text" id="text" name="uname" class="form-control" placeholder="Email / User Name"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password"
                            required>
                    </div>
                    <input name="submit" type="submit" value="Log in" class="btn btn-success btn-block rsranim">
                    <input type="button" value="Sign Up" class="btn btn-primary btn-block rsranim"
                        onclick="window.location.href='reg.php'">
                </form>
            </div>
        </div>
    </div>
</body>

</html>