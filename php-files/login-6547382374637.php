<?php 
    // for admin purposes.
    session_start();
    $_SESSION["dontcount"] = 'true';
    header('Location: /');
?>
