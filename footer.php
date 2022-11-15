<?php

    $footer_contact = '<a href="/contact/contact.html">Kontakt</a><br>';
    $footer_copiryght = '©2022';

    function footer()
    {
        global $footer_contact, $footer_copiryght;
        echo($footer_contact);
        echo($footer_copiryght);
    }

?>