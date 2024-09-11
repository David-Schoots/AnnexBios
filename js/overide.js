document.addEventListener("DOMContentLoaded", function () {
  const mainButton = document.getElementById("mainButton");
  const extraButtons = document.getElementById("extraButtons");

  mainButton.addEventListener("click", function () {
    extraButtons.classList.toggle("d-none");
  });
});

/* code for the ticket price */

document.addEventListener("DOMContentLoaded", function () {
  const ticketPrices = {
    dropdownMenuButton1: 10, // Price for Volwassenen
    dropdownMenuButton2: 5, // Price for Kind t/m 11 jaar
    dropdownMenuButton3: 7, // Price for 65 +
  };

  function updateTicketCount() {
    let totalTickets = 0;
    let totalAmount = 0;

    document.querySelectorAll(".dropdown").forEach(function (dropdown) {
      const button = dropdown.querySelector(".btn");
      const selectedValue = parseInt(button.textContent, 10) || 0;
      const dropdownId = button.id;
      if (ticketPrices[dropdownId] !== undefined) {
        totalTickets += selectedValue;
        totalAmount += selectedValue * ticketPrices[dropdownId];
      }
    });

    document.getElementById("ticketCount").textContent = totalTickets;
    document.getElementById(
      "totalAmount"
    ).textContent = `€${totalAmount.toFixed(2)}`;
  }

  document.querySelectorAll(".dropdown-item").forEach(function (item) {
    item.addEventListener("click", function (event) {
      event.preventDefault();
      const selectedValue = event.target.getAttribute("data-value");
      const dropdownButton = event.target
        .closest(".dropdown")
        .querySelector(".btn");
      dropdownButton.textContent = selectedValue;
      updateTicketCount();
    });
  });

  updateTicketCount(); // Initialize ticket count on page load
});
