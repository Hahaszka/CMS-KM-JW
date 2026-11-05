# Sklep CMS — Kawiarnia Specialty (WooCommerce + ACF)

Projekt autorskiego motywu WordPress i sklepu internetowego realizowany w ramach laboratorium **Systemy Zarządzania Treścią (SZT)**.

* **Branża:** Kawa specialty i akcesoria do parzenia metodami alternatywnymi (Drip V60, Chemex, Aeropress, Espresso).
* **Zespół:** KM & JW

---

## Środowisko deweloperskie (Docker Compose)

Środowisko oparte jest na oficjalnych kontenerach Docker:
* **`wordpress:6-php8.2-apache`** – serwer WWW Apache z PHP 8.2 i włączonym trybem debugowania (`WP_DEBUG`, `SCRIPT_DEBUG`, `WP_ENVIRONMENT_TYPE: local`),
* **`mysql:8.0`** – baza danych MySQL 8.0,
* **`wordpress:cli-php8.2`** – narzędzie WP-CLI do automatyzacji instalacji, migracji i synchronizacji.

### Porty i dostęp
* **Sklep:** [http://localhost:1234](http://localhost:1234)
* **Panel administracyjny:** [http://localhost:1234/wp-admin](http://localhost:1234/wp-admin)
  * Użytkownik: `admin`
  * Hasło: `admin123`
* **MySQL:** `localhost:3306` (baza: `wordpress`, użytkownik: `wp_user` / `wp_password`)

---

## Uruchomienie projektu

1. **Start kontenerów:**
   ```bash
   docker compose up -d
   ```

2. **Zatrzymanie kontenerów:**
   ```bash
   docker compose down
   ```

---

## Struktura motywu (`kawiarnia-theme`)

```text
wp-content/themes/kawiarnia-theme/
├── acf-json/                      # Synchronizacja ACF Local JSON w repozytorium Git
│   ├── group_block_faq.json       # Pola dla bloku acf/faq
│   ├── group_block_hero.json      # Pola dla bloku acf/hero
│   ├── group_block_opinie.json    # Pola dla bloku acf/opinie
│   ├── group_block_usp.json       # Pola dla bloku acf/usp
│   └── group_opinia_details.json  # Pola dla CPT Opinia (ocena, miasto, profil kawy)
├── blocks/                        # Autorskie bloki ACF (Gutenberg)
│   ├── hero/                      # Blok: Hero Palarni (acf/hero)
│   │   ├── block.json
│   │   ├── render.php
│   │   └── style.css
│   ├── usp/                       # Blok: Filary Jakości / USP (acf/usp)
│   │   ├── block.json
│   │   ├── render.php
│   │   └── style.css
│   ├── opinie/                    # Blok: Opinie Klientów z CPT Opinia (acf/opinie)
│   │   ├── block.json
│   │   ├── render.php
│   │   └── style.css
│   └── faq/                       # Blok: FAQ z danymi JSON-LD FAQPage (acf/faq)
│       ├── block.json
│       ├── render.php
│       └── style.css
├── inc/
│   ├── blocks.php                 # Rejestracja bloków ACF + filtr allowed_block_types_all
│   ├── customizer.php             # Dane globalne motywu (telefon, e-mail, adres, social media)
│   └── post-types.php             # Rejestracja CPT: opinia oraz faq
├── style.css                      # Nagłówek i metadane motywu
├── functions.php                  # Główny plik konfiguracyjny, skrypty, hooki i filtry
├── header.php                     # Nagłówek HTML5 z paskiem ogłoszeń z Customizera i menu
├── footer.php                     # Rozbudowana stopka z danymi globalnymi i social media
├── front-page.php                 # Szablon strony głównej renderujący wyłącznie bloki ACF
├── archive-opinia.php             # Szablon archiwum opinii (/opinie/)
├── single-opinia.php              # Widok pojedynczej opinii klienta z oceną gwiazdkową
├── index.php                      # Szablon fallback
├── page.php                       # Szablon stron statycznych
├── single.php                     # Szablon pojedynczego wpisu blogowego
├── 404.php                        # Strona błędu 404 z animowaną filiżanką i wyszukiwarką
├── searchform.php                 # Dedykowany formularz wyszukiwarki
├── screenshot.png                 # Podgląd motywu w panelu motywów WP (1200x900)
├── template-parts/
│   └── content.php                # Moduł karty wpisu w pętli The Loop
└── assets/
    ├── css/
    │   └── main.css               # Dedykowane style wizualne motywu specialty coffee
    ├── images/                    # Wektory favicon.svg, favicon.png, apple-touch-icon
    └── js/
        └── main.js                # Anime.js, interakcje i animacja canvas w tle
```

---

## Realizacja założeń Laboratorium 2

### 1. ACF Local JSON
* Katalog `wp-content/themes/kawiarnia-theme/acf-json/` przechowuje definicje grup pól w formacie JSON.
* Filtry `acf/settings/save_json` oraz `acf/settings/load_json` w `functions.php` gwarantują automatyczny zapis i synchronizację pól w zespole po wykonaniu `git pull`.

### 2. Autorskie bloki ACF (Gutenberg)
Strona główna została złożona wyłącznie z 4 autorskich bloków:
1. **`acf/hero`**: Duży baner palarni ze specyfikacją ziaren specialty (SCA Cupping Score 86-91, Transparent Trade, profil palenia), przyciskami CTA i ambientową animacją.
2. **`acf/usp`**: Trzy kolumny prezentujące filary rzemiosła: *Pochodzenie & Terroir*, *Profilowane Palenie (krzywa RoR)*, *Metody Alternatywne (Drip, Chemex, Aeropress)*.
3. **`acf/opinie`**: Dynamiczna lista rekomendacji pobierana z bazy za pomocą dedykowanego `WP_Query` z typu treści `opinia`.
4. **`acf/faq`**: Rozwijana harmonijka pytań i odpowiedzi (CPT `faq`) z automatycznie generowanymi danymi strukturalnymi **Google Rich Results (JSON-LD FAQPage)**.

### 3. Własny typ treści (CPT: `opinia` i `faq`)
* Zarejestrowany w kodzie w `inc/post-types.php`.
* Dedykowane szablony: `archive-opinia.php` (archiwum pod adresem `/opinie/`) oraz `single-opinia.php` (pojedyncza opinia).
* Pola ACF dla opinii: ocena w skali 1–5 gwiazdek, miejscowość klienta, zakupiony profil kawy.

### 4. Ograniczenie listy bloków
Filtr `allowed_block_types_all` w `inc/blocks.php` ogranicza edytor Gutenberg wyłącznie do autorskich bloków motywu (`acf/hero`, `acf/usp`, `acf/opinie`, `acf/faq`) oraz niezbędnych bloków elementarnych (`core/paragraph`, `core/heading`, `core/list`, `core/list-item`, `core/image`).

### 5. Dane globalne (Customizer)
W module `inc/customizer.php` zarejestrowano sekcję *Dane kawiarni i sklepu* (`kawiarnia_shop_details`):
* Pasek ogłoszeń (góra strony / announcement strip),
* Numer telefonu (link `tel:`),
* Adres e-mail (link `mailto:`),
* Adres lokalu i godziny otwarcia,
* Odnośniki do mediów społecznościowych (Instagram, Facebook).
Dane te są renderowane w `header.php` i `footer.php`.

### 6. Rygorystyczne escapowanie (Brak podatności XSS)
* Zgodnie z wytycznymi w całym motywie obowiązuje zasada **„escapuj późno — tuż przy echo”**.
* **Całkowity brak funkcji `the_field()`** — wszystkie dane pobierane są przez `get_field()` i filtrowane przez odpowiednie funkcje kontekstowe:
  * `esc_html()` dla tekstu wewnątrz tagów,
  * `esc_attr()` dla atrybutów HTML (`id`, `class`, `aria-label`),
  * `esc_url()` dla adresów WWW i linków,
  * `wp_get_attachment_image()` dla obrazków z formatem zwracanym ID,
  * `wp_json_encode()` dla danych strukturalnych JSON-LD.
