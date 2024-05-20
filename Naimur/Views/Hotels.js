const editform = document.querySelector(".edit-form");
const closebutton = document.querySelector(".closee");
const enablebutton = document.querySelector(".details-btn");
const detailstable = document.querySelector(".details-table");

closebutton.addEventListener("click", () => {
  editform.style.display = "none";
  detailstable.style.visibility = "hidden";
});

enablebutton.addEventListener("click", () => {
  detailstable.style.visibility = "visible";
  editform.style.display = "none";
});
