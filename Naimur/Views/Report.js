// -----------------------------------header Update---------------------
let travelers_number = document.querySelector(".s-travelers-num");
let tourGuide_number = document.querySelector(".s-tour-guide-num");
let hotel_number = document.querySelector(".s-hotel-num");
let ativePlan_number = document.querySelector(".s-active-num");
let totalPlan_number = document.querySelector(".s-plan-num");

let travelersBD = totalTravelers_php;
let tourGuideBD = totalTourguide_php;
let hotelBD = totalHotel_php;
let ativePlanBD = totalActive_php;
let totalPlanBD = totalPlan_php;

tourGuide_number.innerHTML = tourGuideBD;
hotel_number.innerHTML = hotelBD;
ativePlan_number.innerHTML = ativePlanBD;
totalPlan_number.innerHTML = totalPlanBD;
travelers_number.innerHTML = travelersBD;

// ----------------------------------------------------------------------
// ----------------------------------earning details------------------------
let earningGraph = document.querySelector(".from-tour-graph p");
let hotelGraph = document.querySelector(".from-hotel-graph p");
let addGraph = document.querySelector(".from-add-graph p");
let totalearningpara = document.querySelector(".total-earning");

// let touriststyle = document.createElement("touriststyle");
// let hotelstyle = document.createElement("hotelstyle");
// let addstyle = document.createElement("addstyle");

let totalearning = totalEarnings_php;
let tourIncome = touistEarning_php;
let hotelIncome = hotelEarning_php;
let addIncome = addEarning_php;
totalearningpara.innerHTML = `Total Earning: ${totalearning} BDT`;

let touristvalue = Math.round((tourIncome / totalearning) * 100);
let hotelvalue = Math.round((hotelIncome / totalearning) * 100);
let addvalue = Math.round((addIncome / totalearning) * 100);

if (touristvalue + hotelvalue + addvalue != 100) {
  touristvalue += 100 - (touristvalue + hotelvalue + addvalue);
}

let updateearning = () => {
  let speed = 10;
  let earningGraphStart = 0;
  let hotelGraphStart = 0;
  let addGraphStart = 0;
  let f1 = false;
  let f2 = false;
  let f3 = false;

  let updateearning = setInterval(() => {
    if (earningGraphStart != touristvalue) {
      earningGraphStart++;
      earningGraph.innerHTML = earningGraphStart + "%";

      let style = document.createElement("style");
      style.innerHTML = `
      .from-tour-graph::before {
      width: ${earningGraphStart}%;
      }
    `;
      document.head.appendChild(style);
    } else {
      f1 = true;
    }
    if (hotelGraphStart != hotelvalue) {
      hotelGraphStart++;
      hotelGraph.innerHTML = hotelGraphStart + "%";

      let style = document.createElement("style");
      style.innerHTML = `
      .from-hotel-graph::before {
      width: ${hotelGraphStart}%;
      }
      `;
      document.head.appendChild(style);
    } else {
      f2 = true;
    }
    if (addGraphStart != addvalue) {
      addGraphStart++;
      addGraph.innerHTML = addGraphStart + "%";

      let style = document.createElement("style");
      style.innerHTML = `
      .from-add-graph::before {
      width: ${addGraphStart}%;
      }
      `;
      document.head.appendChild(style);
    } else {
      f3 = true;
    }

    if (f1 && f2 && f3) {
      clearInterval(updateearning);
    }
  }, speed);
};

updateearning();
// -------------------------------------------------------------------------------

// ----------------------------------expense details------------------------

let tourguideexpensegraph = document.querySelector(".from-tourguide-graph p");
let officeexpensegraph = document.querySelector(".from-office-graph p");
let otherexpensegraph = document.querySelector(".from-other-graph p");
let totalExpensePara = document.querySelector(".total-expense");

// let touriststyle = document.createElement("touriststyle");
// let hotelstyle = document.createElement("hotelstyle");
// let addstyle = document.createElement("addstyle");

let totalexpense = totalExpense_php;
let tourguideExpense = tourguideSalary_php;
let officeExpense = officeStuff_php;
let otherExpense = other_php;
totalExpensePara.innerHTML = `Total Expense: ${totalexpense} BDT`;

let tourguideValue = Math.round((tourguideExpense / totalexpense) * 100);
let officeValue = Math.round((officeExpense / totalexpense) * 100);
let otherValue = Math.round((otherExpense / totalexpense) * 100);
if (tourguideValue + officeValue + otherValue != 100) {
  tourguideValue += 100 - (tourguideValue + officeValue + otherValue);
}

let updateExpense = () => {
  let speed = 20;
  let tourguideStartGraph = 0;
  let officeStartGraph = 0;
  let otherGraphStart = 0;
  let f1 = false;
  let f2 = false;
  let f3 = false;

  let updateExpense = setInterval(() => {
    if (tourguideStartGraph != tourguideValue) {
      tourguideStartGraph++;
      tourguideexpensegraph.innerHTML = tourguideStartGraph + "%";

      let style = document.createElement("style");
      style.innerHTML = `
      .from-tourguide-graph::before {
      width: ${tourguideStartGraph}%;
      }
    `;
      document.head.appendChild(style);
    } else {
      f1 = true;
    }
    if (officeStartGraph != officeValue) {
      officeStartGraph++;
      officeexpensegraph.innerHTML = officeStartGraph + "%";

      let style = document.createElement("style");
      style.innerHTML = `
      .from-office-graph::before {
      width: ${officeStartGraph}%;
      }
      `;
      document.head.appendChild(style);
    } else {
      f2 = true;
    }
    if (otherGraphStart != otherValue) {
      otherGraphStart++;
      otherexpensegraph.innerHTML = otherGraphStart + "%";

      let style = document.createElement("style");
      style.innerHTML = `
      .from-other-graph::before {
      width: ${otherGraphStart}%;
      }
      `;
      document.head.appendChild(style);
    } else {
      f3 = true;
    }

    if (f1 && f2 && f3) {
      clearInterval(updateExpense);
    }
  }, speed);
};

updateExpense();
// -------------------------------------------------------------------------------

// -------------------------------------chart1-----------------------------------------

const ctx = document.getElementById("earningVSexpense");

let earningData = [12450, 24510, 19986, 25510, 19861, 24515, 24516];
let expenseData = [9450, 24300, 14086, 18010, 12861, 18515, 25516];
let labels = [
  "November",
  "December",
  "January",
  "February",
  "March",
  "April",
  "May",
];

new Chart(ctx, {
  type: "line",
  data: {
    labels: labels,
    datasets: [
      {
        label: "Earning",
        data: earningData,
        borderWidth: 2,
        borderColor: "rgba(102, 150, 204)",
        backgroundColor: "rgba(102, 150, 204)",
        borderJoinStyle: "round",
        tension: 0.2,
      },
      {
        type: "line",
        label: "Expense",
        data: expenseData,
        borderWidth: 2,
        borderColor: "rgba(255, 0, 0)",
        backgroundColor: "rgba(255, 00, 0)",
        tension: 0.2,
      },
    ],
  },

  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const joining = document.getElementById("joiningDetails");
let touristjoin = [20, 15, 21, 18, 10, 20, 17];
let tourGuidejoin = [5, 7, 10, 8, 3, 10, 5];
let hotelsjoin = [10, 18, 17, 4, 5, 10, 15];
let packageBuy = [5, 10, 18, 12, 13, 17, 20];

new Chart(joining, {
  type: "line",
  data: {
    labels: labels,
    datasets: [
      {
        label: "Tourist",
        data: touristjoin,
        borderWidth: 2,
        borderColor: "rgba(102, 150, 204)",
        backgroundColor: "rgba(102, 150, 204)",
        borderJoinStyle: "round",
        tension: 0.2,
      },
      {
        type: "line",
        label: "TourGuide",
        data: tourGuidejoin,
        borderWidth: 2,
        borderColor: "rgba(159, 139, 240, 0.48)",
        backgroundColor: "rgba(159, 139, 240, 0.48)",
        tension: 0.2,
      },
      {
        type: "line",
        label: "Hotels",
        data: hotelsjoin,
        borderWidth: 2,
        borderColor: "rgba(100, 101, 99, 0.48)",
        backgroundColor: "rgba(100, 101, 99, 0.48)",
        tension: 0.2,
      },
      {
        type: "line",
        label: "Packages",
        data: packageBuy,
        borderWidth: 2,
        borderColor: "rgba(118, 86, 93, 0.8)",
        backgroundColor: "rgba(118, 86, 93, 0.8)",
        tension: 0.2,
      },
    ],
  },

  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

// top places

const topplaces = document.getElementById("topPlaces");
// let placesName = [
//   "Bangladesh",
//   "India",
//   "Malaysia",
//   "Singapore",
//   "Canada",
//   "Denmark",
//   "Egypt",
// ];

let placesName = countryArray_php;
// let countryData = [28, 48, 40, 19, 96, 27, 100];
let countryData = countryTransaction_php;

new Chart(topplaces, {
  type: "radar",
  data: {
    labels: placesName,
    datasets: [
      {
        label: "Top places",
        data: countryData,
        fill: true,
        backgroundColor: "rgba(54, 162, 235, 0.4)",
        borderColor: "rgb(154, 162, 255)",
        pointBackgroundColor: "rgb(154, 162, 255)",
        pointBorderColor: "#fff",
        pointHoverBackgroundColor: "rgba(102, 150, 204)",
        pointHoverBorderColor: "rgb(154, 162, 255)",
      },
    ],
  },

  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});
