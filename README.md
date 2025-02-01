# Win10 EOS Countdown (Licznika czasu do końca wsparcia systemu Windows 10)

Repozytorium zawiera prostą aplikację PHP, która wyświetla licznik odliczający do końca wsparcia dla systemu Windows 10. Zawiera dwie główne części:

1. **`index.php`** - Strona internetowa wyświetlająca odliczający się czas do końca wsparcia.
2. **`api.php`** - API, które zwraca dane o pozostałym czasie w formacie JSON.

### Zasada działania

#### `index.php`
`index.php` jest stroną internetową, która prezentuje licznik czasu do końca wsparcia dla systemu Windows 10. Zawiera wszystkie funkcje interfejsu użytkownika, takie jak wyświetlanie aktualnego czasu, formatowanie go w sposób przyjazny oraz informowanie, czy licznik jest aktywny (czyli czy znajdujemy się w dniu roboczym i w godzinach pracy).

##### Główne funkcje:
1. **Liczenie pozostałego czasu**: 
   - Wykorzystywana jest stała data - **14 października 2025 roku** o godzinie **16:00**, która jest końcem wsparcia dla Windows 10.
   - Liczenie odbywa się tylko w godzinach roboczych (8:00-16:00) oraz tylko w dni robocze (od poniedziałku do piątku). Weekendy i dni wolne są pomijane.

2. **Wyświetlanie odliczania**: 
   - Czas jest przedstawiany w formacie dni, godzin, minut i sekund. Sekundy są wyświetlane w jasnoszarym kolorze, aby były mniej wyróżniające.
   - Jeśli licznik jest aktywny, pokazuje informację, że licznik działa (np. w dni robocze w godzinach pracy).
   - W weekendy i dni wolne od pracy, licznik jest nieaktywny, a w interfejsie użytkownika wyświetlana jest informacja o tym stanie.

3. **Motyw strony**:
   - Użytkownicy mogą przełączać między jasnym a ciemnym motywem.
   - Motyw zmienia się na stronie po kliknięciu w odpowiedni przycisk w prawym górnym rogu.

#### `api.php`
`api.php` udostępnia dane o pozostałym czasie w formacie JSON. Zamiast wyświetlać dane w interfejsie graficznym, zwraca je w postaci odpowiedzi HTTP. Jest to API, które może być używane przez inne aplikacje do integracji z licznikiem czasu.

##### Główne funkcje:
1. **Obliczanie czasu do końca wsparcia**:
   - Tak jak w przypadku `index.php`, obliczany jest czas do **14 października 2025 roku** o godzinie **16:00**.
   - Czas jest obliczany tylko w godzinach roboczych i tylko w dni robocze. Weekendy oraz dni wolne są pomijane, podobnie jak w aplikacji na stronie.

2. **Zwracanie danych w formacie JSON**:
   - API zwraca dane o pozostałym czasie w postaci JSON. Obejmuje to:
     - Dni,
     - Godziny,
     - Minuty,
     - Sekundy,
     - Status, który informuje, czy licznik jest aktywny (czyli czy jest to dzień roboczy i godziny pracy).

3. **Zakres zwracanych danych**:
   - Dane są przetwarzane w PHP, a odpowiedź jest przesyłana w formacie JSON. Zawiera informacje na temat czasu oraz statusu licznika.
   - Przykład odpowiedzi JSON:
     ```json
     {
       "days": 100,
       "hours": 12,
       "minutes": 30,
       "seconds": 45,
       "active": true
     }
     ```

---

### Instrukcja użycia

#### Uruchamianie lokalnie:
Aby uruchomić projekt lokalnie, wykonaj następujące kroki:

1. Pobierz lub sklonuj repozytorium:
   ```bash
   git clone https://github.com/onslowek/win10-eos-countdown.git
