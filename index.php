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
    <script>
        async function updateCountdown() {
            try {
                const response = await fetch('api.php');
                const data = await response.json();

                document.getElementById('days').innerText = data.days;
                document.getElementById('hours').innerText = data.hours;
                document.getElementById('minutes').innerText = data.minutes;
                document.getElementById('seconds').innerText = data.seconds;
                
                // Aktualizacja statusu
                const statusBar = document.getElementById('status-bar');
                statusBar.style.background = data.active ? "green" : "red";
            } catch (error) {
                console.error("Błąd pobierania danych:", error);
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            updateCountdown();
            setInterval(updateCountdown, 60000); // Aktualizacja co minutę

            // Przycisk zmiany motywu
            const themeToggle = document.getElementById("theme-toggle");
            themeToggle.addEventListener("click", () => {
                document.body.classList.toggle("dark-mode");

                // Zmiana ikony motywu
                themeToggle.innerText = document.body.classList.contains("dark-mode") ? "🌙" : "🌞";
            });

            // Ustawienie szerokości paska statusu
            const statusBar = document.getElementById('status-bar');
            const flipClock = document.querySelector('.flip-clock');
            statusBar.style.width = flipClock.offsetWidth + "px";
        });
    </script>
</head>
<body>
    <div class="container">
        <!-- Ikona zmiany motywu w prawym górnym rogu -->
        <button id="theme-toggle">🌞</button>

        <h1>Koniec wsparcia Windows 10</h1>

        <div class="flip-clock">
            <div class="time-box"><span id="days">--</span><small>Dni</small></div>
            <div class="time-box"><span id="hours">--</span><small>Godzin</small></div>
            <div class="time-box"><span id="minutes">--</span><small>Minut</small></div>
            <div class="time-box seconds"><span id="seconds">--</span><small>Sekund</small></div>
        </div>

        <div id="status-bar"></div>
    </div>
</body>
</html>
