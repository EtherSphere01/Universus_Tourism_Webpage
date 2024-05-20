// Get references to all the containers
const orderContainer = document.querySelector(".order-container");
const personalInfoContainer = document.querySelector(".personalInfo-container");
const changePassContainer = document.querySelector(".changePass-container");
const reviewPageContainer = document.querySelector(".reviewPage-container");

// Get references to all the items in the left column
const orderDetailsItem = document.getElementById("order-details");
const personalInfoItem = document.getElementById("personal-info");
const changePassItem = document.getElementById("change-password");
const reviewsItem = document.getElementById("reviews");

// Function to show a container and hide others
function showContainer(container) {
  container.style.display = "block";
}

// Function to hide a container
function hideContainer(container) {
  container.style.display = "none";
}

hideContainer(personalInfoContainer);
hideContainer(changePassContainer);
hideContainer(reviewPageContainer);

// Event listeners for left column items
orderDetailsItem.addEventListener("click", function () {
  showContainer(orderContainer);
  hideContainer(personalInfoContainer);
  hideContainer(changePassContainer);
  hideContainer(reviewPageContainer);
});

personalInfoItem.addEventListener("click", function () {
  showContainer(personalInfoContainer);
  hideContainer(orderContainer);
  hideContainer(changePassContainer);
  hideContainer(reviewPageContainer);
});

changePassItem.addEventListener("click", function () {
  showContainer(changePassContainer);
  hideContainer(orderContainer);
  hideContainer(personalInfoContainer);
  hideContainer(reviewPageContainer);
});

reviewsItem.addEventListener("click", function () {
  showContainer(reviewPageContainer);
  hideContainer(orderContainer);
  hideContainer(personalInfoContainer);
  hideContainer(changePassContainer);
});

let close_payment = document.querySelector(".test");

close_payment.addEventListener("click", function () {
  close_payment.style.display = "none";
});
