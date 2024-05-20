// ----------------------------------------details box----------------------------------
let totalTravelers = document.querySelector(".travelers-num");
let totalBookings = document.querySelector(".bookings-num");
let activeTrips = document.querySelector(".active-num");
let totalEarnings = document.querySelector(".earnings-num");

totalTravelers.textContent = totalTravelers_php;
totalBookings.textContent = totalBookings_php;
activeTrips.textContent = totalActive_php;
totalEarnings.textContent = `${totalEarnings_php} BDT`;

// ---------------------------Pie chart----------------------------
let firstPer = document.querySelector(".first-discount-per");
let secondPer = document.querySelector(".second-discount-per");
let thirdPer = document.querySelector(".third-discount-per");

let spdcolor = document.querySelector(".first-discount-color");
spdcolor = getComputedStyle(spdcolor);
spdcolor = spdcolor.getPropertyValue("background-color");

let fccolor = document.querySelector(".second-discount-color");
fccolor = getComputedStyle(fccolor);
fccolor = fccolor.getPropertyValue("background-color");

let fcpcolor = document.querySelector(".third-discount-color");
fcpcolor = getComputedStyle(fcpcolor);
fcpcolor = fcpcolor.getPropertyValue("background-color");

let color;

let specialDiscount = specialDiscount_php;
let fixedCard = fixedCard_php;
let fixedCoupon = fixedCoupon_php;

let total_discount = specialDiscount + fixedCard + fixedCoupon;

specialDiscount = (specialDiscount / total_discount) * 100;
specialDiscount = Math.floor(specialDiscount);

fixedCard = (fixedCard / total_discount) * 100;
fixedCard = Math.floor(fixedCard);

fixedCoupon = (fixedCoupon / total_discount) * 100;
fixedCoupon = Math.floor(fixedCoupon);

if (specialDiscount + fixedCard + fixedCoupon < 100) {
  specialDiscount += 100 - (specialDiscount + fixedCard + fixedCoupon);
}

let update = () => {
  let maxValue = 0;
  if (specialDiscount > fixedCard && specialDiscount > fixedCoupon) {
    maxValue = specialDiscount;
    color = spdcolor;
  } else if (fixedCard > specialDiscount && fixedCard > fixedCoupon) {
    maxValue = fixedCard;
    color = fccolor;
  } else {
    maxValue = fixedCoupon;
    color = fcpcolor;
  }

  document.querySelector(".pie-chart-value").style.color = `${color}`;

  let Progressbar = document.querySelector(".pie-chart-progress"),
    progressValue = document.querySelector(".pie-chart-value");

  let startValue = 0,
    EndValue = maxValue,
    speed = 25;

  let sd = 0,
    fc = 0,
    fcp = 0,
    sum = 0;

  let check1 = false,
    check2 = false,
    check3 = false,
    check4 = false;

  let progress = setInterval(() => {
    if (sd <= specialDiscount) {
      document.documentElement.style.setProperty(
        "--special-discount",
        sd + "%"
      );
      firstPer.textContent = sd + "%";
      sd++;
    } else check1 = true;
    if (fc <= fixedCard) {
      document.documentElement.style.setProperty("--fixed-card", fc + "%");
      secondPer.textContent = fc + "%";
      fc++;
    } else check2 = true;

    if (fcp <= fixedCoupon) {
      document.documentElement.style.setProperty("--fixed-coupon", fcp + "%");
      thirdPer.textContent = fcp + "%";
      fcp++;
    } else check3 = true;

    if (startValue <= EndValue) {
      progressValue.textContent = startValue + "%";
      startValue++;
    } else check4 = true;

    if (check1 && check2 && check3 && check4) {
      clearInterval(progress);
    }
  }, speed);
};
update();
// ------------------------------------------------------------------------------------------

// ---------------------------Review Slider----------------------------

// review box
let review_boxes = document.querySelector(".review-boxes");
let review_container = document.querySelector(".review-container");

const create_review_box = (comments, username, dtime, rate, imgUrl) => {
  let review_boxn = document.createElement("div");
  review_boxn.classList.add("common-review-box");
  review_boxes.appendChild(review_boxn);

  // review box paragraph
  let paragraph = document.createElement("p");
  let review = document.createTextNode(comments);
  paragraph.appendChild(review);
  paragraph.classList.add("paragraph");
  review_boxn.appendChild(paragraph);

  //review box profile

  let review_profile = document.createElement("div");
  review_profile.classList.add("review-profile");
  review_boxn.appendChild(review_profile);

  let re_img = document.createElement("img");
  re_img.src = imgUrl;
  re_img.alt = "profile";
  re_img.classList.add("re-img");
  review_profile.appendChild(re_img);

  let re_name = document.createElement("p");
  let name = document.createTextNode(username);
  re_name.appendChild(name);
  re_name.classList.add("re-name");
  review_profile.appendChild(re_name);

  let re_time = document.createElement("p");
  let time_date = document.createTextNode(dtime);
  re_time.appendChild(time_date);
  re_time.classList.add("re-time");
  review_profile.appendChild(re_time);

  // review box ratings
  let ratings = document.createElement("div");
  ratings.classList.add("ratings");
  review_boxn.appendChild(ratings);

  if (Number.isInteger(rate)) {
    for (let i = 1; i <= rate; i++) {
      let rating_points = document.createElement("img");
      rating_points.classList.add("rating-point");
      rating_points.src = "./Icons/full-rating2.png";
      ratings.appendChild(rating_points);
    }
  } else {
    for (let i = 1; i < rate; i++) {
      let rating_points = document.createElement("img");
      rating_points.classList.add("rating-point");
      rating_points.src = "./Icons/full-rating2.png";
      ratings.appendChild(rating_points);
    }
    let rating_points = document.createElement("img");
    rating_points.classList.add("rating-point");
    rating_points.src = "./Icons/half-rating2.png";
    ratings.appendChild(rating_points);
  }
};
for (let i = 0; i < comment_arr.length; i++) {
  let comments = comment_arr[i];
  let username = username_arr[i];
  let dtime = dtime_arr[i];
  let rate = rate_arr[i];
  let temp_rate = Math.floor(rate);
  if (temp_rate == rate) {
    rate = temp_rate;
  }
  let imgUrl = imgUrl_arr[i];
  create_review_box(comments, username, dtime, rate, imgUrl);
}

// let comments =
//   "Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis repudiandae numquam sapiente porro quidem quisquam ipsa voluptas recusandae suscipit minus. Animi eos corporis quasi deserunt consequatur. Doloribus rem modi animi.";
// let username = "Naimur Rahman";
// let dtime = "2 days ago";
// let rate = 4.5;
// let imgUrl = "./Icons/profile.jpg";

// create_review_box(comments, username, dtime, 3.4, imgUrl);
// create_review_box(comments, username, dtime, 5, imgUrl);
// create_review_box(comments, username, dtime, 5, imgUrl);

const sliders = document.querySelectorAll(".review-boxes");

let counter = 0;
let total = comment_arr.length;
if (total % 2 == 0) {
  total = total / 2;
  total--;
} else {
  total = (total - 1) / 2;
}

const next_review = () => {
  sliders.forEach((slide) => {
    slide.style.transform = `translateX(-${counter * 101.3}%)`;
  });
};

const goNext = () => {
  if (counter == total) {
    counter = 0;
    next_review();
    return;
  }
  counter++;
  next_review();
};

const goPrev = () => {
  if (counter == 0) {
    return;
  }
  counter--;
  next_review();
};
// ------------------------------------------------------------------------------------------

//-----------------------------------Bottom Table--------------------------------------------
let countryuserArr = countryuserArr_php;
let countrytransactionArr = countrytransactionArr_php;
let countryrevenueArr = countryrevenueArr_php;

let totalUserdb = totalTravelers_php;
let totalTransactiondb = totalBookings_php;
let totalRevenuedb = totalEarnings_php;

let totalUsers = document.querySelector(".total-user");
let totalTransactions = document.querySelector(".total-transaction");
let totalRevenue = document.querySelector(".total-revenue");

totalUsers.textContent = totalUserdb;
totalTransactions.textContent = totalTransactiondb;
totalRevenue.textContent = `${totalRevenuedb} BDT`;

let countryuserUpdate = document.querySelectorAll(
  ".revenue-details-body .country-user"
);
let countrytransactionUpdate = document.querySelectorAll(
  ".revenue-details-body .country-transaction"
);
let countryrevenueUpdate = document.querySelectorAll(
  ".revenue-details-body .country-revenue"
);

countryuserUpdate.forEach((n, i) => {
  let sum = (countryuserArr[i] / totalUserdb) * 100;
  sum = sum.toFixed(2);
  n.textContent = `${countryuserArr[i]} (${sum}%)`;
});

countrytransactionUpdate.forEach((n, i) => {
  let sum = (countrytransactionArr[i] / totalTransactiondb) * 100;
  sum = sum.toFixed(2);
  n.textContent = `${countrytransactionArr[i]} (${sum}%)`;
});

countryrevenueUpdate.forEach((n, i) => {
  let sum = (countryrevenueArr[i] / totalRevenuedb) * 100;
  sum = sum.toFixed(2);
  n.textContent = `${countryrevenueArr[i]} (${sum}%)`;
});

// flag update--------------------------------

// let flagName = [
//   "United States of America",
//   "Saudi Arabia",
//   "Singapore",
//   "Bangladesh",
//   "Malaysia",
// ];

let flagName = countrynameArr_php;
let flag = document.querySelectorAll(".revenue-details-body img");
let updateName = document.querySelectorAll(
  ".revenue-details-body .country-name"
);

let arr;
const countryName2 = new Map();

const countryList = async () => {
  const Country_URL = "./country.json";
  let respose = await fetch(Country_URL);
  let data = await respose.json();
  arr = data;
  for (key in arr) {
    countryName2.set(arr[key].country_name, key.toUpperCase());
  }

  let countrynam1 = countryName2.get(flagName[0].toLowerCase());
  let countrynam2 = countryName2.get(flagName[1].toLowerCase());
  let countrynam3 = countryName2.get(flagName[2].toLowerCase());
  let countrynam4 = countryName2.get(flagName[3].toLowerCase());
  let countrynam5 = countryName2.get(flagName[4].toLowerCase());
  flag[0].src = `https://flagsapi.com/${countrynam1}/shiny/64.png`;
  flag[1].src = `https://flagsapi.com/${countrynam2}/shiny/64.png`;
  flag[2].src = `https://flagsapi.com/${countrynam3}/shiny/64.png`;
  flag[3].src = `https://flagsapi.com/${countrynam4}/shiny/64.png`;
  flag[4].src = `https://flagsapi.com/${countrynam5}/shiny/64.png`;

  let i = 0;
  updateName.forEach((n) => {
    n.textContent = flagName[i++];
  });
};
countryList();
// ------------------------------------------------------------------------------------------

// call next page

let earning_page = document.querySelector(".details-box4");
earning_page.addEventListener("click", () => {
  const url = document.getElementById("clickableDiv2").getAttribute("data-url");
  window.open(url, "_blank");
});
