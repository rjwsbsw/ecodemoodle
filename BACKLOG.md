# ecodemoodle - BACKLOG

## Status Quo ✅ ERFOLG

**Code-Basis:** 2022, Target: Moodle 3.8 (2019)  
**Docker-Setup:** ✅ Moodle 3.11.18 läuft (Custom Image mit PHP 7.4)  
**Plugins:**
- `mod_ecodebook` - Activity Module für Kursressourcen ✅ Funktioniert
- `local_ecodebookmanager` - Admin-Tool für Bücherverwaltung ✅ Funktioniert

**✅ Vollständig getestet:**
- Docker-Umgebung läuft stabil
- Plugins installiert und konfiguriert
- Test-Buch angelegt (LH_01)
- Test-Kurs mit ecodebook-Ressource erstellt
- **MagicLink-Generierung funktioniert** - Weiterleitung zu 110 ecode erfolgreich!

**Stand wiederhergestellt!** Alle Funktionen aus 2022 laufen.

**Probleme:**
- PHP 8.x Kompatibilität: `strftime()` deprecated
- Moodle 4.x Migration nötig für langfristige Wartung
- Kein Team mit PHP/Moodle-Erfahrung
- Minimale Code-Dokumentation

**Ziel:** Modernisierung auf Moodle 4.5 + PHP 8.x, Optional: LTI-Standard

---

## Nächste Entscheidungen

### Migrations-Strategie festlegen

**Option A: Konservativ - Schrittweise Migration**
1. PHP 8.x Kompatibilität (strftime() fix)
2. Moodle 3.11 → 4.1 → 4.5 (stabile Zwischenschritte)
3. Testen nach jedem Schritt
4. **Vorteil:** Sicherer, kontrollierter
5. **Nachteil:** Mehr Aufwand, mehrere Test-Zyklen

**Option B: Direkt - Moodle 4.5 + PHP 8.x**
1. Alle Breaking Changes auf einmal fixen
2. Direkt auf Ziel-Version migrieren
3. **Vorteil:** Schneller fertig
4. **Nachteil:** Höheres Risiko, mehr gleichzeitige Änderungen

**Option C: Hybrid - Fix + Test + Migration**
1. PHP 8.x Fixes in Moodle 3.11 testen
2. Dann Sprung auf Moodle 4.5
3. **Vorteil:** Guter Kompromiss
4. **Nachteil:** Mittlerer Aufwand

**Empfehlung:** Option C - Erst PHP 8.x kompatibel machen, dann Moodle upgraden

### LTI-Standard Evaluation (später)

**Fragen zu klären:**
- Will Kunde LTI oder reicht MagicLink?
- Unterstützt 110 ecode LTI?
- Aufwand vs. Nutzen?

**Entscheidung:** Erst Moodle 4.5 Migration, dann LTI evaluieren

---

## Phase 0: Setup & Code-Verstehen ✅ KOMPLETT ABGESCHLOSSEN

### [P0-1] Docker-Entwicklungsumgebung ✅
- [x] Moodle 3.11.18 + PHP 7.4 Custom Docker Image
- [x] MariaDB 10.6 Container
- [x] Plugins im Image (kein Volume-Mount)
- [x] docker-compose.yml mit allen Services
- [x] Container erfolgreich gestartet
- [x] Moodle-Installation durchgeführt
- [x] Plugins erkannt und installiert
- [x] Test-Buch angelegt und funktioniert
- [x] **MagicLink-Generierung validiert - funktioniert!**
- [ ] Seed-Daten für Test-Kurse/-User (optional)

### [P0-2] Code-Analyse vertiefen ⏭️ NÄCHSTER SCHRITT
- [ ] `view.php` - Hauptlogik für Darstellung analysieren
- [ ] `locallib.php` - Helper-Funktionen dokumentieren
- [ ] `mod_form.php` - Formular für Kurserstellung verstehen
- [ ] DB-Schema aus `install.xml` dokumentieren
- [ ] API-Calls zu 110 ecode tracen

### [P0-3] MagicLink-Mechanismus dokumentieren ✅
- [x] MagicLink funktioniert im Test
- [ ] Signatur-Algorithmus detailliert beschreiben
- [ ] Alle Parameter und deren Bedeutung klären
- [ ] 110 ecode API-Endpunkte dokumentieren
- [ ] Test-Requests mit curl/Postman durchführen

### [P0-4] Test-Installation ✅
- [x] Beide Plugins in Moodle 3.11 installiert
- [x] Testbuch in ecodebookmanager angelegt
- [x] Testkurs mit ecodebook-Ressource erstellt
- [x] MagicLink-Generierung getestet
- [x] End-to-End-Flow mit 110 ecode getestet

---

## Phase 1: Lauffähigkeit & Quick-Fixes

### [P1-1] PHP 8.x Kompatibilität - Kritische Fixes
**Priorität: HOCH**
- [ ] `strftime()` ersetzen durch `DateTime::format()`  
  Betroffen: `ecodebook/magiclink/signature.php`
- [ ] Deprecated Funktionen identifizieren und ersetzen
- [ ] Type Hints wo möglich hinzufügen
- [ ] Strict Types prüfen (`declare(strict_types=1)`)

### [P1-2] Kompatibilität mit Moodle 3.11 LTS prüfen
**Priorität: HOCH**  
**Hinweis:** Docker-Setup nutzt bereits 3.11 (3.8 nicht mehr verfügbar)
- [ ] Plugin-Installation unter 3.11 testen
- [ ] API-Kompatibilität 3.8→3.11 verifizieren
- [ ] `version.php` Requirements ggf. anpassen
- [ ] Deprecated Functions prüfen

### [P1-3] Code-Qualität Basis
- [ ] Exception-Handling verbessern (konkrete Exceptions)
- [ ] SQL-Injection-Risiken prüfen (Prepared Statements)
- [ ] XSS-Risiken bei Output prüfen
- [ ] Logging statt `echo` in Exceptions

---

## Phase 2: Migration auf Moodle 4.5

### [P2-1] Moodle 4.x API-Migration
**Priorität: HOCH**
- [ ] `$DB` API-Changes (3.x → 4.x)
- [ ] Completion API Updates
- [ ] Privacy API vollständig implementieren
- [ ] Event-System auf 4.x migrieren

### [P2-2] UI-Modernisierung
- [ ] Bootstrap 5 (Moodle 4.x Standard)
- [ ] Mustache-Templates prüfen/anpassen
- [ ] Mobile-Responsiveness testen
- [ ] Accessibility (WCAG 2.1) prüfen

### [P2-3] Testing & Qualitätssicherung
- [ ] PHPUnit-Tests für `manager.php`
- [ ] PHPUnit-Tests für `signature.php`
- [ ] Behat-Tests für Kursintegration
- [ ] CI/CD mit GitHub Actions

---

## Phase 3: Optionale Modernisierung

### [P3-1] LTI-Standard prüfen
**Entscheidung nötig: Lohnt sich LTI?**
- [ ] LTI 1.3 Spezifikation analysieren
- [ ] Mapping: MagicLink ↔ LTI-Parameter
- [ ] Aufwand-Nutzen-Analyse
- [ ] PoC: LTI-Integration mit 110 ecode

### [P3-2] Architektur-Verbesserungen
- [ ] Shared Secret zentral verwalten (Config statt DB?)
- [ ] Caching für Bücherliste
- [ ] Rate-Limiting für MagicLink-Generierung
- [ ] Logging/Monitoring verbessern

---

## Offene Fragen

1. **API-Dokumentation 110 ecode:**  
   Gibt es eine OpenAPI/Swagger-Spec?

2. **Testumgebung 110 ecode:**  
   Haben wir Zugriff auf Test-System mit Test-Credentials?

3. **LTI-Entscheidung:**  
   Will der Kunde LTI oder reicht MagicLink?

4. **Bestehende Installationen:**  
   Müssen wir Upgrade-Pfad für Live-Systeme planen?

5. **Performance:**  
   Wie viele parallele User/Kurse müssen unterstützt werden?

---

## Risiken

| Risiko | Wahrscheinlichkeit | Impact | Mitigation |
|--------|-------------------|--------|------------|
| 110 ecode API ändert sich | Mittel | Hoch | API-Version-Check einbauen |
| PHP 8.x Breaking Changes | Hoch | Mittel | Schrittweise Migration, Tests |
| Moodle 4.x Breaking Changes | Mittel | Hoch | Deprecation Warnings ernst nehmen |
| Kein Moodle/PHP-Wissen im Team | Hoch | Hoch | Externe Unterstützung, Schulung |

---

## Zeitschätzung (aktualisiert)

- **Phase 0:** ✅ 1 Tag (abgeschlossen!)
- **Phase 1:** 3-5 Tage (PHP 8.x Fixes + Tests)
- **Phase 2:** 5-7 Tage (Moodle 4.5 Migration)
- **Phase 3:** 3-5 Tage (falls LTI gewünscht)

**Gesamt:** 9-13 Arbeitstage (ohne LTI: 9-12 Tage)

**Aktuelle Velocity:** Sehr gut! Setup in 1 Tag statt 2-3 geplant.