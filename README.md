# ecodemoodle

Moodle-Plugins für Integration mit **110 ecode** Plattform (Barrierefreie Online-Bücherregale).

## Status: ✅ Development-Umgebung läuft

- **Moodle 3.11.18** mit PHP 7.4
- **Plugins installiert:** `ecodebook` + `ecodebookmanager`
- **Docker-Stack:** MariaDB, phpMyAdmin, Mailhog

## Quick Start

```bash
# 1. Repository klonen
git clone https://github.com/rjwsbsw/ecodemoodle.git
cd ecodemoodle

# 2. Environment vorbereiten
cp .env.example .env

# 3. Docker Image bauen und starten
docker-compose build
docker-compose up -d

# 4. Moodle installieren
# Browser: http://localhost:8080
# DB: host=db, name=moodle, user=moodleuser, pass=moodlepass

# 5. Optional: Makefile verwenden
make up      # Container starten
make logs-f  # Logs verfolgen
make shell   # Shell im Container
```

## Plugins

### ecodebook (Activity Module)
Kursressource zum Hinzufügen von 110-ecode-Büchern zu Moodle-Kursen.

**Pfad:** `/mod/ecodebook`

### ecodebookmanager (Local Plugin)
Admin-Tool zur Verwaltung der verfügbaren Bücher.

**Pfad:** `/local/ecodebookmanager`

## Entwicklung

**Plugin-Code ändern:**
```bash
# Code in ecodebook/ oder ecodebookmanager/ bearbeiten

# Image neu bauen
make rebuild-moodle

# Oder manuell:
docker-compose build moodle
docker-compose up -d
docker-compose exec moodle php admin/cli/purge_caches.php
```

## Services

- **Moodle:** http://localhost:8080
- **phpMyAdmin:** http://localhost:8081
- **Mailhog:** http://localhost:8025

## Dokumentation

- **[DOCKER-SETUP.md](doku/DOCKER-SETUP.md)** - Ausführliche Setup-Anleitung
- **[BACKLOG.md](BACKLOG.md)** - Projektplanung und Tasks
- **[doku/](doku/)** - Ursprüngliche Dokumentation

## Technische Details

**MagicLink-API:**
Signierte URL-Generierung via HMAC-SHA256 für SSO zu 110 ecode.

**Konfiguration:**
- SharedSecret und OrderSource in ecodebookmanager
- Pro Buch individuell konfigurierbar

**Kompatibilität:**
- Moodle 3.11.x (aktuell)
- Ziel: Migration auf Moodle 4.5

## Projekt-Status

- [x] Phase 0: Docker-Setup und Plugins installiert
- [ ] Phase 1: PHP 8.x Kompatibilität
- [ ] Phase 2: Moodle 4.5 Migration
- [ ] Phase 3: Optional LTI-Standard

Siehe [BACKLOG.md](BACKLOG.md) für Details.

## Team

**Projekt:** Modernisierung Moodle-Plugins für 110 ecode  
**Agentur:** Satzweiss.com Print Web Software GmbH

## Lizenz

GPL v3 (Moodle-Standard)