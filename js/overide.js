document.addEventListener("DOMContentLoaded", function () {
  const mainButton = document.getElementById("mainButton");
  const extraButtons = document.getElementById("extraButtons");

  mainButton.addEventListener("click", function () {
    extraButtons.classList.toggle("d-none");
  });
});

document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".dropdown-item").forEach(function (item) {
    item.addEventListener("click", function (event) {
      event.preventDefault();
      let selectedValue = event.target.getAttribute("data-value");
      let dropdownButton = event.target
        .closest(".dropdown")
        .querySelector(".btn");
      dropdownButton.textContent = selectedValue;
    });
  });
});
