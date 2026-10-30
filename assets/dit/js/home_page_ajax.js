document.getElementById('EnqForm').addEventListener('submit', function (e) {
  e.preventDefault();

  const overlay = document.getElementById('enqform-overlay');
  const successMsg = document.getElementById('success-msg');
  const errorMsg = document.getElementById('error-msg');

  document.getElementById('url_source').value = window.location.href;
  const formUrl = baseurly + 'LiveLead/allenquiryldsubmit';
  const formData = new FormData(this);

  overlay.style.display = 'block';

  fetch(formUrl, {
    method: 'POST',
    body: formData
  })
    .then((response) => response.json())
    .then((data) => {
      overlay.style.display = 'none';
      if (data.message === 'error') {
        alert(removeTags(data.response));
      } else if (data.message === 'success') {
        successMsg.innerHTML = data.response;
        successMsg.style.display = 'block';
        setTimeout(() => {
          successMsg.style.display = 'none';
        }, 15000);
        document.getElementById('EnqForm').reset();
      } else {
        errorMsg.style.display = 'block';
        errorMsg.innerHTML = data.response;
        setTimeout(() => {
          errorMsg.style.display = 'none';
        }, 15000);
      }
    })
    .catch((error) => {
      overlay.style.display = 'none';
      console.error('Form submission error:', error);
      alert('Something went wrong. Please try again later.');
    });
});

function removeTags(str) {
  if (!str) return "";
  return str.replace(/<\/?[^>]+(>|$)/g, "");
}


// document.getElementById('EnqForm').addEventListener('submit', function (e) {
//   e.preventDefault();
//   document.getElementById('url_source').value = window.location.href;
//   const formUrl = baseurly + 'LiveLead/allenquiryldsubmit';
//   const formData = new FormData(this);
//   document.getElementById('enqform-overlay').style.display = 'block';

//   fetch(formUrl, {
//     method: 'POST',
//     body: formData
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       if (data.message === 'error') {
//         alert(removeTags(data.response));
//         document.getElementById('enqform-overlay').style.display = 'none';
//       } else if (data.message === 'success') {
//         document.getElementById('enqform-overlay').style.display = 'none';
//         const stucessmsgMsg = document.getElementById('success-msg');
//         stucessmsgMsg.innerHTML = data.response;
//         setTimeout(() => {
//           stucessmsgMsg.style.display = 'none';
//         }, 15000);
//         document.getElementById('EnqForm').reset();
//       } else {
//         const sterrorMsg = document.getElementById('error-msg');
//         sterrorMsg.style.display = 'block';
//         sterrorMsg.innerHTML = data.response;
//         setTimeout(() => {
//           sterrorMsg.style.display = 'none';
//         }, 15000);
//       }
//     });
// });



// HOME MODAL JAVASCRIPT - Simple button-triggered modal only
// No auto-popup, no scroll triggers - ONLY manual button click

document.addEventListener("DOMContentLoaded", function () {

  console.log("home_page_ajax.js loaded");

  /* ===============================
     COUNTRY CODE POPULATE
  =============================== */
  const homeCountrySelect = document.getElementById("homeSelectedCountry");
  if (homeCountrySelect && typeof countryCodeValue !== "undefined") {
    homeCountrySelect.innerHTML = countryCodeValue;
  }

  /* ===============================
     CUSTOM SELECT (BEST TIME CALL)
  =============================== */
  const homeCustomSelects = document.querySelectorAll(".home-custom-select");

  homeCustomSelects.forEach((customSelect) => {
    const selectSelected = customSelect.querySelector(".select-selected");
    const selectItems = customSelect.querySelector(".select-items");

    if (!selectSelected || !selectItems) return;

    // Open / close dropdown
    selectSelected.addEventListener("click", function (e) {
      e.stopPropagation();
      closeAllSelects(customSelect);
      selectItems.classList.toggle("select-hide");
      selectSelected.classList.toggle("active");
    });

    // Select option
    selectItems.querySelectorAll("div").forEach((item) => {
      item.addEventListener("click", function (e) {
        e.stopPropagation();

        const value = this.dataset.value || this.textContent.trim();

        // UI update
        selectSelected.textContent = value;

        // Hidden input update
        const form = customSelect.closest("form");
        const bestTimeInput = form.querySelector(
          'input[name="best_time_call"]'
        );

        if (bestTimeInput) {
          bestTimeInput.value = value;
          console.log("best_time_call set:", value);
        }

        // Close dropdown
        selectItems.classList.add("select-hide");
        selectSelected.classList.remove("active");
      });
    });
  });

  // Close dropdown on outside click
  document.addEventListener("click", function () {
    closeAllSelects();
  });

  function closeAllSelects(current = null) {
    homeCustomSelects.forEach((customSelect) => {
      const items = customSelect.querySelector(".select-items");
      const selected = customSelect.querySelector(".select-selected");

      if (items) items.classList.add("select-hide");
      if (selected && selected !== current) {
        selected.classList.remove("active");
      }
    });
  }

  /* ===============================
     HOME FORM SUBMIT
  =============================== */
  const homeForm = document.querySelector(".homeModalForm");

  if (homeForm) {
    homeForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const bestTimeInput = this.querySelector(
        'input[name="best_time_call"]'
      );

      // ❌ Blank submit block
      if (!bestTimeInput || bestTimeInput.value.trim() === "") {
        alert("Please select best time to call");
        return;
      }

      // URL source
      const urlSource = this.querySelector(".home_enqurl_source");
      if (urlSource) {
        urlSource.value = window.location.href;
      }

      const formUrl =
        (typeof baseurly !== "undefined"
          ? baseurly
          : "https://www.theiotacademy.co/") +
        "LiveLead/homesubmitblog";

      const formData = new FormData(this);

      console.log(
        "Submitting best_time_call:",
        formData.get("best_time_call")
      );

      const overlay = document.getElementById("enqform-overlay");
      if (overlay) overlay.style.display = "block";

      fetch(formUrl, {
        method: "POST",
        body: formData,
      })
        .then((res) => res.json())
        .then((data) => {
          if (overlay) overlay.style.display = "none";

          if (data.message === "error") {
            alert(data.response || "Validation error");
            return;
          }

          if (data.message === "success") {
            // Hide form
            const formDiv = document.getElementById("homeModalFormDiv");
            const successDiv = document.getElementById("homeModalSuccessDiv");

            if (formDiv) formDiv.classList.add("d-none");
            if (successDiv) {
              successDiv.classList.remove("d-none");
              successDiv.classList.add("d-flex");
            }

            // Reset form
            homeForm.reset();

            const selectText = homeForm.querySelector(
              ".home-custom-select .select-selected"
            );
            if (selectText) selectText.textContent = "Select Day*";

            bestTimeInput.value = "";
          }
        })
        .catch((err) => {
          console.error("Submit error:", err);
          if (overlay) overlay.style.display = "none";
          alert("Something went wrong. Please try again.");
        });
    });
  }

  /* ===============================
     MODAL RESET ON CLOSE
  =============================== */
  const homeModal = document.getElementById("homeModal");

  if (homeModal) {
    homeModal.addEventListener("hidden.bs.modal", function () {
      const formDiv = document.getElementById("homeModalFormDiv");
      const successDiv = document.getElementById("homeModalSuccessDiv");

      if (formDiv) formDiv.classList.remove("d-none");
      if (successDiv) successDiv.classList.add("d-none");

      if (homeForm) {
        homeForm.reset();

        const selectText = homeForm.querySelector(
          ".home-custom-select .select-selected"
        );
        if (selectText) selectText.textContent = "Select Day*";

        const bestTimeInput = homeForm.querySelector(
          'input[name="best_time_call"]'
        );
        if (bestTimeInput) bestTimeInput.value = "";
      }
    });
  }

});

