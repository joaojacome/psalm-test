<?php

if ($argc !== 2 || !is_numeric($argv[1])) {
    echo "usage: php generate.php NUMBER_OF_FILES" . PHP_EOL;
    die();
}
$nfiles = (int) $argv[1];
$strs = [];

for ($i=0; $i < $nfiles; $i++) {
    do {
        $str = 'a'.bin2hex(random_bytes(4));
    } while (isset($strs[$str]));
    $strs[$str] = 1;
}

for ($i=0; $i < $nfiles; $i++) {
    do {
        $str = array_rand($strs);
    } while ($strs[$str] !== 1);
    $strs[$str]++;
    do {
        $sub = array_rand($strs);
    } while ($sub === $str);
    do {
        $sub2 = array_rand($strs);
    } while ($sub2 === $sub);
    $code = <<<PHP
    <?php

    declare(strict_types=1);

    namespace App;

    class ${str}
    {
        public ${sub}&${sub2} \$prop3;
    }

    PHP;
    $fd = fopen("src/${str}.php", 'w');
    fwrite($fd, $code);
    fclose($fd);
}
