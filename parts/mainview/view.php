<!-- Bilder Wrapper -->
<?php include "_bilderwrapper.php"; ?>
<!--WERBEBANNER-->
<?php include "_werbebanner.php"; ?>
<!--Buch-Neuheiten-->
<div>
    <?php include "_buchneuheiten.php"; ?>
    <!--Das Buch - ein Jahrhundert Bestseller-->
    <?php include "_topbestellte.php"; ?>



    <?php include "_pagination.php"; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Skript für das Anzeigen des Login-Modals -->
    <script>
        $(document).ready(function(){
            $("#loginLink").click(function(){
                $("#loginModal").modal('show');
            });
        });
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</div>
