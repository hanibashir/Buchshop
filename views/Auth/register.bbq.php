{% extends "base.bbq.php" %}

{% block title %}Register{% endblock %}
{% block body %}

<form action="/register/create" method="post">
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
                                                       name="first_name" value="{{ input['first_name'] }}">
                                            </div>
                                            {% if (isset($errors) && isset($errors["first_name"])): %}
                                            <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                                <small>{{ errors["first_name"] }}</small>
                                                <br>
                                            </div>
                                            {% endif; %}

                                        </div>

                                        <div class="col-md-6 mb-2 pb-2">

                                            <div class="form-outline">
                                                <label class="form-label" for="last_name">Nachname</label>
                                                <input type="text" class="form-control" id="last_name"
                                                       name="last_name" value="{{ input['last_name'] }}">
                                            </div>
                                            {% if (isset($errors) && isset($errors["last_name"])): %}
                                            <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                                <small>{{ errors["last_name"] }}</small>
                                                <br>
                                            </div>
                                            {% endif; %}

                                        </div>
                                    </div> <!-- //Vor- und Nachname row-->
                                    <!-- E-Mail -->
                                    <div class="mb-2 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="email">E-Mail</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                   value="{{ input['email'] }}">
                                        </div>
                                        {% if (isset($errors) && isset($errors["email"])): %}
                                        <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                            <small>{{ errors["email"] }}</small>
                                            <br>
                                        </div>
                                        {% endif; %}
                                    </div><!-- //E-Mail -->

                                    <!-- Passwort -->
                                    <div class="mb-2 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="password">Passwort</label>
                                            <input type="password" class="form-control" id="password" name="password">
                                        </div>
                                        {% if (isset($errors) && isset($errors["password"])): %}
                                        <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                            <small>{{ errors["password"] }}</small>
                                            <br>
                                        </div>
                                        {% endif; %}
                                    </div><!-- //Passwort -->

                                    <!-- Passwort Bestätigung -->
                                    <div class="mb-2 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="confirm_password">Passwort
                                                Wiederholen</label>
                                            <input type="password" class="form-control" id="confirm_password"
                                                   name="confirm_password">
                                        </div>
                                        {% if (isset($errors) && isset($errors["confirm_password"])): %}
                                        <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                            <small>{{ errors["confirm_password"] }}</small>
                                            <br>
                                        </div>
                                        {% endif; %}
                                    </div><!-- //Passwort Bestätigung -->
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="px-5 py-2">
                                    <h4 class="fw-normal mt-3 mb-4">Lieferadresse</h4>
                                    <!-- Straße und Haus Nr. -->
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="form-outline">
                                                    <label class="form-label" for="street">Straße</label>
                                                    <input type="text" id="street" name="street"
                                                           class="form-control" value="{{ input['street'] }}"/>
                                                </div>
                                            </div>
                                            {% if (isset($errors) && isset($errors["street"])): %}
                                            <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                                <small>{{ errors["street"] }}</small>
                                                <br>
                                            </div>
                                            {% endif; %}
                                            <div class="col-3">
                                                <label for="house_no">Hausnummer</label>
                                                <input type="text" id="house_no" name="house_no"
                                                       class="form-control" value="{{ input['house_no'] }}"/>
                                            </div>
                                            {% if (isset($errors) && isset($errors["house_no"])): %}
                                            <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                                <small>{{ errors["house_no"] }}</small>
                                                <br>
                                            </div>
                                            {% endif; %}
                                        </div>
                                    </div><!-- //Straße und Haus Nr. -->

                                    <!-- PLZ und Stadt-->
                                    <div class="row">
                                        <div class="col-md-5 mb-2 pb-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="post_code">PLZ</label>
                                                <input type="number" id="post_code" name="post_code"
                                                       class="form-control" value="{{ input['post_code'] }}"/>
                                            </div>
                                            {% if (isset($errors) && isset($errors["post_code"])): %}
                                            <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                                <small>{{ errors["post_code"] }}</small>
                                                <br>
                                            </div>
                                            {% endif; %}
                                        </div>
                                        <div class="col-md-7 mb-2 pb-2">
                                            <div class="form-outline">
                                                <label class="form-label" for="city">Stadt</label>
                                                <input type="text" id="city" name="city" class="form-control"
                                                       value="{{ input['city'] }}"/>
                                            </div>
                                            {% if (isset($errors) && isset($errors["city"])): %}
                                            <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                                <small>{{ errors["city"] }}</small>
                                                <br>
                                            </div>
                                            {% endif; %}
                                        </div>
                                    </div> <!-- //PLZ und Stadt-->

                                    <!-- Telefon- oder Handynummer -->
                                    <div class="mb-2 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="phone">Telefon- oder Handynummer</label>
                                            <input type="tel" id="phone" name="phone" class="form-control"
                                                   value="{{ input['phone'] }}"/>
                                        </div>
                                    </div><!-- //Telefon- oder Handynummer -->

                                    <!-- Rechnungsadresse Checkbox -->
                                    <div class="form-check d-flex justify-content-start mb-2 pb-3">
                                        <label class="form-check-label" for="check_bill_address">
                                            Abweichende Rechnungsadresse?
                                        </label>

                                        <input class="form-check-input me-3" type="checkbox"
                                               id="check_bill_address" name="check_bill_address"/>
                                    </div><!-- //Rechnungsadresse Checkbox -->
                                    <!-- Rechnungsadresse -->
                                    <div id="bill_address" style="display:none">
                                        <h4 class="fw-normal  mt-3 mb-4">Rechnungsadresse</h4>
                                        <!-- Straße und Haus Nr. -->
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="form-outline">
                                                    <label class="form-label" for="bill_street">Straße</label>
                                                    <input type="text" id="bill_street" name="bill_street"
                                                           class="form-control" value="{{ input['bill_street'] }}"/>
                                                </div>
                                            </div>
                                            {% if (isset($errors) && isset($errors["bill_street"])): %}
                                            <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                                <small>{{ errors["bill_street"] }}</small>
                                                <br>
                                            </div>
                                            {% endif; %}
                                            <div class="col-3">
                                                <label for="bill_house_no">Hausnummer</label>
                                                <input type="text" id="bill_house_no" name="bill_house_no"
                                                       class="form-control" value="{{ input['bill_house_no'] }}"/>
                                            </div>
                                            {% if (isset($errors) && isset($errors["bill_house_no"])): %}
                                            <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                                <small>{{ errors["bill_house_no"] }}</small>
                                                <br>
                                            </div>
                                            {% endif; %}
                                        </div><!-- //Straße und Haus Nr. -->

                                        <!-- PLZ und Stadt-->
                                        <div class="row">
                                            <div class="col-md-5 mb-2 pb-2">
                                                <div class="form-outline">
                                                    <label class="form-label" for="bill_post_code">PLZ</label>
                                                    <input type="number" id="bill_post_code" name="bill_post_code"
                                                           class="form-control" value="{{ input['bill_post_code'] }}"/>
                                                </div>
                                                {% if (isset($errors) && isset($errors["bill_post_code"])): %}
                                                <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                                    <small>{{ errors["bill_post_code"] }}</small>
                                                    <br>
                                                </div>
                                                {% endif; %}
                                            </div>
                                            <div class="col-md-7 mb-2 pb-2">
                                                <div class="form-outline">
                                                    <label class="form-label" for="bill_city">Stadt</label>
                                                    <input type="text" id="bill_city" name="bill_city"
                                                           class="form-control" value="{{ input['bill_city'] }}"/>
                                                </div>
                                                {% if (isset($errors) && isset($errors["bill_city"])): %}
                                                <div style="color: red; margin-top: 10px; margin-bottom: 10px">
                                                    <small>{{ errors["bill_city"] }}</small>
                                                    <br>
                                                </div>
                                                {% endif; %}
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