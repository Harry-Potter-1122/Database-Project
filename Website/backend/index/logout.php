<?php
session_start();
session_destroy();
header("Location: ../../frontend/index.php"); // or wherever your main page is
exit();
