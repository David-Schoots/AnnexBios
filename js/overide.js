document.addEventListener("DOMContentLoaded", function () {
  const mainButton = document.getElementById("mainButton");
  const extraButtons = document.getElementById("extraButtons");

  mainButton.addEventListener("click", function () {
    extraButtons.classList.toggle("d-none");
  });
});
