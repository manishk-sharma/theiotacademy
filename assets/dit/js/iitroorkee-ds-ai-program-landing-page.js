// ======================================================
// COMMON FUNCTION - URL + UTM + MASTERCLASS DATA
// ======================================================

function addTrackingData(formData) {

    const params = new URLSearchParams(window.location.search);

    // Full landing page URL
    formData.set("url_source", window.location.href);

    // Standard UTM
    formData.set("utm_source", params.get("utm_source") || "");
    formData.set("utm_medium", params.get("utm_medium") || "");
    formData.set("utm_campaign", params.get("utm_campaign") || "");
    formData.set("utm_term", params.get("utm_term") || "");
    formData.set("utm_content", params.get("utm_content") || "");
    formData.set("utm_id", params.get("utm_id") || "");

    // Support BOTH formats:
    // adset_name=xxx
    // adset+name=xxx  (+ becomes space in URLSearchParams)
    const adsetName =
        params.get("adset_name") ||
        params.get("adset name") ||
        "";

    const adName =
        params.get("ad_name") ||
        params.get("ad name") ||
        "";

    formData.set("adset_name", adsetName);
    formData.set("ad_name", adName);

    // Debug
    console.log("Tracking Data:", {
        utm_source: params.get("utm_source"),
        utm_medium: params.get("utm_medium"),
        utm_campaign: params.get("utm_campaign"),
        utm_term: params.get("utm_term"),
        utm_content: params.get("utm_content"),
        adset_name: adsetName,
        ad_name: adName,
        utm_id: params.get("utm_id")
    });
}

// ======================================================
// MAIN / BOOK YOUR SLOT FORM
// ======================================================

function handleFormSubmit(e) {
  e.preventDefault();

  const form = e.target;
  const submitBtn = form.querySelector('button[type="submit"]');

  const fullName = document.getElementById("firstname").value.trim();
  const mobile = document.getElementById("mobileno").value.trim();
  const email = document.getElementById("email").value.trim();
  const workExp = document.getElementById("work_experience").value;
  const callTime = document.getElementById("best_time_call").value;

  if (!fullName || !mobile || !email || !workExp || !callTime) {
    alert("Please fill all required fields");
    return false;
  }

  if (!/^[0-9]{10}$/.test(mobile)) {
    alert("Please enter a valid 10 digit mobile number");
    return false;
  }

  const nameParts = fullName.split(/\s+/);
  const firstName = nameParts.shift();
  const lastName = nameParts.join(" ");

  const formData = new FormData();

  formData.set("firstname", firstName);
  formData.set("lastname", lastName);
  formData.set("mobileno", mobile);
  formData.set("email", email);
  formData.set("work_experience", workExp);
  formData.set("best_time_call", callTime);

  formData.set("coursename", "iitroorkee-ds-ai-program");
  formData.set("form_name", "Book Your Slot");

  addTrackingData(formData);

  console.log("Book Your Slot:", [...formData.entries()]);

  submitBtn.disabled = true;
  submitBtn.innerText = "Submitting...";

  fetch(
    "https://www.theiotacademy.co/LiveLead/iitroorkeedsaiprogramSubmitlandingpage",
    {
      method: "POST",
      body: formData,
    },
  )
    .then(async (response) => {
      const text = await response.text();
      console.log("RAW RESPONSE:", text);

      try {
        return JSON.parse(text);
      } catch (error) {
        throw new Error("Invalid JSON response: " + text);
      }
    })
    .then((response) => {
      if (response.message === "success") {
        window.location.href = "https://www.theiotacademy.co/thankyou-iitr-10m";
        form.reset();
      } else {
        alert(response.response || "Something went wrong");
      }
    })
    .catch((error) => {
      console.error("Form Submit Error:", error);
      alert("Server error. Please try again.");
    })
    .finally(() => {
      submitBtn.disabled = false;
      submitBtn.innerText = "Submit";
    });

  return false;
}

// ======================================================
// SIDE LEAD FORM
// ======================================================

document.addEventListener("DOMContentLoaded", function () {
  const sideForm = document.getElementById("sideLeadForm");

  if (!sideForm) return;

  sideForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const submitBtn = sideForm.querySelector('button[type="submit"]');
    const mobileInput = sideForm.querySelector('[name="mobileno"]');

    if (!mobileInput) {
      console.error("Mobile field not found");
      return;
    }

    const mobile = mobileInput.value.trim();

    if (!/^[0-9]{10}$/.test(mobile)) {
      alert("Please enter a valid 10 digit mobile number");
      return;
    }

    const formData = new FormData(sideForm);

    // Basic fields
    formData.set("lastname", "");
    formData.set("coursename", "iitroorkee-ds-ai-program");
    formData.set("form_name", "Side Lead Form");

    // Side form mein ye fields nahi hain
    formData.set("forwho", "");

    // URL + UTM + Batch + Masterclass
    addTrackingData(formData);

    console.log("SIDE FORM DATA:");
    for (const [key, value] of formData.entries()) {
      console.log(key, "=", value);
    }

    submitBtn.disabled = true;

    fetch(
      "https://www.theiotacademy.co/LiveLead/iitroorkeedsaiprogramSubmitlandingpage",
      {
        method: "POST",
        body: formData,
      },
    )
      .then(async (response) => {
        const text = await response.text();

        console.log("RAW RESPONSE:", text);

        try {
          return JSON.parse(text);
        } catch (error) {
          throw new Error("Invalid JSON response: " + text);
        }
      })
      .then((data) => {
        if (data.message === "success") {
          alert("Thank you! Our team will contact you soon.");
          window.location.href =
            "https://www.theiotacademy.co/thankyou-iitr-10m";
          sideForm.reset();
        } else {
          alert(data.response || "Something went wrong");
        }
      })
      .catch((error) => {
        console.error("FORM SUBMIT ERROR:", error);
        alert("Something went wrong. Check console.");
      })
      .finally(() => {
        submitBtn.disabled = false;
      });
  });
});

// ======================================================
// BROCHURE / CURRICULUM FORMS
// ======================================================

document.addEventListener("DOMContentLoaded", function () {
  const forms = document.querySelectorAll(".download-brochure-form");

  if (!forms.length) return;

  forms.forEach(function (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const submitBtn = form.querySelector('button[type="submit"]');
      const mobileInput = form.querySelector('[name="mobileno"]');

      if (!mobileInput) {
        console.error("Mobile field not found");
        return;
      }

      const mobile = mobileInput.value.trim();

      if (!/^[0-9]{10}$/.test(mobile)) {
        alert("Please enter a valid 10 digit mobile number");
        return;
      }

      const formData = new FormData(form);
      const nameInput = form.querySelector(
        '[name="fullname"], [name="name"], [name="firstname"]',
      );

      if (!nameInput || !nameInput.value.trim()) {
        alert("Please enter your name");
        return;
      }

      const fullName = nameInput.value.trim();
      const nameParts = fullName.split(/\s+/);

      formData.set("firstname", nameParts.shift());
      formData.set("lastname", nameParts.join(" "));

      let formName = "";

      if (form.id === "downloadFormDsml") {
        formName = "DSML Download Brochure";
      } else if (form.id === "downloadCurriculumFormDsml") {
        formName = "DSML Download Curriculum";
      }

      formData.set("form_name", formName);
      formData.set("coursename", "iitroorkee-ds-ai-program");

      // URL + UTM + Batch + Masterclass
      addTrackingData(formData);

      console.log("Brochure/Curriculum Data:", [...formData.entries()]);

      submitBtn.disabled = true;

      fetch(
        "https://www.theiotacademy.co/LiveLead/iitroorkeedsaiprogramSubmitlandingpage",
        {
          method: "POST",
          body: formData,
        },
      )
        .then(async function (res) {
          const text = await res.text();

          console.log("RAW RESPONSE:", text);

          try {
            return JSON.parse(text);
          } catch (error) {
            throw new Error("Invalid JSON response: " + text);
          }
        })
        .then(function (response) {
          if (response.message === "success") {
            window.location.href =
              "https://www.theiotacademy.co/thankyou-iitr-10m";
            form.reset();

            let pdfUrl = "";

            if (form.id === "downloadFormDsml") {
              pdfUrl =
                "https://www.theiotacademy.co/assets/pdf/dsml-10months/10_months_new_brochure.pdf";
            } else if (form.id === "downloadCurriculumFormDsml") {
              pdfUrl =
                "https://www.theiotacademy.co/assets/pdf/dsml-10months/10_months_new_curriculum.pdf";
            }

            if (pdfUrl) {
              window.location.href = pdfUrl;
            }
          } else {
            alert(response.response || "Something went wrong");
          }
        })
        .catch(function (error) {
          console.error("FORM ERROR:", error);
          alert("Something went wrong. Please try again.");
        })
        .finally(function () {
          submitBtn.disabled = false;
        });
    });
  });
});

// ======================================================
// DOWNLOAD PROJECTS FORM
// ======================================================

document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("downloadProjectsFormDsml");

  if (!form) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const submitBtn = form.querySelector('button[type="submit"]');
    const mobileInput = form.querySelector('[name="mobileno"]');

    if (!mobileInput) {
      console.error("Mobile field not found");
      return;
    }

    if (!/^[0-9]{10}$/.test(mobileInput.value)) {
      alert("Please enter a valid 10 digit mobile number");
      return;
    }

    const formData = new FormData(form);

    formData.set("lastname", "");
    formData.set("form_name", "DSML Download Projects");
    formData.set("coursename", "iitroorkee-ds-ai-program");

    // URL + UTM + Batch + Masterclass
    addTrackingData(formData);

    console.log("Projects Form Data:", [...formData.entries()]);

    submitBtn.disabled = true;
    submitBtn.classList.add("loading");

    fetch(
      "https://www.theiotacademy.co/LiveLead/iitroorkeedsaiprogramSubmitlandingpage",
      {
        method: "POST",
        body: formData,
      },
    )
      .then(async (res) => {
        const text = await res.text();

        console.log("RAW RESPONSE:", text);

        try {
          return JSON.parse(text);
        } catch (error) {
          throw new Error("Invalid JSON response: " + text);
        }
      })
      .then((response) => {
        if (response.message === "success") {
          window.location.href =
            "https://www.theiotacademy.co/thankyou-iitr-10m";
          form.reset();
        } else {
          alert(response.response || "Something went wrong");
        }
      })
      .catch((error) => {
        console.error("FORM ERROR:", error);
        alert("Network error");
      })
      .finally(() => {
        submitBtn.disabled = false;
        submitBtn.classList.remove("loading");
      });
  });
});
