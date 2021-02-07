<?php
    header("Access-Control-Allow-Origin: *");
	header('Content-Type: application/json; charset=utf-8');
	header("Cache-Control: no-cache, no-store, must-revalidate");
    //
    require __DIR__ . '/vendor/autoload.php';
    //
    use \app\Support\BigBrotherBrasil;
    //
    $bbb = new BigBrotherBrasil();
    echo json_encode($bbb);