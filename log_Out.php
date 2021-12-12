<?php
session_start();
unset($_session["username"]);
header("Location: log_On.html");
?>