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
    <style>
        /* Add hover effect to card */
        .card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* Add fade out effect to welcome text */
        .welcome-text {
            animation: fadeOut 5s forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
</head>

<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <a class="navbar-brand" href="#">Welcome</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="include/logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success welcome-text" role="alert">
                    Welcome, <?php echo $_SESSION['user']; ?>!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
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
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["id"] . "</td>";
                                        echo "<td>" . $row["uname"] . "</td>";
                                        echo "<td>" . $row["bday"] . "</td>";
                                        echo "<td>" . $row["email"] . "</td>";
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
        </div>
    </div>
</body>

</html>