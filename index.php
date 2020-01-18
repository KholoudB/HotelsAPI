<?php
error_reporting(E_ERROR | E_PARSE);

require_once __DIR__ . '/vendor/autoload.php';

use \Src\BestHotel;
use \Src\TopHotel;
use \Src\HotelInterface;
use \Src\OurHotel;


/**
*creating new object of BestHotel with 
*/
$BestHotel = new BestHotel('1-1-2020','15-1-2020','AUH',2);
//echo $BestHotel->getResults();


/**
*creating new object of TopHotel with 
*/
$TopHotel = new TopHotel('1-1-2020','15-1-2020','AUH',2);
//echo $TopHotel->getResults();

$OurHotel = new OurHotel('1-1-2020','15-1-2020','AUH',2,'BestHotel');
print_r($OurHotel->getResults());

