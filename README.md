# Windows 10 EOS Countdown - Licznik czasu do końca wsparcia systemu Windows 10

Repozytorium zawiera aplikację PHP, która wyświetla licznik odliczający do końca wsparcia dla systemu Windows 10. Składa się z trzech głównych plików:

1. **`index.php`** - Strona internetowa wyświetlająca odliczający się czas.
2. **`api.php`** - API zwracające dane o pozostałym czasie w formacie JSON.
3. **`styles.css`** - Plik stylów odpowiadający za wygląd aplikacji.

## 🔧 Zasada działania

### `index.php`
`index.php` to strona internetowa, która prezentuje licznik czasu do końca wsparcia dla systemu Windows 10. Główne funkcje:

- **Liczenie pozostałego czasu**:
  - Data końcowa: **14 października 2025 roku, godzina 16:00**.
  - Czas odliczany jest tylko w dni robocze, w godzinach pracy (8:00-16:00).
  - Weekendy i dni wolne od pracy są pomijane.
- **Wyświetlanie odliczania**:
  - Czas wyświetlany w formacie **DD:HH:MM:SS**.
  - Sekundy mają jaśniejszy kolor dla lepszej czytelności.
  - Informacja o aktywności licznika (czy trwa dzień roboczy).
- **Motyw strony**:
  - Możliwość przełączania między jasnym a ciemnym motywem.
  - Przycisk zmiany motywu w prawym górnym rogu strony.

### `api.php`
`api.php` to API, które zwraca dane o pozostałym czasie w formacie JSON. Główne funkcje:

- **Obliczanie czasu do końca wsparcia**:
  - Używa tych samych zasad co `index.php`.
  - Pomija weekendy i dni wolne.
- **Zwracanie danych w formacie JSON**:
  - Dane zawierają dni, godziny, minuty, sekundy oraz status aktywności.
  - Przykładowa odpowiedź:
    ```json
    {
      "days": 100,
      "hours": 12,
      "minutes": 30,
      "seconds": 45,
      "active": true
    }
    ```

### `styles.css`
`styles.css` definiuje wygląd strony:

- **Stylizacja zegara**:
  - Elastyczny układ oparty na Flexboxie.
  - Automatyczne dopasowanie szerokości do ekranu.
- **Tryb ciemny i jasny**:
  - Obsługa przełączania motywu.
  - Przycisk w prawym górnym rogu.
- **Responsywność**:
  - Dostosowanie układu do urządzeń mobilnych.
  - Optymalne skalowanie elementów.

## 📂 Struktura plików
```
📦 windows10-eos-countdown
├── 📄 index.php       # Główna strona internetowa
├── 📄 api.php         # API zwracające dane o liczniku
├── 📄 styles.css      # Plik ze stylami
└── 📄 README.md       # Dokumentacja projektu
```

## 📜 Licencja
Projekt jest udostępniony na licencji MIT, co oznacza, że możesz dowolnie korzystać z tego kodu, modyfikować go i rozpowszechniać, pod warunkiem zachowania informacji o licencji.

## 👨‍💻 Autorzy
Kod został stworzony przy użyciu OpenAI ChatGPT i dostosowany przez społeczność GitHub.

---
🔹 **Czy możesz udostępniać kod?** Tak! Możesz go modyfikować i wdrażać w swoich projektach. 🎯
