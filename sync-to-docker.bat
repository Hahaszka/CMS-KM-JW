@echo off
chcp 65001 >nul
title Synchronizacja motywu do Dockera

echo ==========================================================
echo   Synchronizacja wp-content -^> Docker (cms_wordpress)
echo ==========================================================

:: 1. Sprawdzenie czy Docker dziala
docker ps >nul 2>&1
if %ERRORLEVEL% neq 0 (
    echo [BLAD] Docker nie jest uruchomiony! Uruchom Docker Desktop.
    pause
    exit /b 1
)

:: 2. Uruchomienie kontenerow jesli nie dzialaja
docker compose up -d

:: 3. Kopiowanie i nadpisywanie plikow motywu
if exist "wp-content\themes\kawiarnia-theme" (
    echo [1/3] Kopiowanie i nadpisywanie motywu kawiarnia-theme...
    docker cp .\wp-content\themes\kawiarnia-theme\. cms_wordpress:/var/www/html/wp-content/themes/kawiarnia-theme/
    echo   -^> Motyw zsynchronizowany!
)

:: 4. Przeladowanie Apache (czyszczenie OPcache)
echo [2/3] Przeladowanie Apache (czyszczenie OPcache)...
docker compose exec wordpress apache2ctl graceful >nul 2>&1
echo   -^> OPcache przeladowany!

:: 5. Czyszczenie cache i rewrite flush
echo [3/3] Odswiezanie WordPressa i czyszczenie cache (WP-CLI)...
docker compose exec cli wp cache flush >nul 2>&1
docker compose exec cli wp rewrite flush >nul 2>&1
echo   -^> Cache i reguly odswiezone!

echo ==========================================================
echo   SUKCES! Zmiany sa natychmiast widoczne w WordPressie.
echo   Strona sklepu: http://localhost:1234
echo ==========================================================
pause
