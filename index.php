<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location:views/login.php');
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Pure Bliss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

    <div id="kiss-container"></div>
    <div class="profile">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> <img src="assets/images/pink cheetah heart.png" alt="cheetah-icon" width="30"></h1>
        <a href="views/logout.php" class="btn logout-btn text-white">Log Out</a>
    </div>

    <h1 class="text-center mb-5 mt-5">Pure Bliss Salon</h1>

    <div class="services">
        <div class="service mt-5">
            <h3 class="service-title">Nail Appointment </h3>
            <p class="service-description">Manicure, pedicure, and gel options available with professional care.</p>
            <button class="book-btn" data-href="views/contact.php">Book Now</button>
        </div>
        <div class="service mt-5">
            <h3 class="service-title">Makeup</h3>
            <p class="service-description">Glam, natural, or bridal — our artists tailor it to your look.</p>
            <button class="book-btn" data-href="views/contact.php">Book Now</button>
        </div>
        <div class="service mt-5">
            <h3 class="service-title">Hair Styling</h3>
            <p class="service-description">From cuts to colors to updos, let our stylists work their magic.</p>
            <button class="book-btn" data-href="views/contact.php">Book Now</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const kissContainer = document.getElementById("kiss-container");
            const bookButtons = document.querySelectorAll(".book-btn"); // Select ALL buttons

            function createKissMark() {
                const kiss = document.createElement("img");
                kiss.src = "assets/images/kiss3.png";
                kiss.classList.add("kiss-mark");

                kiss.style.left = `${Math.random() * window.innerWidth}px`;
                kiss.style.top = `${Math.random() * window.innerHeight}px`;

                kissContainer.appendChild(kiss);

                requestAnimationFrame(() => {
                    kiss.style.opacity = "1";
                    kiss.style.transform = "scale(1.2)";
                });

                setTimeout(() => {
                    kiss.style.opacity = "0";
                    setTimeout(() => kiss.remove(), 1000);
                }, 3500);
            }

            function startKissEffectThenRedirect(url) {
                const interval = setInterval(createKissMark, 250);
                setTimeout(() => {
                    clearInterval(interval);
                    window.location.href = url;
                }, 4500);
            }

            // Attach to all book buttons
            bookButtons.forEach((button) => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();
                    const targetURL = button.getAttribute("data-href");
                    startKissEffectThenRedirect(targetURL);
                });
            });
        });
    </script>
</body>

</html>