
<?php
include '../functions/isAuthenticated.php';
include '../functions/resolveUser.php';

$user = resolveUser($GLOBALS['_SESSION']['user_id']);

echo "<h1>halo " . $user['displayName'] . "</h1>"
?>