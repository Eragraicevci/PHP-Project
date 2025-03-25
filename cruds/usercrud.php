<?php
include '../config/connect.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="crud-container">
        <button class="btn btn-info mt-5 mb-5"><a class="text-light" href="../views/signup.php">Add User</a></button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Password</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "Select * from `registration`";

                $result = mysqli_query($con, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $surname = $row['surname'];
                        $username = $row['username'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $password = $row['password'];
                        echo '<tr>
                    <th scope="row">' . $id . '</th>
                  
                    <td>' . $name . '</td>
                    <td>' . $surname . '</td>  
                    <td>' . $username . '</td>
                    <td>' . $email . '</td>
                    <td>' . $phone . '</td>
                    <td>' . $password . '</td>
                    <td>
                    <button class="btn btn-info"><a href="../operations/userupdate.php?updateId=' . $id . '" class="text-light">Update</a></button>
                    <button class="btn btn-danger"><a href="../operations/userdelete.php?deleteId=' . $id . '"  class="text-light">Delete</a></button>
                    </td>
                </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>