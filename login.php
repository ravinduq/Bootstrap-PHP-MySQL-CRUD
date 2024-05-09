<?php require_once ("include/config.php"); ?>
<?php

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
    // session_start();

    // if (isset($_POST['submit'])) {
    //     $uname = $_POST['uname'];
    //     $pword = $_POST['password'];

    //     $stmt = $conn->prepare("SELECT * FROM user WHERE (uname = ? or email = ?) and pass = ?");
    //     $stmt->bind_param("sss", $uname, $uname, $pword);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     if ($result->num_rows > 0) {
    //         $row = $result->fetch_assoc();
    //         $_SESSION['loggedin'] = true;
    //         $_SESSION['user'] = $row['uname'];
    //         header("Location:./index.php");
    //     } else {
    //         $msg = "Please try again..!";
    //     }

    //     $stmt->close();
    // }

    // $conn->close();
// AI CHATBOT RESULTS

// DECRYPT PASSWORD FROM DATABASE--- USED AI
session_start();

// Function to validate user login
function validateUserLogin($conn, $uname, $pword)
{
    $stmt = $conn->prepare("SELECT * FROM user WHERE (uname =? or email =?) and pass =?");
    $stmt->bind_param("sss", $uname, $uname, $pword);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return false;
    }

    $stmt->close();
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    $uname = $_POST['uname'];
    $pword = $_POST['password'];

    // Validate user login
    $user = validateUserLogin($conn, $uname, $pword);

    if ($user) {
        // Decrypt the password from the database
        $decrypted_password = decrypt_password($user['pass']);

        // Check if the decrypted password matches the entered password
        if ($decrypted_password === $pword) {
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $user['uname'];
            header("Location:./index.php");
            exit;
        } else {
            $msg = "Invalid password. Please try again..!";
        }
    } else {
        $msg = "User not found. Please try again..!";
    }
}

// Function to decrypt the password
function decrypt_password($encrypted_password)
{
    // Implement your decryption logic here
    // For example, you can use a library like OpenSSL to decrypt the password
    // $decrypted_password = openssl_decrypt($encrypted_password, 'AES-256-CBC', 'your-secret-key');
    // return $decrypted_password;
}

$conn->close();

// DECRYPT PASSWORD FROM DATABASE--- USED AI
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