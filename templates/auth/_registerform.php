<div class="container col-lg-6 offset-lg-3" style="margin: auto; width: 50%;">
    <form>
        <!-- Kunde Type -->
        <div class="mb-3 mt-5 text-center">
            <input type="radio" id="customerType" name="kundeType" value="customer" checked>
            <label for="customerType" class="mr-2 form-label">Kunde</label>
            <input type="radio" id="businessType" name="userType" value="business">
            <label for="businessType" class="form-label">Unternehmen</label>
        </div>
        <!-- Kunde Vorname -->
        <div class="form-group">
            <label for="vornameInput" class="form-label">Vorname</label>
            <input type="text" class="form-control" id="vornameInput" placeholder="Vorname eingeben"
                   required>
        </div>
        <!-- Kunde Nachname -->
        <div class="form-group">
            <label for="nachnameInput" class="form-label">Nachname</label>
            <input type="text" class="form-control" id="nachnameInput" placeholder="Nachname eingeben"
                   required>
        </div>
        <!-- Kunde E-Mail -->
        <div class="form-group">
            <label for="emailInput" class="form-label">E-Mail</label>
            <input type="email" class="form-control" id="emailInput" placeholder="E-Mail eingeben" required>
        </div>
        <!-- Kunde Telefonnummer -->
        <div class="form-group">
            <label for="telefonnummerInput" class="form-label">Telefonnummer</label>
            <input type="tel" class="form-control" id="telefonnummerInput"
                   placeholder="Telefonnummer eingeben" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>
        </div>

        <!-- Kunde Password -->
        <div class="form-group">
            <label for="passwordInput" class="form-label">Passwort</label>
            <input type="password" class="form-control" id="passwordInput" placeholder="Passwort">
        </div>
        <!-- Kunde Password Confirmation -->
        <div class="form-group">
            <label for="passwordConfirmInput" class="form-label">Passwort</label>
            <input type="password" class="form-control" id="passwordConfirmInput"
                   placeholder="Passwort Bestätigen">
        </div>
        <div class="mt-3 mb-5 text-center">
            <button type="submit" class="btn btn-warning btn-block">Register</button>
        </div>
    </form>
</div>