<?php

require __DIR__ . '/vendor/autoload.php';

use Grayson\TaiwanAddress\Translator;

$translator = new Translator();

echo $translator->get('台北市信義區忠孝東路一段33號44樓');