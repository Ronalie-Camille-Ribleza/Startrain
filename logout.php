<?php
session_start();
session_destroy();
echo "Session destroyed";
header("Location: randomspacemedia(login).html");
exit;
?>
