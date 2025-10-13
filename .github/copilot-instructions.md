copilot-instructions.md

Zweck

Diese Datei beschreibt empfohlene Anweisungen (Prompts) und Verhaltensregeln für die Verwendung von AI-gestützten Coding-Tools (z. B. GitHub Copilot) im Repository `ecodemoodle`.

Kurz: Nutze Copilot als Assistenz — nicht als endgültige Autorität. Prüfe alle Vorschläge manuell, achte auf Sicherheit, Testabdeckung und Einhaltung der Moodle/Project-Konventionen.

1. Projekt-Kontext

- Sprache: Hauptsächlich PHP (Moodle-Plugin). Zusätzlich: JavaScript, CSS, Mustache-Templates, PHPUnit-Tests.
- Struktur: Plugins `ecodebook`, `ecodebookmanager` und weitere Unterordner (siehe Projektstamm).
- Ziel: Kompatibilität mit Moodle Coding Guidelines, sichere Datenverarbeitung, und rückwärtskompatible Änderungen.

2. Gewünschtes Verhalten von Copilot-Vorschlägen

- Vorschläge sollten PHP 7.4+ kompatibel sein (achte auf die in `version.php` angegebene Mindestversion).
- SQL-Abfragen müssen Prepared Statements oder Moodle DB API (`$DB`) verwenden. Keine rohe String-Konkatenation.
- Verwende Moodle-APIs (z. B. `get_string()`, `$PAGE`, `$OUTPUT`, `
coreormase`) wenn möglich.
- Vorschläge für neue Endpunkte/Features müssen Privacynotices, Capability-Checks (`has_capability()`), und Nonce/Token-Validierung enthalten, falls relevant.

3. Sicherheits- und Datenschutzregeln

- Keine Geheimnisse, Passwörter, API-Keys oder private Daten in den Code einchecken.
- Wenn Copilot sensible Daten erwähnt, entferne oder ersetze diese durch Umgebungsvariablen oder Konfigurationsschlüssel.
- Auf SQL-Injection, XSS, CSRF prüfen. Nutze `s()` / `format_text()` / `format_string()` / `clean_param()` wo nötig.
- Prüfe alle Änderungen an `privacy/` und `classes/` (Analytics/Indicator) auf DSGVO-Relevanz.

4. Code-Stil, Tests und Qualität

- Folge Moodle Coding Style (Tabs, Dokumentation mit PHPDoc, Naming-Conventions).
- Für jede substantielle Änderung bitte eine oder mehrere PHPUnit- oder PHP-Unit-ähnliche Tests hinzufügen (siehe `tests/` Ordner). Minimal: happy-path + 1 Fehler/Edgecase.
- Führe Linter/Static Analysis lokal aus (z. B. PHPCS) bevor Du Commits erstellst.

5. Commit- und PR-Hinweise

- Schreibe prägnante Commit-Messages (Kontext: Plugin/Datei und kurze Beschreibung).
- PRs sollten enthalten: Beschreibung, Migrations/DB-Änderungen (falls vorhanden), Tests und Screenshots/Logs falls UI-Änderung.
- Markiere Reviewer aus dem Projekt, und verlinke relevante Issues.

6. Beispiel-Prompts (Deutsch)

- "Schreibe eine sichere Moodle-DB-Abfrage in PHP, die alle Nutzer mit Rolle 'editingteacher' in einem Kurs zurückgibt und Prepared Statements bzw. Moodle DB API verwendet." 
- "Ergänze PHPUnit-Tests für `classes/manager.php`: füge einen Test für get_users_by_course() hinzu mit Mock-DB." 
- "Verbessere XSS-Sicherheit in `view.php`: nimm alle Echo-Ausgaben und wandle sie mit `s()` um." 

7. Prompt-Minikontrakt (Input/Output/Fehler)

- Input: Pfad der Datei/Dateien, kurze Beschreibung der Aufgabe und relevante Moodle-Version.
- Output: Patch/Code-Snippet mit minimalen Änderungen, Tests und Hinweise welche Dateien geändert wurden.
- Fehler: Copilot-Vorschlag ist nicht kompatibel, unsicher, oder verursacht Tests/Build-Fehler — abweisen und alternative Implementierung verlangen.

8. Edgecases und Prüfungen

- Leere/Null-Inputs in APIs prüfen.
- Große Datenmengen (pagination/batching) beachten.
- Berechtigungsprüfungen (Capability checks) für Admin-/Manager-Funktionen.

9. Do's und Don'ts (Kurz)

- Do: Verwende Moodle APIs, füge Tests, dokumentiere Änderungen.
- Don't: Direktes DB-String-Building, harte API-Keys, ungeprüfte Änderungen an privacy/Analytics.

10. Beispiele für kurze deutsche Prompts (Copy-Paste)

- "Refaktoriere `ecodebook/lib.php` Funktion X: Extrahiere DB-Logik in einzelne Methode, schreibe Unit-Test." 
- "Ersetze in `javascript/main.js` unsichere DOM-Manipulation durch `textContent` statt `innerHTML` und füge eine kleine Jest-ähnliche Testidee hinzu." 

11. Weiteres

- Wenn Du unsicher bist, öffne ein Issue und beschreibe die vorgeschlagene Änderung. Zu viele automatische Änderungen ohne Review verursachen Regressionsrisiken.

---

Letzte Änderung: 2025-10-13
Autor: automatisch erstellt
