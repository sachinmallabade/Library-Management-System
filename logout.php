<?php
include_once("config/config.php");
session_destroy();
header("LOCATION:" .base_url);
exit;
?>