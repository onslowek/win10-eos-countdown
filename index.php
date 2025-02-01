<?php
date_default_timezone_set('Europe/Warsaw');

// Data końca wsparcia Windows 10
$targetDate = new DateTime('2025-10-14 16:00:00');
$now = new DateTime();

// Definiujemy dni wolne od pracy (święta stałe i ruchome)
$fixedHolidays = ['01-01', '01-06', '05-01', '05-03', '08-15', '11-01', '11-11', '12-25', '12-26'];
$easter = date('Y-m-d', easter_date($now->format('Y')));
$variableHolidays = [date('m-d', strtotime($easter)), date('m-d', strtotime($easter . ' +1 day'))];
$holidays = array_merge($fixedHolidays, $variableHolidays);

// Funkcja sprawdzająca, czy dany dzień to dzień roboczy
function isWorkingDay($date, $holidays) {
    $dayOfWeek = $date->format('N'); // 1 (pon) - 7 (nd)
    return ($dayOfWeek <= 5 && !in_array($date->format('m-d'), $holidays));
}

// Obliczanie pozostałych godzin pracy
$remainingSeconds = 0;
$tempDate = clone $now;

// Obecna godzina (czy jesteśmy w godzinach pracy?)
$currentHour = (int) $now->format('H');
$inWorkHours = ($currentHour >= 8 && $currentHour < 16);

while ($tempDate < $targetDate) {
    if (isWorkingDay($tempDate, $holidays)) {
        if ($tempDate->format('Y-m-d') == $now->format('Y-m-d') && !$inWorkHours) {
            // Jeśli dzisiaj, ale poza godzinami pracy – pomijamy
        } else {
            $remainingSeconds += 8 * 3600; // Dodajemy 8 godzin pracy
        }
    }
    $tempDate->modify('+1 day');
}

// Konwersja na dni, godziny, minuty i sekundy
$days = floor($remainingSeconds / (8 * 3600));
$hours = floor(($remainingSeconds % (8 * 3600)) / 3600);
$minutes = floor(($remainingSeconds % 3600) / 60);
$seconds = $remainingSeconds % 60;

// Czy licznik ma się odliczać (aktywny w godzinach pracy)
$isCounterActive = isWorkingDay($now, $holidays) && $inWorkHours;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Win10 EOS Countdown</title>
    <link href="https://fonts.googleapis.com/css?family=Orbitron:400,700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            transition: background 0.3s, color 0.3s;
            position: relative;
        }
        .theme-switch {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            font-size: 16px;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            transition: background 0.3s;
        }
        h1 {
            font-family: 'Orbitron', sans-serif;
            color: #0078D7;
            margin-bottom: 20px;
        }
        .flip-clock {
            font-family: 'Orbitron', sans-serif;
            font-size: 48px;
            display: inline-block;
        }
        .flip-clock .digit,
        .flip-clock .separator {
            display: inline-block;
            padding: 15px 10px;
            margin: 2px;
            border-radius: 5px;
            box-shadow: inset 0 4px 8px rgba(0,0,0,0.5);
        }
        .flip-clock .separator {
            color: #0078D7;
        }
        .flip-clock .small {
            font-size: 24px;
            color: #aaa;
        }
        .status-bar {
            width: 90%;
            height: 3px;
            margin: 20px auto;
            border-radius: 5px;
            background: <?= $isCounterActive ? '#28a745' : '#dc3545' ?>;
        }
        
        /* Motyw ciemny */
        body.dark-mode {
            background: #1a1a1a;
            color: #fff;
        }
        .theme-switch.dark-mode {
            background: #0078D7;
            color: #fff;
        }

        /* Motyw jasny */
        body.light-mode {
            background: #f5f5f5;
            color: #333;
        }
        .theme-switch.light-mode {
            background: #333;
            color: #fff;
        }
    </style>
</head>
<body>
    <button class="theme-switch" id="themeToggle">🌙</button>
    
    <div class="container" id="themeContainer">
        <h1>Koniec wsparcia Windows 10</h1>
        <div class="flip-clock" id="counter">
            <?= "$days dni " . sprintf("%02d:%02d:", $hours, $minutes) . "<span class='small'>" . sprintf("%02d", $seconds) . "</span>"; ?>
        </div>
        <div class="status-bar" id="status-bar"></div>
    </div>

    <script>
        let remainingSeconds = <?= $remainingSeconds; ?>;
        let isCounterActive = <?= json_encode($isCounterActive); ?>;
        let themeToggle = document.getElementById("themeToggle");

        function updateCounter() {
            if (!isCounterActive) return; // Zegar nie odlicza, jeśli licznik jest nieaktywny

            remainingSeconds = Math.max(remainingSeconds - 1, 0);

            let days = Math.floor(remainingSeconds / (8 * 3600));
            let hours = Math.floor((remainingSeconds % (8 * 3600)) / 3600);
            let minutes = Math.floor((remainingSeconds % 3600) / 60);
            let seconds = remainingSeconds % 60;

            document.getElementById("counter").innerHTML =
                days + " dni " +
                String(hours).padStart(2, '0') + ":" +
                String(minutes).padStart(2, '0') + ":" +
                "<span class='small'>" + String(seconds).padStart(2, '0') + "</span>";
        }

        function setTheme(theme) {
            document.body.className = theme;
            themeToggle.innerHTML = theme === "dark-mode" ? "🌙" : "☀️";
            localStorage.setItem("theme", theme);
        }

        themeToggle.addEventListener("click", function() {
            let currentTheme = document.body.classList.contains("dark-mode") ? "light-mode" : "dark-mode";
            setTheme(currentTheme);
        });

        window.onload = function() {
            let savedTheme = localStorage.getItem("theme") || "dark-mode";
            setTheme(savedTheme);
            if (isCounterActive) {
                setInterval(updateCounter, 1000);
            }
        };
    </script>
</body>
</html>
