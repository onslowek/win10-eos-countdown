<?php
date_default_timezone_set('Europe/Warsaw');
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Win10 EOS Countdown</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script>
        async function updateCountdown() {
            try {
                const response = await fetch('api.php');
                const data = await response.json();

                document.getElementById('days').innerText = String(data.days).padStart(2, '0');
                document.getElementById('hours').innerText = String(data.hours).padStart(2, '0');
                document.getElementById('minutes').innerText = String(data.minutes).padStart(2, '0');
                document.getElementById('seconds').innerText = String(data.seconds).padStart(2, '0');
                
                // Aktualizacja statusu
                const statusBar = document.getElementById('status-bar');
                if (data.active) {
                    statusBar.style.background = "green";
                } else {
                    statusBar.style.background = "red";
                }
            } catch (error) {
                console.error("Błąd pobierania danych:", error);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            updateCountdown();
            setInterval(updateCountdown, 1000); // Aktualizacja co sekundę
        });

        document.getElementById("theme-toggle").addEventListener("click", () => {
            document.body.classList.toggle("dark-mode");
            const icon = document.getElementById("theme-icon");
            if (document.body.classList.contains("dark-mode")) {
                icon.classList.remove("fa-sun");
                icon.classList.add("fa-moon");  // Zmiana na ikonę księżyca
            } else {
                icon.classList.remove("fa-moon");
                icon.classList.add("fa-sun");  // Zmiana na ikonę słońca
            }
        });
    </script>
</head>
<body>
    <div class="container">
        <h1 style="color: #0078D4;">Koniec wsparcia Windows 10</h1>
		<div id="status-bar"></div>
        <div class="flip-clock">
            <div class="time-box"><span id="days">00</span><small>Dni</small></div>
            <div class="time-box"><span id="hours">00</span><small>Godzin</small></div>
            <div class="time-box"><span id="minutes">00</span><small>Minut</small></div>
            <div class="time-box seconds"><span id="seconds">00</span><small>Sekund</small></div>
        </div>
        <button id="theme-toggle">
            <i id="theme-icon" class="fas fa-sun"></i> <!-- Ikona słońca -->
        </button>
    </div>
</body>
</html>
