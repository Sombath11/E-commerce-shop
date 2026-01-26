<?php

    if(isset($_GET['success_message'])) {
        echo "<div style='color: green;' class='text-center fw-bold'>".$_GET['success_message']."</div>";
    }

    if(isset($_GET['error_message'])) {
        echo "<div style='color: red;' class='text-center fw-bold'>".$_GET['error_message']."</div>";
    }










?>