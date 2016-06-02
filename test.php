<?php
include "menuJson.php";

$file = "json.md";

$objMenuJson = new menuJson($file);

$json = $objMenuJson->handle();

echo "\n$json\n\n";

print_r(json_decode($json, true));

