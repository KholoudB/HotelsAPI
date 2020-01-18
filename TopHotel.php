<?php

namespace Src;

/**
*This class is responsible for geting all hotels data from Besthotel provider
* @param  DateTime  fromDate
* @param  DateTime  toDate
* @param  string    city
* @param  int       numberOfAdults
* @return string[]
*/

class TopHotel implements HotelInterface
{
    protected $fromDate;
    protected $toDate;
    protected $city;
    protected $numberOfAdults;

    function __construct( $fromDate, $toDate, $city, $numberOfAdults ) {
		$this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->city = $city;
        $this->numberOfAdults = $numberOfAdults;
    }

/**
*This fucntion return hotels search result from tophotel.com provider
* @return string[]
*/


public function getResults()
{
    //Set from date to iso format
    $from = new \Datetime();
    $from = date_isodate_set($this->fromDate);

    //Set to date to iso format
    $to = new \Datetime();
    $to = date_isodate_set($this->toDate);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://www.topHotels.com/api/city=AUH&adults=4&from=.$from.&to=.$to.");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close ($ch);

   $response = 
   [
       [
       'hotelName'=> 'Name of the Hotel in Top Hotel',
       'rate'=> '**',
       'price'=> 300,
       'discount'=> 10,
       'amenities'=> ['pool','Internet']
       ],
       [
        'hotelName'=> 'Name of the second Hotel in Top Hotel',
        'rate'=> '***',
        'price'=> 300,
        'discount'=> 10,
        'amenities'=> ['pool','Internet']
 
       ]
   ];

   return json_encode($response);
}



}//end of class
