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
    normaal: 9, // Price for Volwassenen
    kind: 5, // Price for Kind t/m 11 jaar
    ouderen: 7, // Price for 65 +
  };

  function updateTicketCount() {
    var totalTickets = 0;

    document.querySelectorAll(".dropdown").forEach(function (dropdown) {
      totalTickets += 1;
      var selectedValue = document.getElementById(
        "dropdownMenuButton" + totalTickets
      ).textContent;

      if (selectedValue !== undefined) {
        if (selectedValue == "Normaal") {
          typeTicket = document.getElementById("ticket-" + totalTickets);
          typeTicket.innerHTML = "€" + ticketPrices["normaal"] + ",00";
          console.log("test1");
        } else if (selectedValue == "Kind t/m 11") {
          typeTicket = document.getElementById("ticket-" + totalTickets);
          typeTicket.innerHTML = "€" + ticketPrices["kind"] + ",00";
          console.log("test2");
        } else if (selectedValue == "65+") {
          typeTicket = document.getElementById("ticket-" + totalTickets);
          typeTicket.innerHTML = "€" + ticketPrices["ouderen"] + ",00";
          console.log("test3");
        }
      }
    });

    // document.getElementById("ticketCount").textContent = totalTickets;
    // document.getElementById(
    //   "totalAmount"
    // ).textContent = `€${totalAmount.toFixed(2)}`;
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
