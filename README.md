
# Buchshop | Umschulungsprojekt

### Beschreibung:
Buchhandlung-Projekt ist eine webbasierte Anwendung, die es ermöglicht, Bücher zu verwalten, zu durchsuchen und zu bestellen.

### Funktionen
- Verwaltung von Büchern und Kategorien
- Durchsuchen des Buchbestands
- Platzieren von Bestellungen
- Benutzerverwaltung

#### Directories and Files:

-  `buchshop` - Main Directory.

    -  `logic` - contains app logic.
        -  `auth` - contains users authentication files.
           * `login.php` - login code file.
           * `register.php` - register code file.
           
       -  `models` - contains db entities representation.
           *  `Kunde.php` - login code file.
    
       -  `config.php` - app configuration (getConfig() function).
       -  `init.php` - 
       -  `router.php` - app routes (getRoute() function).

    -  `static` - Holds all static files.
        - `css` - Holds all static css files.
        -  `img` - Holds all static images and icons.
            -  `kunde` - Holds all posts images.
            -  `unternehmen` - Holds all company account images.
            -  `buecher` - Holds all books images.
            -  `banner` - Holds all banner images.
            -  `logo` - Holds all website logos and icons.
            -  `default_img` - Holds all books images.
               - `user-blue-thumbnail.png` - user default image.
        - `js` - Holds all js files.

    -  `templates` - Holds all html files.
        -  `auth` - authentication html files.
        -  `components` - general html components.
        -  `main_view` - main pages (e.g. home, categories etc...).
        -  `single_view` - single pages (e.g. article, about us etc...).
        -  `footer.php` - the main website footer html file.
        -  `header.php` - the main website header html file.

    
