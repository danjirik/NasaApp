Welcome to Nasa Application documentation

This applications provides user with 4 forms. Each form retrieves data from NASA api.</br>
All input form data are validated on client side using js and on server side using php. </br>
All data are returned into data.csv file with -> Title, Date, Media Type, URL. </br>
After submiting form, index.php is called again and the result is "echoed" - either data saved into file or wrong input. </br>
If there is an error saving into file it is written into error log. </br>
If there is an error getting data from api, it is also echoed. </br>


1. form - get data from selected range
2. form - get data from initial date to either week, month or selected number of days
3. form - get data of X random images, X is from integer interval <1,10>
4. form - get data of selected date

Code structure

1. index.php - main file that is visible on web browser
2. api.php - class that deals with api commands
3. dataHandler.php - help class to save data from api
4. formHandler.php - class to handle form submits and validates input on server side
5. main.js - js that deals with custom input and validates user input on client side