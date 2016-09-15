#Tool zum Verwalten von Nischenseiten/Webprojekten

Mit diesem Tool lassen sich Onlineprojekte (Contentportale, Nischenseiten, ...) effizienter verwalten. Zum einen beinhaltet die Webapp ein Projektmanagement-Modul (Notizen, Contentplanung, Konkurrenz, Backlinks, Rankings) sowie ein Ideen-Modul (zum Sammeln und Archivieren von potentiell interessanten neuen/kommenden Nischenseiten). 

Das Tool wurde auf Basis des PHP Frameworks <a href="https://github.com/laravel/laravel">Laravel 5.3</a> programmiert. Für den Backlinkchecker sowie für den Zugriff auf die <a href="">API von metrics.tools</a> wird des Weiteren <a href="https://github.com/guzzle/guzzle">Guzzle</a> verwendet.

#Anforderungen

1. Webspace mit min. PHP 5.6.4 (programmiert wurde auf Basis von PHP 7.1)
2. Eine MySQL Datenbank
3. wer die Funktionen, wie auto. oder manuelle Keyword-Aktualisierung, Rankingimport, Searchindex nutzen will, braucht einen Pro-Account von api.metrics. 
4. Möglichkeit Cronjobs auszuführen

#
#Installation des Tools
Zur Installation kann man einen der beiden Wege wählen - der erste Weg richtet sich an alljene, die mit Laravel, Composer und Co. vertraut sind