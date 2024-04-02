document.getElementById("periodType").addEventListener("change", function () {
    var customDaysDiv = document.getElementById("customDays");
    if (this.value === "custom") {
        customDaysDiv.style.display = "block";
    } else {
        customDaysDiv.style.display = "none";
    }
});


function validateDateRange(dateFromId, dateToId) {
    console.log("validating date range");
    var dateFromInput = document.getElementById(dateFromId).value;

    var currentDate = new Date().setHours(0, 0, 0, 0);
    var selectedDateFrom = new Date(dateFromInput).setHours(0, 0, 0, 0);


    if (selectedDateFrom > currentDate) {
        alert("Please choose start date from the past or today.");
        return false; // Prevent form submission
    }

    // If a second argument was passed, validate it as well
    if (dateToId !== undefined) {
        var dateToInput = document.getElementById(dateToId).value;
        var selectedDateTo = new Date(dateToInput).setHours(0, 0, 0, 0);

        if (selectedDateTo > currentDate) {
            alert("Please choose end date from the past or today");
            return false; // Prevent form submission
        }
        if (selectedDateFrom > selectedDateTo) {
            alert("End date must be greater than start date.");
            return false; // Prevent form submission
        }
    }

    return true; // Allow form submission
}

function validateCustomDateRange(dateFromId, periodType) {
    console.log("validating custom date range");
    var dateFromInput = document.getElementById(dateFromId).value;
    var currentDate = new Date().setHours(0, 0, 0, 0);
    var selectedDateFrom = new Date(dateFromInput).setHours(0, 0, 0, 0);

    if (selectedDateFrom > currentDate) {
        alert("Please choose start date from the past or today.");
        return false; // Prevent form submission
    }

    // Validate based on the selected period type
    var periodTypeValue = document.getElementById(periodType).value;
    if (periodTypeValue === "custom") {
        var numberOfDays = document.getElementById("days").value;
        if (!numberOfDays || numberOfDays < 1) {
            alert("Please enter a valid number of days.");
            return false; // Prevent form submission
        }
        var selectedDateTo = new Date(dateFromInput);
        selectedDateTo.setDate(selectedDateTo.getDate() + parseInt(numberOfDays));
        selectedDateTo.setHours(0, 0, 0, 0);
        if (selectedDateTo > currentDate) {
            alert("Please choose start date atleast " + numberOfDays + " days before today.");
            return false; // Prevent form submission
        }
    }
    else if (periodTypeValue === "week")
    {
        var selectedDateTo = new Date(dateFromInput);
        selectedDateTo.setDate(selectedDateTo.getDate() + 7);
        selectedDateTo.setHours(0, 0, 0, 0);
        if (selectedDateTo > currentDate) {
            alert("Please choose start date atleast 7 days before today.");
            return false; // Prevent form submission
        }
    }
    else if (periodTypeValue === "month")
    {
        console.log("month");
        var selectedDateTo = new Date(dateFromInput);
        selectedDateTo.setMonth(selectedDateTo.getMonth() + 1);
        selectedDateTo.setHours(0, 0, 0, 0);
        console.log(selectedDateTo);
        console.log(currentDate);
        if (selectedDateTo > currentDate) {
            alert("Please choose start date atleast 1 month before today.");
            return false; // Prevent form submission
        }
    }

    return true; // Allow form submission
}