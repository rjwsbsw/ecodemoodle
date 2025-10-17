# Docker Setup - ecodemoodle

## Erfolgreicher Setup-Status ✅

**Moodle 3.11.18 läuft** mit custom Docker Image.  
Plugins `ecodebook` und `ecodebookmanager` sind im Image integriert.

## Stack-Komponenten

- **Moodle 3.11.18** (PHP 7.4 + Apache)
- **MariaDB 10.6**
- **phpMyAdmin** (DB-Management)
- **Mailhog** (E-Mail-Testing)

## Voraussetzungen

- Docker Desktop für Windows (mit WSL2)
- WSL Ubuntu
- Git

## Verzeichnisstruktur erstellen

```bash
cd /path/to/ecodemoodle

# Zusätzliche Verzeichnisse anlegen
mkdir -p docker/db-init
mkdir -p docker/php
```

## Setup-Schritte

### 1. Verzeichnisse erstellen

```bash
cd /path/to/ecodemoodle
mkdir -p docker/db-init docker
```

### 2. Environment-Datei erstellen

```bash
cp .env.example .env
# Passwörter bei Bedarf anpassen
```

### 3. Docker Image bauen

```bash
# Image mit Moodle + Plugins bauen
docker-compose build

# Dauer: 2-3 Minuten beim ersten Mal
```

### 4. Container starten

```bash
docker-compose up -d

# Status prüfen
docker-compose ps
```

### 5. Moodle-Installation durchführen

**Browser öffnen:** http://localhost:8080

**Installation Wizard:**

1. **Language:** English (en) oder Deutsch
2. **Paths:** Bestätigen (sind korrekt)
3. **Database Type:** `MariaDB (native/mariadb)`
4. **Database Settings:**
   - Host: **db**
   - Database: **moodle**
   - User: **moodleuser**
   - Password: **moodlepass**
   - Port: **3306**
   - Tables prefix: **mdl_** (default)
5. **Confirm:** Copyright-Hinweise bestätigen
6. **Server checks:** Sollten alle grün sein
7. **Admin-Account:** Selbst festlegen
8. **Site settings:** Nach Bedarf

**Dauer:** 5-10 Minuten

### 6. Plugins automatisch installiert

Nach der Installation erkennt Moodle automatisch:
- **mod_ecodebook** (Activity Module)
- **local_ecodebookmanager** (Admin Plugin)

Die Plugins sind bereits im Docker Image enthalten!

### 7. Zugriff auf Services

- **Moodle:** http://localhost:8080
- **phpMyAdmin:** http://localhost:8081
- **Mailhog:** http://localhost:8025

**Login:** Admin-Zugangsdaten aus Installation

---

## Entwicklungs-Workflow

### Plugin-Code ändern

**WICHTIG:** Plugins sind im Docker Image gebacken, nicht gemountet.

```bash
# 1. Code in ecodebook/ oder ecodebookmanager/ ändern

# 2. Image neu bauen
docker-compose build moodle

# 3. Container neu starten
docker-compose up -d

# 4. Moodle-Cache leeren
docker-compose exec moodle php admin/cli/purge_caches.php

# Optional: Plugin-Upgrade triggern
docker-compose exec moodle php admin/cli/upgrade.php --non-interactive
```

**Shortcut mit Makefile:**
```bash
make rebuild-moodle
```

### Datenbank-Zugriff

**Via phpMyAdmin:** http://localhost:8081

**Via CLI:**
```bash
# MySQL-Client im Container
docker-compose exec db mysql -u moodleuser -p moodle

# Oder von außen
mysql -h 127.0.0.1 -P 3306 -u moodleuser -p moodle
```

### Logs anschauen

```bash
# Alle Logs
docker-compose logs -f

# Nur Moodle
docker-compose logs -f moodle

# PHP-Errors (wenn custom.ini aktiviert)
docker-compose exec moodle tail -f /tmp/php_errors.log
```

## Troubleshooting

### Container startet nicht

```bash
# Alle Container stoppen
docker-compose down

# Volumes löschen (ACHTUNG: Datenverlust!)
docker-compose down -v

# Neu starten
docker-compose up -d
```

### Plugins werden nicht erkannt

```bash
# Permissions prüfen
docker-compose exec moodle ls -la /var/www/html/mod/ecodebook
docker-compose exec moodle ls -la /var/www/html/local/ecodebookmanager

# Ownership korrigieren (falls nötig)
docker-compose exec moodle chown -R www-data:www-data /var/www/html/mod/ecodebook
docker-compose exec moodle chown -R www-data:www-data /var/www/html/local/ecodebookmanager

# Upgrade-Skript manuell laufen lassen
docker-compose exec moodle php admin/cli/upgrade.php --non-interactive
```

### Moodle-Neuinstallation

```bash
# Alle Daten löschen und neu starten
docker-compose down -v
docker-compose up -d

# Oder nur DB zurücksetzen
docker-compose stop moodle
docker-compose exec db mysql -u root -p -e "DROP DATABASE moodle; CREATE DATABASE moodle;"
docker-compose start moodle
```

### Port bereits belegt

Ports in `docker-compose.yml` anpassen:
```yaml
ports:
  - "8090:8080"  # Statt 8080:8080
```

## Nützliche Befehle

```bash
# Shell im Moodle-Container
docker-compose exec moodle bash

# PHP-Version prüfen
docker-compose exec moodle php -v

# Moodle-Version prüfen
docker-compose exec moodle php admin/cli/version.php

# Alle Plugins auflisten
docker-compose exec moodle php admin/cli/plugin_info.php

# Cron manuell ausführen
docker-compose exec moodle php admin/cli/cron.php

# Container neu bauen (nach docker-compose.yml Änderungen)
docker-compose up -d --build
```

## Backup & Restore

### Backup erstellen

```bash
# DB-Dump
docker-compose exec db mysqldump -u moodleuser -p moodle > backup_$(date +%Y%m%d).sql

# Moodledata sichern
docker cp ecodemoodle_app:/var/www/moodledata ./moodledata_backup
```

### Restore

```bash
# DB wiederherstellen
docker-compose exec -T db mysql -u moodleuser -p moodle < backup_20231015.sql

# Moodledata wiederherstellen
docker cp ./moodledata_backup ecodemoodle_app:/var/www/moodledata
```

## Production-Ready machen

Für Produktiv-Deployment anpassen:
- [ ] Starke Passwörter in .env
- [ ] HTTPS-Reverse-Proxy (nginx/traefik)
- [ ] Backup-Strategie
- [ ] Monitoring (Prometheus/Grafana)
- [ ] Volume-Backups auf Host
- [ ] Security-Hardening (fail2ban, etc.)

## Weiterführende Infos

- [Moodle Docker Docs](https://docs.moodle.org/en/Docker)
- [Bitnami Moodle Image](https://hub.docker.com/r/bitnami/moodle)
- [Moodle CLI Scripts](https://docs.moodle.org/en/Administration_via_command_line)