<?php

declare(strict_types=1);

function check_login_error() {
if(isset($_SESSION["error_login"])) {
    echo '<div class="error_container">';
    foreach ($_SESSION["error_login"] as $error) {
    echo '<p class="form_error">' . $error . '</p>';
    }
    echo '</div>';
    
      // Remove errors after displaying them
    unset($_SESSION["error_login"]);
} else if (isset($_GET["login"]) && $_GET["login"] === "success") {
    echo '<div class="success_container">';
    echo '<p class="form_success"><span class="success_icon">✅</span> Login successful!</p>';
    echo '</div>';
}

}
