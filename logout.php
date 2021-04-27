<?php
// Initialize the session.
session_start();
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
    }
}
// Unset all of the session variables.
session_unset();
// Finally, destroy the session.    
session_destroy();
// Include URL for Login page to login again.
header("Location: index.php");
exit;
?>