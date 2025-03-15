<?php

declare(strict_types=1);

function check_signup_errors() {
if (isset($_SESSION["error_signup"])) {
    echo '<div class="error_container">';
    foreach ($_SESSION["error_signup"] as $error) {
    echo '<p class="form_error">' . $error . '</p>';
    }
    echo '</div>';
    
      // Remove errors after displaying them
    unset($_SESSION["error_signup"]);
} else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
    echo '<div class="success_container">';
    echo '<p class="form_success"><span class="success_icon">✅</span> Signup successful!</p>';
    echo '</div>';
}

}