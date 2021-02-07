<?php
    require __DIR__ . '/vendor/autoload.php';

    use \app\Support\BigBrotherBrasil;
    new \app\Support\Environment();

    $bbb = new BigBrotherBrasil();

    

    echo "<pre>";
        $bbb->getBrothersData();
        print_r($bbb);
    echo "</pre>";