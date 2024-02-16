<!--
CREATE TABLE `kunden` (
  `kunden_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `kd_vorname` varchar(255) DEFAULT NULL,
  `kd_nachname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefonnummer` varchar(20) DEFAULT NULL,
  `typ_id` int(11) DEFAULT NULL,
  `konto_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
-->

<div id="registerModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="registerModal"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="registerModal">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-dark text-white">
                <form>
                    <!-- Kunde Type -->
                    <div class="mb-3">
                        <input type="radio" id="customerType" name="kundeType" value="customer" checked>
                        <label for="customerType" class="mr-2">Kunde</label>
                        <input type="radio" id="businessType" name="userType" value="business">
                        <label for="businessType">Unternehmen</label>
                    </div>
                    <!-- Kunde Vorname -->
                    <div class="form-group">
                        <label for="vornameInput">Vorname</label>
                        <input type="text" class="form-control" id="vornameInput" placeholder="Vorname eingeben"
                               required>
                    </div>
                    <!-- Kunde Nachname -->
                    <div class="form-group">
                        <label for="nachnameInput">Nachname</label>
                        <input type="text" class="form-control" id="nachnameInput" placeholder="Nachname eingeben"
                               required>
                    </div>
                    <!-- Kunde E-Mail -->
                    <div class="form-group">
                        <label for="emailInput">E-Mail</label>
                        <input type="email" class="form-control" id="emailInput" placeholder="E-Mail eingeben" required>
                    </div>
                    <!-- Kunde Telefonnummer -->
                    <div class="form-group">
                        <label for="telefonnummerInput">Telefonnummer</label>
                        <input type="tel" class="form-control" id="telefonnummerInput"
                               placeholder="Telefonnummer eingeben" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
                    </div>

                    <!-- Kunde Password -->
                    <div class="form-group">
                        <label for="passwordInput">Passwort</label>
                        <input type="password" class="form-control" id="passwordInput" placeholder="Passwort">
                    </div>
                    <!-- Kunde Password Confirmation -->
                    <div class="form-group">
                        <label for="passwordConfirmInput">Passwort</label>
                        <input type="password" class="form-control" id="passwordConfirmInput"
                               placeholder="Passwort Bestätigen">
                    </div>
                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-warning btn-block">Register</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-dark">
                <span class="text-white">Bereits Kunde?</span>
                <button type="button" class="btn btn-outline-light">
                    <a class="nav-link text-warning" href="#" data-toggle="modal" data-target="#loginModal">Anmelden</a>

                </button>
            </div>
        </div>
    </div>
</div>
