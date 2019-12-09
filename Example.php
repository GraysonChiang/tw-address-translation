<?php

require __DIR__.'/vendor/autoload.php';

use Grayson\TaiwanAddress\Translator;

$translator = new Translator();

echo $translator->get('臺北市信義區興雅里忠孝東路五段55號5樓5室');
