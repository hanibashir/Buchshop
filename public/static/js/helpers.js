

$(document).ready(function () {
    // das Login-Modal Anzeigen
    $("#loginLink").click(function () {
        $("#loginModal").modal('show');
    });

    // toggle Rechnungsadresse
    $('#check_bill_address').change(function() {
        $('#bill_address').toggle(this.checked);
    });

});



