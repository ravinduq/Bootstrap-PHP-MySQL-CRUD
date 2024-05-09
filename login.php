<?php require_once ("include/config.php"); 

// OLD MANUAL METHOD CODED WITHOUT AI
    // if (isset($_POST['submit'])) {
    //     if (!$conn) {
    //         $msg = "Connection failed: " . mysqli_connect_error();
    //     } else {
    //         $uname = $_POST['uname'];
    //         $pword = $_POST['password'];

    //         $sql = "SELECT * FROM user WHERE (uname = '$uname' or email = '$uname') and pass='$pword' ";
    //         $result = mysqli_query($conn, $sql);
    //         if (mysqli_num_rows($result) > 0) {
    //             $row = mysqli_fetch_assoc($result);
    //             session_start();
    //             $_SESSION['loggedin'] = true;
    //             $_SESSION['user'] = $row['uname'];
    //             header("Location:./index.php");
    //         } else {
    //             $msg = "Please try again..!";
    //         }
    //     }
    // }
// OLD MANUAL METHOD CODED WITHOUT AI

// AI CHATBOT RESULTS
    session_start();

    if (isset($_POST['submit'])) {
        $uname = $_POST['uname'];
        $pword = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM user WHERE (uname = ? or email = ?) and pass = ?");
        $stmt->bind_param("sss", $uname, $uname, $pword);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $row['uname'];
            header("Location:./index.php");
        } else {
            $msg = "Please try again..!";
        }

        $stmt->close();
    }

    $conn->close();
// AI CHATBOT RESULTS

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>

<body class="bg-success">
    <div class="row mt-5">
        <div class="col-sm-auto m-auto">

            <?php if (isset($msg)) { ?>
                <div class="alert alert-warning" role="alert">
                    <?php echo $msg; ?>
                </div>
            <?php } ?>

            <div class="rsrshad">
                <div class="card card-body">

                    <h1 class="text-center mb-3 text-success">Login</h1>
                    <form action="login.php" method="POST" name="login">
                        <div class="form-group">
                            <input type="text" id="text" name="uname" class="form-control"
                                placeholder="Email / User Name" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Password" required>
                        </div>
                        <input name="submit" type="submit" value="Log in" class="btn btn-success btn-block rsranim">
                        <input type="button" value="Sign Up" class="btn btn-primary btn-block rsranim"
                            onclick="window.location.href='reg.php'">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>