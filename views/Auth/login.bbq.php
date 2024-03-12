{% extends "base.bbq.php" %}

{% extends "base.bbq.php" %}
{% block title %}Register{% endblock %}
{% block body %}

<form action="/login" method="post">
    <div class="container py-5 w-50">
        <div class="row d-flex justify-content-center align-items-center h-50">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-header text-center">
                        <h3 class="fw-normal mb-2 mt-2">Anmelden</h3>
                    </div>
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <!-- Kunden Typ-->

                                    <div class="row">
                                        <div class="col-md-3 mb-4 pb-2">
                                            <h6 class="fw-normal mb-5">Kontotyp</h6>
                                        </div>
                                        <div class="col-md-4 mb-4 pb-2">
                                            <input type="radio" id="customerType" name="userType" value="customer"
                                                   checked>
                                            <label for="customerType" class="mr-2">Kunde</label>
                                        </div>
                                        <div class="col-md-4 mb-4 pb-2">
                                            <input type="radio" id="businessType" name="userType" value="business">
                                            <label for="businessType">Unternehmen</label>
                                        </div>
                                    </div><!-- //Kunden Typ-->

                                    <!-- E-Mail -->
                                    <div class="mb-4 pb-2">
                                        <div class="form-outline">
                                            <label class="form-label" for="email">E-Mail</label>
                                            <input type="email" class="form-control" id="email" name="email">
                                        </div>
                                    </div><!-- //E-Mail -->

                                    <!-- Passwort -->
                                    <div class="mb-4 pb-2">
                                        <label class="form-label" for="password">Passwort</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div><!-- //Passwort -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center mb-3">
                        <button type="submit" class="btn btn-warning">Anmelden</button>
                    </div><!-- //Submit Button -->

                    <!-- Card Footer -->
                    <div class="card-footer bg-dark text-center p-3">
                        <span class="text-white">Ich möchte ein</span>
                        <a href="/register" type="button" class="text-decoration-none">Konto anlegen</a>
                    </div><!-- //Card Footer -->
                </div>
            </div>
        </div>
    </div>
</form>


{% endblock %}