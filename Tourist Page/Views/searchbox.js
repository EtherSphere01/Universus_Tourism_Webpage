// Get references to tab elements and form sections
const flightTab = document.getElementById("flightTab");
const hotelTab = document.getElementById("hotelTab");
const tourTab = document.getElementById("tourTab");

const flightForm = document.getElementById("flightForm");
const hotelForm = document.getElementById("hotelForm");
const tourForm = document.getElementById("tourForm");

// Function to show the flight form and hide others
function showFlightForm() {
    flightForm.style.display = "block";
    hotelForm.style.display = "none";
    tourForm.style.display = "none";

    // Update tab classes
    flightTab.classList.add("active");
    hotelTab.classList.remove("active");
    tourTab.classList.remove("active");
}

// Function to show the hotel form and hide others
function showHotelForm() {
    flightForm.style.display = "none";
    hotelForm.style.display = "block";
    tourForm.style.display = "none";

     // Update tab classes
     flightTab.classList.remove("active");
     hotelTab.classList.add("active");
     tourTab.classList.remove("active");
}

// Function to show the tour form and hide others
function showTourForm() {
    flightForm.style.display = "none";
    hotelForm.style.display = "none";
    tourForm.style.display = "block";

     // Update tab classes
     flightTab.classList.remove("active");
     hotelTab.classList.remove("active");
     tourTab.classList.add("active");
}

// Add event listeners to tab elements
flightTab.addEventListener("click", showFlightForm);
hotelTab.addEventListener("click", showHotelForm);
tourTab.addEventListener("click", showTourForm);

// Initially show the flight form by default
showFlightForm();
