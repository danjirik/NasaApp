<?php
require_once 'api.php';
require_once 'formHandler.php';

$nasa_api = new NasaApi();
$formHandler = new FormHandler($nasa_api);

$formHandler->handleFormSubmit();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Nasa Application</title>

    <style>
        form {
            border: 1px solid black;
            padding: 10px;
            margin: 10px;
        }

        .container {
            display: inline-block;
        }
    </style>
</head>

<body>
    <header>
        <h1>Nasa Application</h1>
    </header>



    <div class="container">
        <h2>Choose date range option 1</h2>
        <form id="imagesByTimespan" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return validateDateRange('dateFrom', 'dateTo')">
            <label for="dateFrom">Date from:</label>
            <input type="date" id="dateFrom" name="dateFrom" required>
            <label for="dateTo">Date to:</label>
            <input type="date" id="dateTo" name="dateTo" required>
            <button type="submit" name="submitDatespan">Get data</button>
        </form>

        <h2>Choose date range option 2</h2>
        <form id="imagesByCustomTimespan" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"; method="post" onsubmit="return validateCustomDateRange('dateFrom2', 'periodType')">
            <label for="dateFrom">Initial day:</label>
            <input type="date" id="dateFrom2" name="dateFrom2" required><br><br>

            <label for="periodType">Length of period:</label>
            <select id="periodType" name="periodType" required>
                <option value="week">Week</option>
                <option value="month">Month</option>
                <option value="custom">Exact number of days</option>
            </select>


            <button type="submit" name="submitCustomDatespan">Get data</button>

            <span id="customDays" style="display: none;">
                <label for="customDaysInput">Number of days:</label>
                <input type="number" id="days" name="days" min="1">
            </span>
            
        </form>
        

        <h2>Get random data</h2>
        <form id="randomImagesForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="randomImages">Choose number of random images (1-10)</label>
            <input type="number" id="randomImages" name="randomImages" min="1" max="10">
            <button type="submit" name="submitRandomData">Get random data</button>

        </form>

        <h2>Choose date</h2>
        <form id="imagesByDate" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" onsubmit="return validateDateRange('date')">
            <!-- Choose date from and date to -->
            <label for="date">Date:</label>
            <input type="date" id="date" name="date">
            <button type="submit" name="submitDate">Get data</button>
        </form>
        
    </div>

    <script src="main.js"></script>

</body>

</html>