<?php
class FormHandler
{
    private $nasaApi;

    public function __construct(NasaApi $nasaApi)
    {
        $this->nasaApi = $nasaApi;
    }


    private function isValidDateRange($dateFrom, $dateTo)
    {
        $today = date('Y-m-d');

        // Check if dateFrom is before or equal to dateTo and neither date is in the future
        if ($dateFrom <= $dateTo && $dateFrom <= $today && $dateTo <= $today) {
            return true;
        }
        return false;
    }

    private function isValidDate($dateFrom)
    {
        $today = date('Y-m-d');

        // Check if dateFrom is not in the future
        if ($dateFrom <= $today) {
            return true;
        }
        return false;
    }

    public function handleFormSubmit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['submitDatespan'])) {
                $dateFrom = htmlspecialchars($_POST['dateFrom']);
                $dateTo = htmlspecialchars($_POST['dateTo']);
                if ($this->isValidDateRange($dateFrom, $dateTo)) {
                    $this->nasaApi->getDataByDateSpan($dateFrom, $dateTo);
                } else {
                    echo "Invalid date range";
                }
            } else if (isset($_POST['submitRandomData'])) {
                $randomDataCount = intval($_POST['randomData']);
                if ($randomDataCount > 0 && $randomDataCount <= 10) {
                    $this->nasaApi->getRandomData($randomDataCount);
                } else {
                    echo "Invalid number of Data";
                }
            } else if (isset($_POST['submitDate'])) {
                $date = htmlspecialchars($_POST['date']);
                if ($this->isValidDate($date)) {
                    $this->nasaApi->getDataByDate($date);
                } else {
                    echo "Invalid date";
                }
            } else if (isset($_POST['submitCustomDatespan'])) {
                $dateFrom = htmlspecialchars($_POST['dateFrom2']);
                $periodType = htmlspecialchars($_POST['periodType']);
                $dateTo = null;
                // Calculate end date based on period type
                switch ($periodType) {
                    case 'custom':
                        $days = intval($_POST['days']);
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
                if ($this->isValidDateRange($dateFrom, $dateTo)) {
                    $this->nasaApi->getDataByDateSpan($dateFrom, $dateTo);
                } else {
                    echo "Invalid date range";
                }
            }
        }
    }


}
?>