#!/usr/bin/env bash
# ==============================================================================
# Skrypt synchronizacji wp-content do kontenera Docker (WordPress)
# ==============================================================================

set -e

echo "=========================================================="
echo "  Synchronizacja wp-content -> Docker (cms_wordpress)    "
echo "=========================================================="

# 1. Uruchomienie kontenerów jeśli leżą
docker compose up -d

# 2. Kopiowanie i nadpisywanie plików
echo "[1/3] Kopiowanie lokalnego wp-content/ do kontenera..."
docker cp ./wp-content/. cms_wordpress:/var/www/html/wp-content/

# 3. Uprawnienia
echo "[2/3] Ustawianie uprawnień www-data..."
docker compose exec -u 0:0 wordpress chown -R www-data:www-data /var/www/html/wp-content
docker compose exec -u 0:0 wordpress chmod -R 775 /var/www/html/wp-content

# 4. Czyszczenie cache i rewrite
echo "[3/3] Odświeżanie reguł i cache..."
docker compose exec cli wp cache flush 2>/dev/null || true
docker compose exec cli wp rewrite flush 2>/dev/null || true

echo "=========================================================="
echo "  GOTOWE! Zawartość wp-content została zsynchronizowana."
echo "  Strona: http://localhost:1234"
echo "=========================================================="

