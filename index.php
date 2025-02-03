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
        let countdownData = null;

        async function fetchCountdown() {
            try {
                const response = await fetch('api.php');
                const data = await response.json();
                countdownData = {
                    days: data.days,
                    hours: data.hours,
                    minutes: data.minutes,
                    seconds: data.seconds,
                    active: data.active
                };
                updateDisplay();
                updateStatusBar();
            } catch (error) {
                console.error("Błąd pobierania danych:", error);
            }
        }

        function updateDisplay() {
            if (!countdownData) return;
            document.getElementById('days').innerText = countdownData.days;
            document.getElementById('hours').innerText = countdownData.hours;
            document.getElementById('minutes').innerText = countdownData.minutes;
            document.getElementById('seconds').innerText = countdownData.seconds;
        }

        function updateStatusBar() {
            const statusBar = document.getElementById('status-bar');
            if (countdownData && countdownData.active) {
                statusBar.style.background = "green";
            } else {
                statusBar.style.background = "red";
            }
        }

        function startCountdown() {
            setInterval(() => {
                if (!countdownData) return;

                // Odliczanie sekund
                if (countdownData.seconds > 0) {
                    countdownData.seconds--;
                } else {
                    countdownData.seconds = 59;
                    if (countdownData.minutes > 0) {
                        countdownData.minutes--;
                    } else {
                        countdownData.minutes = 59;
                        if (countdownData.hours > 0) {
                            countdownData.hours--;
                        } else {
                            countdownData.hours = 7; // Zmiana pełnego dnia pracy (8 godzin - 1)
                            if (countdownData.days > 0) {
                                countdownData.days--;
                            }
                        }
                    }
                }

                updateDisplay();
                updateStatusBar();
            }, 1000);
        }

        document.addEventListener("DOMContentLoaded", () => {
            fetchCountdown().then(() => {
                startCountdown();
                setInterval(fetchCountdown, 60000); // Aktualizacja z API co minutę
            });
        });
    </script>
</head>
<body>
    <button id="theme-toggle">🌞</button>
    <div class="container">
        <h1>Koniec wsparcia Windows 10</h1>
        <div class="flip-clock">
            <div class="time-box"><span id="days">--</span><small>Dni</small></div>
            <div class="time-box"><span id="hours">--</span><small>Godzin</small></div>
            <div class="time-box"><span id="minutes">--</span><small>Minut</small></div>
            <div class="time-box"><span id="seconds">--</span><small>Sekund</small></div>
        </div>
        <div id="status-bar"></div>
    </div>

    <script>
        // Zmiana motywu
        document.getElementById("theme-toggle").addEventListener("click", () => {
            document.body.classList.toggle("dark-mode");
            document.getElementById("theme-toggle").textContent = document.body.classList.contains("dark-mode") ? "🌙" : "🌞";
        });
    </script>
</body>
</html>
