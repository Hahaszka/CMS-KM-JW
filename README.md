# Sklep CMS — Kawiarnia Specialty (WooCommerce + ACF)

Projekt autorskiego motywu WordPress i sklepu internetowego realizowany w ramach laboratorium **Systemy Zarządzania Treścią (SZT)**.

* **Branża:** Kawa specialty i akcesoria do parzenia metodami alternatywnymi (Drip, Chemex, Aeropress).
* **Zespół:** KM & JW

---

## Środowisko deweloperskie (Docker Compose)

Środowisko oparte jest na oficjalnych kontenerach Docker:
* **`wordpress:6-php8.2-apache`** – serwer WWW Apache z PHP 8.2 i włączonym trybem debugowania (`WP_DEBUG`, `SCRIPT_DEBUG`),
* **`mysql:8.0`** – baza danych MySQL 8.0,
* **`wordpress:cli-php8.2`** – narzędzie WP-CLI do automatyzacji instalacji i konfiguracji.

### Porty i dostęp
* **Sklep:** [http://localhost:8081](http://localhost:8081) *(port 8081 ze względu na lokalne usługi systemowe)*
* **Panel administracyjny:** [http://localhost:8081/wp-admin](http://localhost:8081/wp-admin)
  * Użytkownik: `admin`
  * Hasło: `admin_password123`
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
├── style.css                  # Nagłówek i metadane motywu
├── functions.php              # Rejestracja wsparcia WP (title-tag, thumbnails, nav-menus) i kolejkowanie skryptów
├── header.php                 # Semantyczny nagłówek HTML5 (wp_head, nawigacja)
├── footer.php                 # Stopka serwisu (wp_footer, copyright)
├── index.php                  # Szablon nadrzędny / fallback
├── front-page.php             # Dedykowana strona główna (Hero, 3 kafle cech, ostatnie wpisy, newsletter)
├── single.php                 # Szablon pojedynczego wpisu blogowego
├── page.php                   # Szablon stron statycznych
├── 404.php                    # Dedykowana strona błędu 404 z wyszukiwarką
├── screenshot.png             # Podgląd motywu w panelu motywów WP (1200x900)
├── template-parts/
│   └── content.php            # Moduł karty wpisu w pętli The Loop
└── assets/
    ├── css/
    │   └── main.css           # Dedykowane style wizualne motywu
    └── js/
        └── main.js            # Skrypty frontendowe
```

---

## Wymagane wtyczki (Lab 1)
* **Query Monitor** (aktywna) – profilowanie zapytań, analiza hierarchii szablonów i wydajności.
* **Advanced Custom Fields** (aktywna) – przygotowanie pod niestandardowe pola (Lab 2).
* **WooCommerce** (zainstalowana, oczekuje na wdrożenie na Lab 3).
