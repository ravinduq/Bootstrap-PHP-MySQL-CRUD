<?php require ("include/config.php"); ?>
<?php require ("include/session.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Welcome</title>
</head>

<!-- <body class="bg-light">
    <div class="container">
        <h1 style="text-align:center; margin-top:30%; font-size:50px;" class="text-success">WELCOME</h1>
        <?php
        //$un = $_SESSION['user'];
       // echo $un; ?>
        <div class="row">
            <div class="col-sm-auto m-auto">
                <div class="card card-body">
                    <input type="button" class="btn btn-dark rsranim" value="Logout"
                        onclick="window.location.href='include/logout.php'">
                </div>
            </div>
        </div>
    </div>
</body> -->
<body class="bg-light">
    <div class="container">
        <h1 style="text-align:center; margin-top:30%; font-size:50px;" class="text-success">WELCOME</h1>
        <?php
        $un = $_SESSION['user'];
        echo $un;?>
        <div class="row">
            <div class="col-sm-auto m-auto">
                <div class="card card-body">
                    <input type="button" class="btn btn-dark rsranim" value="Logout"
                        onclick="window.location.href='include/logout.php'">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Birthday</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //require_once 'include/config.php';

                        // Query to select data from the database
                        $sql = "SELECT id, uname, bday, email FROM user";
                        $result = $conn->query($sql);

                        // Check if there are any results
                        if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                               echo "<tr>";
                               echo "<td>". $row["id"]. "</td>";
                               echo "<td>". $row["uname"]. "</td>";
                               echo "<td>". $row["bday"]. "</td>";
                               echo "<td>". $row["email"]. "</td>";
                               echo "</tr>";
                            }
                           } else {
                            echo "No results found.";
                        }

                        $conn->close();
                       ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>