let earning_page = document.querySelector(".panel-footer");
earning_page.addEventListener("click", () => {
  const url = document.getElementById("clickableDiv3").getAttribute("data-url");
  window.open(url, "_blank");
});
