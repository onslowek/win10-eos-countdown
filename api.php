<?php
header('Content-Type: application/json');
date_default_timezone_set('Europe/Warsaw');

$targetDate = new DateTime('2025-10-14 16:00:00');
$now = new DateTime();

// Definiowanie dni wolnych od pracy
$fixedHolidays = ['01-01', '01-06', '05-01', '05-03', '08-15', '11-01', '11-11', '12-25', '12-26'];
$easter = date('Y-m-d', easter_date($now->format('Y')));
$variableHolidays = [date('m-d', strtotime($easter)), date('m-d', strtotime($easter . ' +1 day'))];
$holidays = array_merge($fixedHolidays, $variableHolidays);

// Funkcja do sprawdzania, czy dany dzień to dzień roboczy
function isWorkingDay($date, $holidays) {
    $dayOfWeek = $date->format('N'); // 1 (pon) - 7 (nd)
    return ($dayOfWeek <= 5 && !in_array($date->format('m-d'), $holidays));
}

// Liczenie pozostałych godzin pracy
$remainingSeconds = 0;
$tempDate = clone $now;
$currentHour = (int) $now->format('H');
$inWorkHours = ($currentHour >= 8 && $currentHour < 16);

// Jeśli dzisiaj jest dzień roboczy, ale poza godzinami pracy, pomijamy dzisiejszy dzień
if (isWorkingDay($now, $holidays) && !$inWorkHours) {
    $now->setTime(8, 0); // Ustawienie godziny na 8:00, aby zaczynać od początku dnia roboczego
}

while ($tempDate < $targetDate) {
    if (isWorkingDay($tempDate, $holidays)) {
        if ($tempDate->format('Y-m-d') == $now->format('Y-m-d') && !$inWorkHours) {
            // Dziś, ale poza godzinami pracy – pomijamy
        } else {
            $remainingSeconds += 8 * 3600; // Dodajemy 8 godzin pracy
        }
    }
    $tempDate->modify('+1 day');
}

// Przeliczenie na dni, godziny, minuty i sekundy
$days = floor($remainingSeconds / (8 * 3600));
$hours = floor(($remainingSeconds % (8 * 3600)) / 3600);
$minutes = floor(($remainingSeconds % 3600) / 60);
$seconds = $remainingSeconds % 60;

// Czy licznik jest aktywny (dni robocze + godziny pracy)
$isCounterActive = isWorkingDay($now, $holidays) && $inWorkHours;

echo json_encode([
    "days" => $days,
    "hours" => $hours,
    "minutes" => $minutes,
    "seconds" => $seconds,
    "active" => $isCounterActive
]);
?>
