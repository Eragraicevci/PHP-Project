<?php
$success = 0;
include '../config/connect.php';

$slot_query = "SELECT * FROM available_slots ORDER BY slot_date, slot_time";
$slot_result = mysqli_query($con, $slot_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email']) ||
        empty($_POST['phone']) || empty($_POST['slot_id'])
    ) {
        die("Please fill in all required fields including selecting a time slot.");
    }

    $name = mysqli_real_escape_string($con, $_POST['name']);
    $surname = mysqli_real_escape_string($con, $_POST['surname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $comment = mysqli_real_escape_string($con, $_POST['comment']);
    $slot_id = (int)$_POST['slot_id'];

    if ($con) {
        $slot_info_query = mysqli_query($con, "SELECT slot_date, slot_time FROM available_slots WHERE id = $slot_id");

        if (!$slot_info_query || mysqli_num_rows($slot_info_query) == 0) {
            die("Invalid or already booked timeslot. Please refresh and try again.");
        }

        $slot_info = mysqli_fetch_assoc($slot_info_query);
        $slot_date = $slot_info['slot_date'];
        $slot_time = $slot_info['slot_time'];

        $sql = "INSERT INTO `contact` (name, surname, email, phone, comment, slot_date, slot_time) 
                VALUES('$name', '$surname', '$email', '$phone', '$comment', '$slot_date', '$slot_time')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            mysqli_query($con, "DELETE FROM available_slots WHERE id = $slot_id");
            $success = 1;
        } else {
            die("Database insert error: " . mysqli_error($con));
        }
    } else {
        die("Database connection error: " . mysqli_error($con));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div id="page-content" style="opacity: 0;">
        <?php
        if ($success) {
            echo
            '<div class="alert alert-success
   alert-dismissible fade show" role="alert">
  <strong>We have successfully received your message. We will contact you soon :).</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
   </div>';
        }
        ?>

        <h1 class="text-center mt-5">Contact Us</h1>

        <div class="container">
            <div class="contact-container">
                <form action="contact.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Surname</label>
                        <input type="text" class="form-control" name="surname" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Comment</label>
                        <textarea class="form-control" name="comment" rows="4"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Select a Time Slot</label>
                        <select name="slot_id" class="form-control" required>
                            <option value="" disabled selected>Select a time</option>
                            <?php while ($slot = mysqli_fetch_assoc($slot_result)) : ?>
                                <option value="<?= $slot['id'] ?>">
                                    <?= htmlspecialchars($slot['slot_date']) . ' at ' . substr($slot['slot_time'], 0, 5) ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-custom">Submit</button>
                </form>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const pageContent = document.getElementById("page-content");
            if (pageContent) {
                requestAnimationFrame(() => {
                    pageContent.style.opacity = "1";
                });
            }
        });
    </script>

</body>

</html>