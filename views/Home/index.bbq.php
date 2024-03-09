{% extends "base.bbq.php" %}

<!--{% block title %}Home{% endblock %}-->
{% block body %}

<!-- Images Slider -->
{% include "Components/bilder_wrapper.bbq.php" %}
<!--WERBEBANNER-->
{% include "Components/werbe_banner.bbq.php" %}

<!--Buch-Neuheiten-->
{% include "Components/buch_neuheiten.bbq.php" %}

{% endblock %}
