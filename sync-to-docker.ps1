# ==============================================================================
# Skrypt synchronizacji motywu i wp-content do kontenera Docker (WordPress)
# ==============================================================================
# Uzycie:
#   .\sync-to-docker.ps1
# lub kliknij dwukrotnie w Eksploratorze:
#   sync-to-docker.bat
# ==============================================================================

Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host "  Synchronizacja wp-content -> Docker (cms_wordpress)    " -ForegroundColor Cyan
Write-Host "==========================================================" -ForegroundColor Cyan

# 1. Sprawdzenie czy Docker dziala
$dockerCheck = docker ps 2>&1
if ($LASTEXITCODE -ne 0) {
    Write-Host "[BLAD] Docker nie odpowiada. Uruchom Docker Desktop i sprobuj ponownie." -ForegroundColor Red
    exit 1
}

# 2. Uruchomienie kontenerow jesli nie dzialaja
$containerRunning = docker ps --filter "name=cms_wordpress" --filter "status=running" -q
if (-not $containerRunning) {
    Write-Host "[INFO] Kontenery nie dzialaja. Uruchamiam: docker compose up -d..." -ForegroundColor Yellow
    docker compose up -d
    Start-Sleep -Seconds 3
}

# 3. Kopiowanie i nadpisywanie plikow motywu kawiarnia-theme
if (Test-Path "wp-content/themes/kawiarnia-theme") {
    Write-Host "[1/3] Kopiowanie i nadpisywanie motywu kawiarnia-theme..." -ForegroundColor Yellow
    docker cp ./wp-content/themes/kawiarnia-theme/. cms_wordpress:/var/www/html/wp-content/themes/kawiarnia-theme/
    Write-Host "  -> Motyw zsynchronizowany!" -ForegroundColor Green
}

# 4. Kopiowanie wlasnych pluginow (jesli istnieja)
$customPlugins = Get-ChildItem -Path "wp-content/plugins" -Directory -Filter "kawiarnia-*" -ErrorAction SilentlyContinue
if ($customPlugins) {
    foreach ($plugin in $customPlugins) {
        Write-Host "[+] Kopiowanie pluginu $($plugin.Name)..." -ForegroundColor Yellow
        docker cp "./wp-content/plugins/$($plugin.Name)/." "cms_wordpress:/var/www/html/wp-content/plugins/$($plugin.Name)/"
    }
}

# 5. Przeladowanie Apache (czyszczenie cache OPcache)
Write-Host "[2/3] Przeladowanie serwera Apache (czyszczenie OPcache PHP)..." -ForegroundColor Yellow
docker compose exec wordpress apache2ctl graceful 2>$null
Write-Host "  -> OPcache przeladowany!" -ForegroundColor Green

# 6. Czyszczenie cache i przeladowanie regul WordPressa
Write-Host "[3/3] Czyszczenie cache WP i przeladowanie permalinkow (WP-CLI)..." -ForegroundColor Yellow
docker compose exec cli wp cache flush 2>$null
docker compose exec cli wp rewrite flush 2>$null
Write-Host "  -> Cache i reguly odswiezone!" -ForegroundColor Green

Write-Host "==========================================================" -ForegroundColor Cyan
Write-Host "  SUKCES! Wszystkie zmiany sa natychmiast widoczne w WP! " -ForegroundColor Green
Write-Host "  Adres sklepu: http://localhost:1234                    " -ForegroundColor White
Write-Host "==========================================================" -ForegroundColor Cyan
