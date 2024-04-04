<?php


class DataHandler
{
    private $fileName = "data.csv";

    public function saveDataIntoFile($response_data)
    {
        $csvFileName = $this->fileName;
        $csvFile = fopen($csvFileName, 'w');
        fputcsv($csvFile, array('Title', 'Date', 'Media Type', 'URL'));

        foreach ($response_data as $data) {
            fputcsv($csvFile, array($data->title, $data->date, $data->media_type, $data->url));
        }

        fclose($csvFile);

        if (!$csvFile) {
            error_log("Error occurred while saving data to the file.");
        } else {
            echo "Data saved successfully";
        }
    }
}


?>