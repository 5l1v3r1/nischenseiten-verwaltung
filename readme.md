# Tool zum Verwalten von Nischenseiten/Webprojekten

Mit diesem Tool lassen sich Onlineprojekte (**Contentportale, Nischenseiten, ...**) effizienter verwalten. Zum einen beinhaltet die Webapp ein *Projektmanagement-Modul* (Notizen, Contentplanung, Konkurrenz, Backlinks, Rankings) sowie ein *Ideen-Modul* (zum Sammeln und Archivieren von potentiell interessanten neuen/kommenden Nischenseiten). 

Das Tool wurde auf Basis des PHP Frameworks <a href="https://github.com/laravel/laravel">Laravel 5.3</a> programmiert. Für den Backlinkchecker sowie für den Zugriff auf die <a href="https://metrics.tools/x/hufe">**API von metrics.tools**</a> wird des Weiteren <a href="https://github.com/guzzle/guzzle">Guzzle</a> verwendet.

# Anforderungen

1. Webspace mit min. **PHP 5.6.4** (programmiert wurde auf Basis von PHP 7.1)
2. Eine **MySQL** Datenbank
3. (optional) wer die Funktionen, wie auto. oder manuelle Keyword-Aktualisierung, Rankingimport, Searchindex nutzen will, braucht einen **<a href="https://metrics.tools/x/hufe">Pro-Account von api.metrics</a>**. 
4. (optional) Möglichkeit **Cronjobs** auszuführen


# Installation des Tools
Zur Installation kann man einen der beiden Wege wählen - der erste Weg richtet sich an all jene, die mit Laravel, Composer und Co. vertraut sind. Der zweite Weg ist eher für Laien geeignet.

## via GIT und Composer
1. per GIT holt man sich das Paket: git clone https://github.com/Damian89/nischenseiten-verwaltung
2. per Composer installiert man alle Abhängigkeiten: composer install
3. es folgt das Anpassen der ".env.example", diese bitte in ".env" umbenennen und so etwas, wie URL und Zugangsdaten für die MySQL-DB eintragen
4. zur Sicherheit bitte ausführen: php artisan key:generate (nicht zwingend notwendig, wäre aber sicherer)
4. per Artisan importiert man die Datenbank: php artisan migrate && php artisan db:seed
5. Die Ordner /storage und /bootstrap/cache müsste auch chmod 777 stehen


## via Dump und zip-Datei
1. Lade das fertige Paket HIER (Link folgt) herunter und entpacke es auf deinem Webspace
2. Importier die install/sqldump.sql in deine Datenbank
3. pass die ".env"-Datei an und speichere sie ab
4. Die Ordner /storage und /bootstrap/cache müsste auch chmod 777 stehen

## Servereinstellungen
Laravel hat im Ordner /public, eine index.php, über die alle Anfragen laufen (vergleichbar mit WordPress), entsprechend muss man:
1. einstellen, dass der Webspace bzw. die Domain/Subdomain auf den Ordner /public zeigt
2. für Nutzer von Apache2 ist dort bereits eine .htaccess angelegt
3. Nginx-Nutzer müssen die entsprechende Hosts-Datei anpassen, meist reichen zwei Stellen:

```
root /var/www/pfad.zu.den.dateien/public;

location / {
    try_files $uri $uri/ /index.php$is_args$args;
}
```

# Logindaten
In beiden Fällen kann man sich dann als Administrator mit den folgenden Daten einloggen:

**Nutzername:** test@test.de

**Passwort:** test

Es lohnt sich diese Daten abzuändern.

# Erste Einstellungen
Es empfiehlt sich die einzelnen Punkte in der Navigation "Einstellungen" durchzugehen:
1. Kategorien anlegen
2. Partnerprogramme anlegen
3. Aktuelle Projekte, sofern vorhanden, anlegen
4. Allgemeine Einstellungen (API, Timings,...) vornehmen

# Cronjobs einrichten
Das ist vor allem für jeden wichtig, der das Projektmanagement-Modul nutzt und dort für sein Projekt z.B. Backlinks eingetragen hat. Das Tool hat einen Backlinkchecker, der jeden Link alle X Tage prüft (ist der Backlink noch gesetzt?). Wer einen API Key hinterlegt hat, kann die Informationen "Suchvolumen", "CPC", "Konkurrenz" für angelegte Ideen sowie Keywords innerhalb von Projekten aktualisieren lassen. Des Weiteren erlaubt die API in regelmäßigen Abständen zum einen aktuelle Rankings sowie den Suchindex zu importieren. Das kann man zum einen automatisch via Cronjobs erreichen und zum anderen manuell (entsprechende Buttons findet man im Tool).

Folgende Cronjobs sehen zur Verfügung und man muss nur zusehen, dass man sie regelmäßig abrufen lässt:
- http://tool.deineseite.de/cronjob/backlinks - ich empfehle da z.B. nachts jede 5 Minuten das Script starten zu lassen, es prüft in den Standardeinstellungen 20 Backlinks pro Aufruf
- http://tool.deineseite.de/cronjob/keywords - hier werden die Projektkeywords (SV,CPC,Competition) aktualisiert, ich empfehle das Script dafür ebenfalls z.B. alle 5 Minuten Nachts laufen zu lassen - Standardmäßig werden pro Aufruf 30 Keywords aktualisiert
- http://tool.deineseite.de/cronjob/idea - hier wird das Hauptkeyword pro Idee (SV,CPC,Competition) aktualisiert, ich empfehle das Script dafür ebenfalls z.B. alle 5 Minuten Nachts laufen zu lassen - Standardmäßig werden pro Aufruf 30 Keywords aktualisiert
- http://tool.deineseite.de/cronjob/rankings - der Cronjob aktualisiert für jedes Projekt die Rankings via API. Es werden die Top 100 Rankings nach Traffic importiert. Die Daten werden seitens api.metrics nur 1x pro Woche aktualisiert, d.h. ich empfehle hier das Script ein Mal pro Woche z.B. am Sonntag abend laufen zu lassen
- http://tool.deineseite.de/cronjob/searchindex - der Cronjob aktualisiert für jedes Projekt den Suchindex (grafische Darstellung) via API. Die Daten werden seitens api.metrics nur 1x pro Woche aktualisiert, d.h. ich empfehle hier das Script ein Mal pro Woche z.B. am Sonntag abend laufen zu lassen

Interessant: Der **<a href="https://metrics.tools/x/hufe">Pro-Account von api.metrics</a>** hat 50.000 Credits. Die Aktualisierung eines Keywords (CPC, SV, Comp.) kostet 5 Credits. Import von 100 Rankings kostet 100 Credits und der Import des Suchindex kostet 10 Credits. D.h. selbst wer 1000 Ideen/Keywords hat, der wird kaum über 10.000 Credits kommen. Im Webtool wird dir außerdem ständig angezeigt, wie viele Credits zu noch hast!