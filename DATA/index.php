<?php

$connection = mysqli_connect("bdd", "root", "root1234") or die(mysqli_connect_error());
echo "Connected to MySQL<br />";

mysqli_close($connection);

?>