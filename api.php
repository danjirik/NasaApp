<?php

require_once 'dataHandler.php';
class NasaApi
{

    private $api_key = "i0PsvLfORhEobbCvjeU4rtSHGdKNspxT0otWsbNs";
    private $api_url = "https://api.nasa.gov/planetary/apod?api_key=";
    private $api = "";
    private $request_limit_text = "X-Ratelimit-Remaining:";
    private $request_limit;

    private $dataHandler;

    public function __construct()
    {
        $this->api = $this->api_url . $this->api_key;
        $this->dataHandler = new DataHandler();
        $this->request_limit = $this->getRequestLimitFromHeader();
    }


    public function getRequestLimit()
    {
        return $this->request_limit;
    }

    public function getRequestLimitFromHeader()
    {

        $json_data = file_get_contents($this->api);
        foreach ($http_response_header as $header) {
            if (substr($header, 0, strlen($this->request_limit_text)) === $this->request_limit_text) {
                $number = preg_replace('/\D/', '', $header);
                return $number;
            }
        }
        return null;
    }

    public function updateRequestLimit($http_response_header)
    {
        foreach ($http_response_header as $header) {
            if (substr($header, 0, strlen($this->request_limit_text)) === $this->request_limit_text) {
                $this->request_limit = preg_replace('/\D/', '', $header);
            }
        }

    }

    public function getDataByDate($date)
    {
        $json_data = file_get_contents($this->api . "&date=" . $date);
        $response_data = json_decode($json_data);
        $this->updateRequestLimit($http_response_header);

        if ($response_data) {
            $response_data = [$response_data];
            $this->dataHandler->saveDataIntoFile($response_data);
        } else {
            echo "Failed to retrieve data for the given date.";
            return null;
        }

        return $response_data;
    }

    public function getDataByDateSpan($date_from, $date_to)
    {
        $json_data = file_get_contents($this->api . "&start_date=" . $date_from . "&end_date=" . $date_to);
        $response_data = json_decode($json_data);
        $this->updateRequestLimit($http_response_header);
        if ($response_data) {
            $this->dataHandler->saveDataIntoFile($response_data);
        } else {
            echo "Failed to retrieve data for the given date range.";
            return null;
        }

        return $response_data;
    }

    public function getRandomData($count)
    {
        $json_data = file_get_contents($this->api . "&count=" . $count);
        $response_data = json_decode($json_data);
        $this->updateRequestLimit($http_response_header);
        if ($response_data) {
            $this->dataHandler->saveDataIntoFile($response_data);
        } else {
            echo "Failed to retrieve random data.";
            return null;
        }

        return $response_data;
    }

}
?>