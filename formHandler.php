<?php
class FormHandler
{
    private $nasaApi;

    public function __construct(NasaApi $nasaApi)
    {
        $this->nasaApi = $nasaApi;
    }

    //TODO: sanitize input on server side
    public function handleFormSubmit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submitDatespan'])) {
                $dateFrom = $_POST['dateFrom'];
                $dateTo = $_POST['dateTo'];
                $images = $this->nasaApi->getImagesByDateSpan($dateFrom, $dateTo);
            } else if (isset($_POST['submitRandomImages'])) {
                $randomImages = $_POST['randomImages'];
                $images = $this->nasaApi->getRandomImages($randomImages);
            } else if (isset($_POST['submitDate'])) {
                $date = $_POST['date'];
                $images = $this->nasaApi->getImageByDate($date);
            } else if (isset($_POST['submitCustomDatespan'])) {
                $dateFrom = $_POST['dateFrom2'];
                $periodType = $_POST['periodType'];
                $dateTo = null;
                // Calculate end date based on period type
                switch ($periodType) {
                    case 'custom':
                        $days = $_POST['days'];
                        $dateTo = date('Y-m-d', strtotime($dateFrom . ' + ' . $days . ' days'));
                        break;
                    case 'week':
                        $dateTo = date('Y-m-d', strtotime($dateFrom . ' + 1 week'));
                        break;
                    case 'month':
                        $dateTo = date('Y-m-d', strtotime($dateFrom . ' + 1 month'));
                        break;
                    default:
                        return;
                }
                $images = $this->nasaApi->getImagesByDateSpan($dateFrom, $dateTo);
            }

        }
    }

}
?>