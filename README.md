Win10 EOS Countdown API
Repozytorium zawiera prostą aplikację PHP, która wyświetla licznik odliczający do końca wsparcia dla systemu Windows 10. Zawiera dwie główne części:

index.php - Strona internetowa wyświetlająca odliczający się czas do końca wsparcia.
api.php - API, które zwraca dane o pozostałym czasie w formacie JSON.
Zasada działania
index.php
index.php jest stroną internetową, która prezentuje licznik czasu do końca wsparcia dla systemu Windows 10. Zawiera wszystkie funkcje interfejsu użytkownika, takie jak wyświetlanie aktualnego czasu, formatowanie go w sposób przyjazny oraz informowanie, czy licznik jest aktywny (czyli czy znajdujemy się w dniu roboczym i w godzinach pracy).

Główne funkcje:
Liczenie pozostałego czasu:

Wykorzystywana jest stała data - 14 października 2025 roku o godzinie 16:00, która jest końcem wsparcia dla Windows 10.
Liczenie odbywa się tylko w godzinach roboczych (8:00-16:00) oraz tylko w dni robocze (od poniedziałku do piątku). Weekendy i dni wolne są pomijane.
Wyświetlanie odliczania:

Czas jest przedstawiany w formacie dni, godzin, minut i sekund. Sekundy są wyświetlane w jasnoszarym kolorze, aby były mniej wyróżniające.
Jeśli licznik jest aktywny, pokazuje informację, że licznik działa (np. w dni robocze w godzinach pracy).
W weekendy i dni wolne od pracy, licznik jest nieaktywny, a w interfejsie użytkownika wyświetlana jest informacja o tym stanie.
Motyw strony:

Użytkownicy mogą przełączać między jasnym a ciemnym motywem.
Motyw zmienia się na stronie po kliknięciu w odpowiedni przycisk w prawym górnym rogu.
api.php
api.php udostępnia dane o pozostałym czasie w formacie JSON. Zamiast wyświetlać dane w interfejsie graficznym, zwraca je w postaci odpowiedzi HTTP. Jest to API, które może być używane przez inne aplikacje do integracji z licznikiem czasu.

Główne funkcje:
Obliczanie czasu do końca wsparcia:

Tak jak w przypadku index.php, obliczany jest czas do 14 października 2025 roku o godzinie 16:00.
Czas jest obliczany tylko w godzinach roboczych i tylko w dni robocze. Weekendy oraz dni wolne są pomijane, podobnie jak w aplikacji na stronie.
Zwracanie danych w formacie JSON:

API zwraca dane o pozostałym czasie w postaci JSON. Obejmuje to:
Dni,
Godziny,
Minuty,
Sekundy,
Status, który informuje, czy licznik jest aktywny (czyli czy jest to dzień roboczy i godziny pracy).
Zakres zwracanych danych:

Dane są przetwarzane w PHP, a odpowiedź jest przesyłana w formacie JSON. Zawiera informacje na temat czasu oraz statusu licznika.
Przykład odpowiedzi JSON:
json
Copy
Edit
{
  "days": 100,
  "hours": 12,
  "minutes": 30,
  "seconds": 45,
  "active": true
}
Instrukcja użycia
Uruchamianie lokalnie:
Aby uruchomić projekt lokalnie, wykonaj następujące kroki:

Pobierz lub sklonuj repozytorium:

bash
Copy
Edit
git clone https://github.com/onslowek/win10-eos-countdown.git
Uruchom lokalny serwer PHP w folderze repozytorium:

bash
Copy
Edit
php -S localhost:8000
Odwiedź http://localhost:8000 w swojej przeglądarce, aby zobaczyć licznik.

Możesz także wywołać API pod adresem http://localhost:8000/api.php, aby otrzymać dane w formacie JSON.

Integracja z innymi aplikacjami:
Aby wykorzystać API w innych aplikacjach, wystarczy wykonać zapytanie HTTP do api.php i otrzymać dane o czasie w odpowiedzi JSON. Na przykład w aplikacji JavaScript:

javascript
Copy
Edit
fetch('http://localhost:8000/api.php')
  .then(response => response.json())
  .then(data => console.log(data));
Licencja
Projekt jest udostępniony na licencji MIT, co oznacza, że możesz dowolnie korzystać z tego kodu, modyfikować go i rozpowszechniać, pod warunkiem zachowania informacji o licencji.

Autorzy
Kod został stworzony z pomocą ChatGPT (OpenAI), która była użyta do generowania i optymalizacji kodu PHP, CSS oraz pomoc w strukturze aplikacji.

O licencji MIT:
Licencja MIT to jedna z najbardziej popularnych licencji open-source, która pozwala na swobodne używanie, kopiowanie, modyfikowanie oraz dystrybucję kodu źródłowego. Jednakże, ważne jest, by w przypadku rozpowszechniania kodu zachować odpowiednie informacje o licencji.

Czy możesz udostępniać kod?
Tak, jak najbardziej. Możesz udostępniać ten kod w dowolny sposób, modyfikować go i wdrażać w swoich projektach. Kod, który został stworzony z pomocą ChatGPT, nie podlega żadnym ograniczeniom praw autorskich i jest całkowicie do Twojej dyspozycji.
