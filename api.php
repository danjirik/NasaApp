<?php

require_once 'dataHandler.php';
class NasaApi
{

    private $api_key = "i0PsvLfORhEobbCvjeU4rtSHGdKNspxT0otWsbNs";
    private $api_url = "https://api.nasa.gov/planetary/apod?api_key=";
    private $api = "";

    private $dataHandler;

    public function __construct()
    {
        $this->api = $this->api_url . $this->api_key;
        $this->dataHandler = new DataHandler();
    }



    public function getImageByDate($date)
    {
        $json_data = file_get_contents($this->api . "&date=" . $date);
        $response_data = json_decode($json_data);

        if ($response_data) {
            $response_data = [$response_data];
            $this->dataHandler->saveDataIntoFile($response_data);
        } else {
            echo "Failed to retrieve image data for the given date.";
            return null;
        }

        return $response_data;
    }

    public function getImagesByDateSpan($date_from, $date_to)
    {
        $json_data = file_get_contents($this->api . "&start_date=" . $date_from . "&end_date=" . $date_to);
        $response_data = json_decode($json_data);

        if ($response_data) {
            $this->dataHandler->saveDataIntoFile($response_data);
        } else {
            echo "Failed to retrieve image data for the given date range.";
            return null;
        }

        return $response_data;
    }

    public function getRandomImages($count)
    {
        $json_data = file_get_contents($this->api . "&count=" . $count);
        $response_data = json_decode($json_data);

        if ($response_data) {
            $this->dataHandler->saveDataIntoFile($response_data);
        } else {
            echo "Failed to retrieve random image data.";
            return null;
        }

        return $response_data;
    }

}
?>