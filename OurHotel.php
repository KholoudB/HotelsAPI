<?php

namespace Src;

/**
*This class is responsible for gathering  all hotels providers response and reformat it
*/

use \Src\BestHotel;
use \Src\TopHotel;
use \Src\HotelInterface;

class OurHotel implements HotelInterface
{
    protected $fromDate;
    protected $toDate;
    protected $city;
    protected $numberOfAdults;
    protected $providerName;

    function __construct( $fromDate, $toDate, $city, $numberOfAdults, $providerName ) {
		$this->fromDate = $fromDate;
        $this->toDate = $toDate;
        $this->city = $city;
        $this->numberOfAdults = $numberOfAdults;
        $this->providerName = $providerName;

    }

   
    protected function getRating()
    {
        if($this->providerName == 'BestHotel')
        {
            $BestHotelRating = new BestHotel($this->fromDate,$this->toDate,$this->city,$this->numberOfAdults);
            $response =  $BestHotelRating->getResults();
            $response = json_decode($response);
                foreach($response as $row ){
                    $stars = $row->rate;
                }
        }
        
        elseif($this->providerName == 'TopHotel')
        {
            $TopHotelRating = new TopHotel($this->fromDate,$this->toDate,$this->city,$this->numberOfAdults);
            $response =  $TopHotelRating->getResults();
            $response = json_decode($response);
            foreach($response as $row ){
                $stars = strlen($row->rate);
            }
            }
        return $stars;
    }

    protected function getPrice()
    {
        if($this->providerName == 'BestHotel')
        {
            $BestHotel = new BestHotel($this->fromDate,$this->toDate,$this->city,$this->numberOfAdults);
            $response =  $BestHotel->getResults();
            $response = json_decode($response);
            foreach($response as $row ){
                $price[] = round($row->price);
            }    
        }
        elseif($this->providerName == 'TopHotel')
       {
            $TopHotel = new TopHotel($this->fromDate,$this->toDate,$this->city,$this->numberOfAdults);
            $response =  $TopHotel->getResults();
            $response = json_decode($response);
            foreach($response as $row ){
                $price = $row->price;
            }
       }

        return $price;

    }
    protected function getAmenities()
    {
        if($this->providerName == 'BestHotel')
        {
            $BestHotel = new BestHotel($this->fromDate,$this->toDate,$this->city,$this->numberOfAdults);
            $response =  $BestHotel->getResults();
            $response = json_decode($response);
            foreach($response as $row ){
            $amenities[] = explode (",", $row->amenities);  
            }
        }
        elseif($this->providerName == 'TopHotel')
        {
            $TopHotel = new TopHotel($this->fromDate,$this->toDate,$this->city,$this->numberOfAdults);
            $response =  $TopHotel->getResults();
            $response = json_decode($response);
            foreach($response as $row ){
                $amenities[] = $row->amenities;
            }
        
        }
        
        return $amenities;

    }

    public function getResults()
    {
        $response = 
        [

                'status' => http_response_code(200),
                'provider' => $this->providerName,
                'fare' => $this->getPrice(),
                'amenities'=>$this->getAmenities(),
                'rate'=>$this->getRating()
           
           
            ];

        $sortedResult = array_column($response, 'rate');
        array_multisort($sortedResult, SORT_DESC, $response);
        return json_encode($response);

    }
    
}//end of class

