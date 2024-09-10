$(document).ready(function () {
  $(".test").timepicker({
    timeFormat: "HH:mm", // 24-uurs tijdnotatie
    interval: 60, // Interval van 60 minuten
    minTime: "08:00", // Minimum tijd
    maxTime: "23:00", // Maximum tijd (6:00 PM in 24-uurs formaat)
    defaultTime: "11:00", // Standaard tijd
    startTime: "08:00", // Starttijd
    dynamic: false,
    dropdown: true,
    scrollbar: true,
  });
});
