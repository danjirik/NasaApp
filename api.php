<?php
class NasaApi
{
    private $fileName = "data.csv";
    private $api_key = "i0PsvLfORhEobbCvjeU4rtSHGdKNspxT0otWsbNs";
    private $api_url = "https://api.nasa.gov/planetary/apod?api_key=";

    public function __construct()
    {
        $this->api_url = $this->api_url . $this->api_key;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function saveDataIntoFile($response_data)
    {
        $csvFileName = $this->getFileName();
        // Open CSV file in rewrite mode
        $csvFile = fopen($csvFileName, 'w');
        // Writing header
        fputcsv($csvFile, array('Title', 'Date', 'Media Type', 'URL'));

        // Writing data to CSV
        foreach ($response_data as $data) {
            fputcsv($csvFile, array($data->title, $data->date, $data->media_type, $data->url));
        }

        fclose($csvFile); // Close CSV file

        if ($csvFile !== false) {
            echo "Data has been successfully saved to the file: $csvFileName";
        } else {
            echo "Error occurred while saving data to the file.";
        }
    }

    public function getImageByDate($date)
    {
        $json_data = file_get_contents($this->api_url . "&date=" . $date);
        $response_data = json_decode($json_data);
        $response_data = [$response_data];
        $this->saveDataIntoFile($response_data);

        return $response_data;
    }

    public function getImagesByDateSpan($date_from, $date_to)
    {
        $json_data = file_get_contents($this->api_url . "&start_date=" . $date_from . "&end_date=" . $date_to);
        $response_data = json_decode($json_data);
        $this->saveDataIntoFile($response_data);
        return $response_data;
    }

    public function getRandomImages($count)
    {
        $json_data = file_get_contents($this->api_url . "&count=" . $count);
        $response_data = json_decode($json_data);
        $this->saveDataIntoFile($response_data);
        return $response_data;
    }
}
?>