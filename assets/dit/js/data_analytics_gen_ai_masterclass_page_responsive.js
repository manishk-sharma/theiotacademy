// Navbar hide on scroll
(function () {
  var header = document.getElementById("navbar");
  var lastY = 0;
  window.addEventListener(
    "scroll",
    function () {
      var y = window.scrollY;
      if (y > lastY && y > 80) {
        header.style.transform = "translateY(-100%)";
      } else {
        header.style.transform = "translateY(0)";
      }
      lastY = y;
    },
    { passive: true },
  );
})();

/* =========================================
   Session Countdown Timer
   Target: 28 September 2026, 2:00 PM IST
========================================= */
(function () {
  const target = new Date("2026-09-30T14:00:00+05:30").getTime();

  function pad(n) {
    return String(n).padStart(2, "0");
  }

  function update() {
    const diff = Math.max(0, target - Date.now());

    const days = Math.floor(diff / 86400000);
    const hours = Math.floor((diff % 86400000) / 3600000);
    const minutes = Math.floor((diff % 3600000) / 60000);
    const seconds = Math.floor((diff % 60000) / 1000);

    const daysEl = document.getElementById("cd-d");
    const hoursEl = document.getElementById("cd-h");
    const minutesEl = document.getElementById("cd-m");
    const secondsEl = document.getElementById("cd-s");

    if (daysEl) daysEl.textContent = pad(days);
    if (hoursEl) hoursEl.textContent = pad(hours);
    if (minutesEl) minutesEl.textContent = pad(minutes);
    if (secondsEl) secondsEl.textContent = pad(seconds);

    // Stop when countdown reaches zero
    if (diff <= 0) {
      clearInterval(countdownInterval);

      if (daysEl) daysEl.textContent = "00";
      if (hoursEl) hoursEl.textContent = "00";
      if (minutesEl) minutesEl.textContent = "00";
      if (secondsEl) secondsEl.textContent = "00";
    }
  }

  update();

  const countdownInterval = setInterval(update, 1000);
})();


// Simple button feedback
document.querySelectorAll(".btn").forEach(function (b) {
  b.addEventListener("click", function (e) {
    e.preventDefault();
  });
});
