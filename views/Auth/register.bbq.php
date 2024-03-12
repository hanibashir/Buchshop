{% extends "base.bbq.php" %}

{% extends "base.bbq.php" %}
{% block title %}Register{% endblock %}
{% block body %}
<!--
            CREATE TABLE `kunden` (
              `kunden_id` int(11) NOT NULL,
              `kd_vorname` varchar(255) DEFAULT NULL,
              `kd_nachname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
              `email` varchar(255) DEFAULT NULL,
              `telefonnummer` varchar(20) DEFAULT NULL,
              `typ_id` int(11) DEFAULT NULL,
              `konto_id` int(11) DEFAULT NULL
            )

            CREATE TABLE `typen_konten` (
              `typ_id` int(11) NOT NULL,
              `typ_name` varchar(100) NOT NULL
            )
            CREATE TABLE `lieferadressen`(
              `lieferadressen_id` int(11) NOT NULL,
              `kunden_id` int(11) DEFAULT NULL,
              `straße` varchar(255) DEFAULT NULL,
              `hausnr` int(11) NOT NULL,
              `adresszeile` varchar(255) DEFAULT NULL,
              `stadt` varchar(100) DEFAULT NULL,
              `postleitzahl` varchar(20) DEFAULT NULL,
              `land` varchar(100) DEFAULT NULL
            )
            CREATE TABLE `rechnung_adressen`(
              `rechnungsadressen_id` int(11) NOT NULL,
              `kunden_id` int(11) DEFAULT NULL,
              `straße` varchar(255) DEFAULT NULL,
              `hausnr` int(11) NOT NULL,
              `adresszeile` varchar(255) DEFAULT NULL,
              `stadt` varchar(100) DEFAULT NULL,
              `postleitzahl` varchar(20) DEFAULT NULL,
              `land` varchar(100) DEFAULT NULL
            )
        -->
<form action="/register" method="post">
    <div class="container my-3 py-2 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="px-5 py-2">
                                    <h4 class="fw-normal mt-3 mb-4">Konto</h4>
                                    <!-- Kunden Typ-->

                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <h6 class="fw-normal mb-4">Kontotyp</h6>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <input type="radio" id="customerType" name="userType" value="customer"
                                                   checked>
                                            <label for="customerType" class="mr-2">Kunde</label>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <input type="radio" id="businessType" name="userType" value="business">
                                            <label for="businessType">Unternehmen</label>
                                        </div>
                                    </div><!-- //Kunden Typ-->

                                    <!-- Vor- und Nachname row-->
                                    <div class="row">
                                        <div class="col-md-6 mb-2 pb-2">

                                            <div class="form-outline">
                                                <label class="form-label" for="first_name">Vorname</label>
                                                <input type="text" class="form-control" id="first_name"
                                                       name="first_name">
                                            </div>

                                        </div>
                                        <div class="col-md-6 mb-2 pb-2">

                                            <div class="form-outline">
                                                <label class="form-label" for="last_name">Nachname</label>
                                                <input type="text" class="form-control" id="last_name"
                                                       name="last_name">
                                            </div>

                                        </div>
                                    </div> <!-- //Vor- und Nachname row-->
                                    <!-- E-Mail -->
                                    <div class="mb-2 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="email">E-Mail</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                    </div><!-- //E-Mail -->

                                    <!-- Passwort -->
                                    <div class="mb-2 pb-2">
                                        <label class="form-label" for="password">Passwort</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div><!-- //Passwort -->
                                    <!-- Passwort Bestätigung -->
                                    <div class="form-group">
                                        <label class="form-label" for="confirm_password">Passwort Wiederholen</label>
                                        <input type="password" class="form-control" id="confirm_password"
                                               name="confirm_password">
                                    </div><!-- //Passwort Bestätigung -->

                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="px-5 py-2">
                                    <h4 class="fw-normal mt-3 mb-4">Lieferadresse</h4>
                                    <!-- Straße und Haus Nr. -->
                                    <div class="mb-2 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="street_house_no">Straße und Haus Nr.</label>
                                            <input type="text" id="street_house_no" name="street_house_no"
                                                   class="form-control"/>
                                        </div>
                                    </div><!-- //Straße und Haus Nr. -->

                                    <!-- PLZ und Stadt-->
                                    <div class="row">
                                        <div class="col-md-5 mb-2 pb-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="post_code">PLZ</label>
                                                <input type="number" id="post_code" name="post_code"
                                                       class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-7 mb-2 pb-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="city">Stadt</label>
                                                <input type="text" id="city" name="city" class="form-control"/>
                                            </div>
                                        </div>
                                    </div> <!-- //PLZ und Stadt-->

                                    <!-- Telefon- oder Handynummer -->
                                    <div class="mb-2 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="phone">Telefon- oder Handynummer</label>
                                            <input type="tel" id="phone" name="phone" class="form-control"/>
                                        </div>
                                    </div><!-- //Telefon- oder Handynummer -->

                                    <!-- Rechnungsadresse Checkbox -->
                                    <div class="form-check d-flex justify-content-start mb-2 pb-3">
                                        <label class="form-check-label" for="check_bill_address">
                                            Abweichende Rechnungsadresse?
                                        </label>
                                        <input class="form-check-input me-3" type="checkbox" value="0"
                                               id="check_bill_address" name="check_bill_address"/>
                                    </div><!-- //Rechnungsadresse Checkbox -->
                                    <!-- Rechnungsadresse -->
                                    <div id="bill_address" style="display:none">
                                        <h4 class="fw-normal  mt-3 mb-4">Rechnungsadresse</h4>
                                        <!-- Straße und Haus Nr. -->
                                        <div class="mb-2 pb-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="bill_street_house_no">Straße und Haus
                                                    Nr.</label>
                                                <input type="text" id="bill_street_house_no" name="bill_street_house_no"
                                                       class="form-control"/>
                                            </div>
                                        </div><!-- //Straße und Haus Nr. -->

                                        <!-- PLZ und Stadt-->
                                        <div class="row">
                                            <div class="col-md-5 mb-2 pb-2">
                                                <div class="form-outline">
                                                    <label class="form-label" for="bill_post_code">PLZ</label>
                                                    <input type="number" id="bill_post_code" name="bill_post_code"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                            <div class="col-md-7 mb-2 pb-2">
                                                <div class="form-outline">
                                                    <label class="form-label" for="bill_city">Stadt</label>
                                                    <input type="text" id="bill_city" name="bill_city"
                                                           class="form-control"/>
                                                </div>
                                            </div>
                                        </div> <!-- //PLZ und Stadt-->
                                    </div><!-- //Rechnungsadresse -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Terms_and Conditions -->
                    <div class="d-flex justify-content-center">
                        <div class="form-check d-flex justify-content-start mb-2 pb-3">
                            <input class="form-check-input me-3" type="checkbox" checked value=""
                                   id="terms_and_conditions"/>
                            <label class="form-check-label" for="terms_and_conditions">
                                I do accept the <a href="#!"><u>Terms and Conditions</u></a>
                                of your
                                site.
                            </label>
                        </div><!-- //Terms_and Conditions -->
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-warning">Register</button>
                    </div><!-- //Submit Button -->

                    <!-- Card Footer -->
                    <div class="card-footer bg-dark text-center p-3">
                        <span class="text-white">Bereits Kunde?</span>
                        <a href="/login" type="button" class="text-decoration-none">Anmelden</a>
                    </div><!-- //Card Footer -->
                </div>
            </div>
        </div>
    </div>
</form>

{% endblock %}