<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Oberste Zeile mit Slogan und Nutzer-Links -->
        <div class="navbar-header w-100 d-flex justify-content-between align-items-center">
            <div class="navbar-text text-light flex-grow-1">
                Wosny.net – Ihr Spezialist für Bücher und mehr!
            </div>
            <div class="navbar-nav">
                <a class="nav-link text-light" href="#">Ihr Konto</a>
                <a class="nav-link text-light" href="#">Newsletter</a>
                <a class="nav-link text-light" href="#">Hilfe</a>
                <a class="nav-link text-warning" href="#" data-toggle="modal" data-target="#loginModal">Anmelden</a>
                <a class="nav-link text-warning" href="#" data-toggle="modal" data-target="#registerModal">Konto anlegen</a>
            </div>
        </div>
        <!-- include login form -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/auth/_anmeldefenster.php"; ?>
        <?php include $_SERVER['DOCUMENT_ROOT'] . "/templates/auth/_registerfenster.php"; ?>

</nav>