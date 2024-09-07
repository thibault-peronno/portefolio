<?php
// bootstrap.php

// Initialisation de la session
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.save_path', __DIR__ . '/app/temp');
    ini_set('session.gc_maxlifetime', 3600); // Durée de vie maximale de la session en secondes
    session_set_cookie_params(3600);
    session_start();
}