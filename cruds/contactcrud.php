<?php
include '../config/connect.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="crud-container">
        <!-- <button class="btn btn-info mt-5 mb-5"><a class="text-light" href="../views/signup.php">Add Message</a></button>-->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Serial Number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Surname</th>
                    <th scope="col">Email Address</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Message</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $sql = "Select * from `contact`";

                $result = mysqli_query($con, $sql);
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $surname = $row['surname'];
                        $email = $row['email'];
                        $phone = $row['phone'];
                        $comment = $row['comment'];
                        echo '<tr>
                    <th scope="row">' . $id . '</th>
                    <td>' . $name . '</td>
                    <td>' . $surname . '</td>  
                    <td>' . $email . '</td>
                    <td>' . $phone . '</td>
                    <td>' . $comment . '</td>
                    <td>
                    <button class="btn btn-info"><a href="../operations/contactupdate.php?contactUpdateId=' . $id . '" class="text-light">Update</a></button>
                    <button class="btn btn-danger"><a href="../operations/contactdelete.php?contactDeleteId=' . $id . '"  class="text-light">Delete</a></button>
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
</body>

</html>