<?php

require __DIR__ . '/vendor/autoload.php';

use CodingCulture\Proxy\App;

$app = new App();

echo $app->run();