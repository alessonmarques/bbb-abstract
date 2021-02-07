<?php
    require __DIR__ . '/vendor/autoload.php';

    use \app\Support\BigBrotherBrasil;

    $bbb = new BigBrotherBrasil();

    $bbb->getBrothersData();