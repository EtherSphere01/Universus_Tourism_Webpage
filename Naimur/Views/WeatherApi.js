let countryName = "";
let allData = [];

let date;
let temp;
let country;
let city;
let icon;
let humidity;
let windspd;
let windDir;
let day;
let time;
let newdate;
let feelslike;
let uvindex;

const days = [
  "Sunday",
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday",
];

const d = new Date();
day = days[d.getDay()];

const setIcon = document.querySelector(".weather img");
const setDate = document.querySelector(".date");
const setTemp = document.querySelector(".temp");
const setUvindex = document.querySelector(".uv");
const setFeelsLike = document.querySelector(".feelslike");
const setHumidity = document.querySelector(".progress-value");
const setWindspd = document.querySelector(".wind-value");
const setWinddir = document.querySelector(".wind-direction");
const setCountry = document.querySelector(".country");
const setIcon1 = document.querySelector(".weather2 img");
const setDay = document.querySelector(".day");
const setTime = document.querySelector(".time");
const setTemp2 = document.querySelector(".weather-temp");

let weather = async (countryName) => {
  let url = `https://weatherapi-com.p.rapidapi.com/current.json?q=${countryName}`;
  let options = {
    method: "GET",
    headers: {
      "X-RapidAPI-Key": "62a45f81c1mshee3f3227d0c5dc2p1a0decjsn0c1d8eee2594",
      "X-RapidAPI-Host": "weatherapi-com.p.rapidapi.com",
    },
  };
  try {
    let response = await fetch(url, options);
    let result = await response.json();
    return result;
  } catch {
    console.error("Error");
  }
};

async function details(countryName) {
  allData = [];
  allData.push(await weather(countryName));
  // console.log(allData);
  temp = allData[0].current.temp_c;
  country = allData[0].location.country;
  city = allData[0].location.name;
  icon = allData[0].current.condition.icon;
  date = allData[0].location.localtime;
  humidity = allData[0].current.humidity;
  windspd = allData[0].current.wind_kph;
  windDir = allData[0].current.wind_dir;
  feelslike = allData[0].current.feelslike_c;
  uvindex = allData[0].current.uv;

  setTemp.innerHTML = "Temp: " + temp + "°C" + ", " + city + "," + country;
  setDate.innerHTML = "Today, " + date;
  setHumidity.innerHTML = humidity + "%";
  setWindspd.innerHTML = "Speed: " + windspd + " km/h";
  setWinddir.innerHTML = "Direction: " + windDir;
  setCountry.innerHTML = city + "," + country;
  setIcon.src = icon;
  setIcon1.src = icon;
  // console.log(icon);
  setFeelsLike.innerHTML = "Feels like: " + feelslike + "°C";
  setUvindex.innerHTML = "UV Index: " + uvindex;
  setDate.innerHTML = "Today, " + date;
  setDay.innerHTML = day.toUpperCase();
  setTime.innerHTML = date;
  setTemp2.innerHTML = temp + "°C";
  progress(humidity);
  // console.log(allData);
}

const button = document.querySelector(".search img");
button.addEventListener("click", async () => {
  countryName = document.querySelector(".search input").value.toLowerCase();
  if (countryName != "") {
    details(countryName);
  }
});

let weather_popup = document.querySelector(".weather");
let close_popup = document.querySelector(".close");
let addclass = document.querySelector(".weather-popup");
let body1 = document.querySelector(".background");

weather_popup.addEventListener("click", () => {
  addclass.classList.remove("close-popup");
  addclass.classList.add("open-popup");
  body1.classList.add("new-background");
  body1.style.position = "absolute";
  document.querySelectorAll(".transition").forEach((element) => {
    element.style.zIndex = "0";
  });

  // document.querySelector(".new-background").style.position="absolute";
});

close_popup.addEventListener("click", () => {
  addclass.classList.remove("open-popup");
  addclass.classList.add("close-popup");
  body1.classList.remove("new-background");
  document.querySelectorAll(".transition").forEach((element) => {
    element.style.zIndex = "1";
  });
  // document.querySelector(".transition").classList.add("focus transition");
});

let progress = (value) => {
  let circularProgress = document.querySelector(".circular-progress"),
    progressValue = document.querySelector(".progress-value");

  let progressStartValue = 0,
    progressEndValue = value,
    speed = 15;

  let progress = setInterval(() => {
    progressStartValue++;

    progressValue.textContent = progressStartValue + "%";
    circularProgress.style.background = `conic-gradient(#7d2ae8 ${
      progressStartValue * 3.6
    }deg, #ededed 0deg)`;

    if (progressStartValue == progressEndValue) {
      clearInterval(progress);
    }
  }, speed);
};

const button2 = document.querySelectorAll(".search2 img");
// console.log(button2[0]);
button2[0].addEventListener("click", async () => {
  let valuee = document.querySelectorAll(".search-box2");
  countryName = valuee[0].value.toLowerCase();
  if (countryName != "") {
    details(countryName);
  }
});

details(locationset);
