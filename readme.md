#Tool zum Verwalten von Nischenseiten/Webprojekten

Mit diesem Tool lassen sich Onlineprojekte (Contentportale, Nischenseiten, ...) effizienter verwalten. Zum einen beinhaltet die Webapp ein Projektmanagement-Modul (Notizen, Contentplanung, Konkurrenz, Backlinks, Rankings) sowie ein Ideen-Modul (zum Sammeln und Archivieren von potentiell interessanten neuen/kommenden Nischenseiten). 

Das Tool wurde auf Basis des PHP Frameworks <a href="https://github.com/laravel/laravel">Laravel 5.3</a> programmiert. Für den Backlinkchecker sowie für den Zugriff auf die <a href="https://metrics.tools/x/hufe">API von metrics.tools</a> wird des Weiteren <a href="https://github.com/guzzle/guzzle">Guzzle</a> verwendet.

#Anforderungen

1. Webspace mit min. PHP 5.6.4 (programmiert wurde auf Basis von PHP 7.1)
2. Eine MySQL Datenbank
3. wer die Funktionen, wie auto. oder manuelle Keyword-Aktualisierung, Rankingimport, Searchindex nutzen will, braucht einen Pro-Account von api.metrics. 
4. Möglichkeit Cronjobs auszuführen

#
#Installation des Tools
Zur Installation kann man einen der beiden Wege wählen - der erste Weg richtet sich an all jene, die mit Laravel, Composer und Co. vertraut sind. Der zweite Weg ist eher für Laien geeignet.

## via GIT und Composer
1. per GIT holt man sich das Paket: git clone https://github.com/Damian89/nischenseiten-verwaltung
2. per Composer installiert man alle Abhängigkeiten: composer install
3. es folgt das Anpassen der ".env.example", diese bitte in ".env" umbenennen und so etwas, wie URL und Zugangsdaten für die MySQL-DB eintragen
4. zur Sicherheit bitte ausführen: php artisan key:generate (nicht zwingend notwendig, wäre aber sicherer)
4. per Artisan importiert man die Datenbank: php artisan migrate && php artisan db:seed
5. wichtig ist, dass ihr eurem Server sagt, dass er auf "public/index.php" zeigen MUSS, dort ist eine passende .htaccess bereits hinterlegt. Nutzer von NGINX, passen bitte folgendes an: 
```
root /var/www/pfad.zu.den.dateien/public;

location / {
    try_files $uri $uri/ /index.php$is_args$args;
}
```