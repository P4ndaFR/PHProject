<!DOCTYPE html>
<html>
<body>

<?php
$string = "Hello world. Beautiful day today.";
  $token = strtok($string, " ");
  
while ($token !== FALSE)
    {
    echo "$token<br>";
    $token = strtok(" ");
    }
?>
</body>
</html>