# Makefile für ecodemoodle Docker-Umgebung

.PHONY: help up down restart logs shell db-shell purge install backup restore status

# Default: Hilfe anzeigen
help:
	@echo "ecodemoodle Docker Commands:"
	@echo ""
	@echo "  make up          - Container starten"
	@echo "  make down        - Container stoppen"
	@echo "  make restart     - Container neu starten"
	@echo "  make logs        - Logs anzeigen"
	@echo "  make logs-f      - Logs live verfolgen"
	@echo "  make shell       - Moodle Container Shell"
	@echo "  make db-shell    - MySQL Shell"
	@echo "  make purge       - Moodle Cache leeren"
	@echo "  make install     - Plugins installieren"
	@echo "  make status      - Container Status"
	@echo "  make backup      - DB Backup erstellen"
	@echo "  make clean       - Alles löschen (inkl. Volumes)"
	@echo ""

# Container starten
up:
	docker-compose up -d
	@echo "Container gestartet."
	@echo ""
	@echo "WICHTIG: Beim ersten Start Moodle-Installation durchführen:"
	@echo "  1. Browser öffnen: http://localhost:8080"
	@echo "  2. Installation Wizard folgen (DB Host: db)"
	@echo ""
	@echo "Weitere Dienste:"
	@echo "  phpMyAdmin:  http://localhost:8081"
	@echo "  Mailhog:     http://localhost:8025"

# Container stoppen
down:
	docker-compose down

# Container neu starten
restart:
	docker-compose restart

# Moodle neu bauen nach Code-Änderungen
rebuild-moodle:
	@echo "Baue Moodle-Image neu..."
	docker-compose build moodle
	@echo "Starte Container neu..."
	docker-compose up -d moodle
	@echo "Leere Cache..."
	docker-compose exec moodle php admin/cli/purge_caches.php
	@echo "✓ Fertig! Moodle mit neuen Plugins läuft."

# Logs anzeigen (letzten 100 Zeilen)
logs:
	docker-compose logs --tail=100

# Logs live verfolgen
logs-f:
	docker-compose logs -f

# Shell im Moodle-Container
shell:
	docker-compose exec moodle bash

# MySQL Shell
db-shell:
	docker-compose exec db mysql -u moodleuser -p moodle

# Moodle Cache leeren
purge:
	docker-compose exec moodle php admin/cli/purge_caches.php
	@echo "✓ Cache geleert"

# Plugins installieren/upgraden
install:
	docker-compose exec moodle php admin/cli/upgrade.php
	@echo "✓ Plugin-Installation abgeschlossen"

# Container Status
status:
	docker-compose ps

# DB Backup erstellen
backup:
	@mkdir -p backups
	docker-compose exec -T db mysqldump -u moodleuser -pmoodlepass moodle > backups/backup_$$(date +%Y%m%d_%H%M%S).sql
	@echo "✓ Backup erstellt: backups/backup_$$(date +%Y%m%d_%H%M%S).sql"

# Alles löschen (VORSICHT!)
clean:
	@echo "WARNUNG: Löscht alle Container UND Daten!"
	@read -p "Fortfahren? [y/N] " confirm && [ "$$confirm" = "y" ] || exit 1
	docker-compose down -v
	@echo "✓ Alles gelöscht"

# PHP-Version anzeigen
php-version:
	docker-compose exec moodle php -v

# Moodle-Version anzeigen
moodle-version:
	docker-compose exec moodle php admin/cli/version.php

# Alle Plugins auflisten
list-plugins:
	docker-compose exec moodle php admin/cli/plugin_info.php

# Cron manuell ausführen
cron:
	docker-compose exec moodle php admin/cli/cron.php

# Test: ecodebook Plugin prüfen
test-ecodebook:
	@echo "Prüfe ecodebook Plugin..."
	docker-compose exec moodle ls -la /var/www/html/mod/ecodebook
	@echo ""
	@echo "Prüfe ecodebookmanager Plugin..."
	docker-compose exec moodle ls -la /var/www/html/local/ecodebookmanager