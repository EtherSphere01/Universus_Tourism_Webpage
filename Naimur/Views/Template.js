// update profile name and email

// let namedb = "Naimur Rahman";
// let emaildb = "naimurrahman0@gmail.com";
// let imgurlbd = "./Icons/profile.jpg";

// let namehtml = document.querySelectorAll(".logout .name");
// let emailhtml = document.querySelectorAll(".logout .email");
// let imghtml = document.querySelectorAll(".logout img");
// let headerimg = document.querySelectorAll(".headerimg");

// namehtml[0].textContent = namedb;
// namehtml.forEach((element) => {
//   element.textContent = namedb;
// });

// emailhtml[0].textContent = emaildb;
// emailhtml.forEach((element) => {
//   element.textContent = emaildb;
// });

// imghtml[0].src = imgurlbd;
// imghtml.forEach((element) => {
//   element.setAttribute("src", imgurlbd);
// });

// headerimg[0].src = imgurlbd;
// headerimg.forEach((element) => {
//   element.setAttribute("src", imgurlbd);
// });

let dashboardPage = document.querySelector(".dashboard");
let reportPage = document.querySelector(".report");
let travelersPage = document.querySelector(".travelers");
let tourguidePage = document.querySelector(".tour-guide");
let settingsPage = document.querySelector(".settings");
let tourpage = document.querySelector(".tours");
let services = document.querySelector(".services");
let leftprofile = document.querySelector(".logout img");
let headerimg = document.querySelector(".header-profile img");
let messages = document.querySelector(".messages");

dashboardPage.addEventListener("click", () => {
  window.location = "Dashboard.php";
});

reportPage.addEventListener("click", () => {
  window.location = "Report.php";
});

travelersPage.addEventListener("click", () => {
  window.location = "Travelers.php";
});

tourguidePage.addEventListener("click", () => {
  window.location = "TourGuide.php";
});

settingsPage.addEventListener("click", () => {
  window.location = "newSetting.php";
});

tourpage.addEventListener("click", () => {
  window.location = "Tours.php";
});

services.addEventListener("click", () => {
  window.location = "Hotels.php";
});

leftprofile.addEventListener("click", () => {
  window.location = "newSetting.php";
});

headerimg.addEventListener("click", () => {
  window.location = "newSetting.php";
});

messages.addEventListener("click", () => {
  window.location = "Message.php";
  const url = document.getElementById("clickableDiv").getAttribute("data-url");
  window.open(url, "_blank");
});

let notification = document.querySelector(".notification-popup");
let notification_cross = document.querySelector(".close-notification");
notification_cross.addEventListener("click", () => {
  notification.style.visibility = "hidden";
});

let notification_icon = document.querySelector(".notification-icon");
notification_icon.addEventListener("click", (event) => {
  notification.style.visibility = "visible";
  // event.preventDefault();
});
