<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="loginModalLabel">Anmelden</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Schließen">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-dark text-white">
                <form>
                    <!-- Kunde Type -->
                    <div class="mb-3">
                        <input type="radio" id="customerType" name="userType" value="customer" checked>
                        <label for="customerType" class="mr-2">Kunde</label>
                        <input type="radio" id="businessType" name="userType" value="business">
                        <label for="businessType">Unternehmen</label>
                    </div>
                    <!-- Kunde E-Mail -->
                    <div class="form-group">
                        <label for="emailInput">E-Mail</label>
                        <input type="email" class="form-control" id="emailInput" placeholder="E-Mail eingeben">
                    </div>
                    <!-- Kunde Password -->
                    <div class="form-group">
                        <label for="passwordInput">Passwort</label>
                        <input type="password" class="form-control" id="passwordInput" placeholder="Passwort">
                    </div>
                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-warning btn-block">Anmelden</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-dark">
                <span class="text-white">Ich möchte ein Konto anlegen</span>
                <button type="button" class="btn btn-outline-light">
                    <a class="nav-link text-warning" href="#" data-toggle="modal" data-target="#registerModal">Konto
                        anlegen</a>

                </button>
            </div>
        </div>
    </div>
</div>