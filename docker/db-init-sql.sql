-- Initialisierungs-Skript für ecodemoodle DBMS
-- Wird beim ersten Start automatisch ausgeführt

-- Character Set & Collation für Moodle
ALTER DATABASE moodle CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Zusätzliche DB-User (optional)
-- CREATE USER 'readonly'@'%' IDENTIFIED BY 'readonly123';
-- GRANT SELECT ON moodle.* TO 'readonly'@'%';

-- Testdaten werden später über Moodle-CLI angelegt
-- (nach Plugin-Installation)
