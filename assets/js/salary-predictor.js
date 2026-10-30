// toggeling the arrow icons in select tag
document.querySelectorAll(".selectInput").forEach((select) => {
  select.addEventListener("click", () => {
    // toggle arrow direction
    select.classList.toggle("open");
  });

  // remove .open when dropdown closes
  select.addEventListener("blur", () => {
    select.classList.remove("open");
  });
});

// Toggeling the password visibility hidden/show
function setupPasswordToggle(inputId, toggleId) {
  const input = document.getElementById(inputId);
  const toggle = document.getElementById(toggleId);

  toggle.addEventListener("click", () => {
    const icon = toggle.querySelector("i");
    if (input.type === "password") {
      input.type = "text";
      icon.classList.replace("fa-eye", "fa-eye-slash");
    } else {
      input.type = "password";
      icon.classList.replace("fa-eye-slash", "fa-eye");
    }
  });
}

// Apply to all password fields
setupPasswordToggle("registerPassword", "toggleRegisterPassword");
setupPasswordToggle("confirmPassword", "toggleConfirmPassword");
setupPasswordToggle("loginPassword", "toggleLoginPassword"); // if you already added for login

// Salary predict Form Validation
const nameInput = document.getElementById("name");
const cityInput = document.getElementById("city");
const salaryInput = document.getElementById("currentSalary");

const nameError = document.getElementById("nameError");
const cityError = document.getElementById("cityError");
const salaryError = document.getElementById("salaryError");

// ✅ Full Name Validation
nameInput.addEventListener("input", () => {
  const regex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;
  // allows alphabets + single spaces only (no double spaces, no numbers, no symbols)

  if (!regex.test(nameInput.value)) {
    nameError.textContent = "Letters only, no numbers or symbols.";
    nameInput.value = nameInput.value.replace(/[^A-Za-z ]/g, ""); // remove invalid chars
    nameInput.value = nameInput.value.replace(/\s{2,}/g, " "); // collapse multiple spaces
  } else {
    nameError.textContent = "";
  }
});

// ✅ City Validation (full name required, no numbers/symbols)
cityInput.addEventListener("input", () => {
  const regex = /^[A-Za-z]+(?: [A-Za-z]+)*$/;

  if (!regex.test(cityInput.value)) {
    cityError.textContent = "Enter valid city name (letters only).";
    cityInput.value = cityInput.value.replace(/[^A-Za-z ]/g, "");
    cityInput.value = cityInput.value.replace(/\s{2,}/g, " ");
  } else {
    cityError.textContent = "";
  }
});

// ✅ Current CTC Validation (numbers + optional decimals)
salaryInput.addEventListener("input", () => {
  const regex = /^\d*\.?\d{0,2}$/;

  if (!regex.test(salaryInput.value)) {
    salaryError.textContent = "Only numbers (up to 2 decimals) are allowed.";
    // Remove invalid chars but keep the decimal if valid
    salaryInput.value = salaryInput.value.replace(/[^0-9.]/g, "");
  } else {
    salaryError.textContent = "";
  }
});

// Prevent form submit if errors
document.getElementById("salaryForm").addEventListener("submit", (e) => {
  if (
    nameError.textContent ||
    cityError.textContent ||
    salaryError.textContent
  ) {
    e.preventDefault();
    alert("Please fix errors before submitting.");
  }
});

// current CTC currency symbol toggeling
// Map countries to currency symbols
const countryCurrencyMap = {
  "United States": "$",
  "United Kingdom": "£",
  Canada: "C$",
  Australia: "A$",
  Germany: "€",
  France: "€",
  Netherlands: "€",
  Switzerland: "CHF",
  Singapore: "S$",
  Japan: "¥",
  India: "₹",
  China: "¥",
  Brazil: "R$",
  Mexico: "$",
  "South Africa": "R",
  Other: "$",
};

// Get DOM elements
const countrySelect = document.getElementById("country");

// Listen for changes on the country dropdown
countrySelect.addEventListener("change", () => {
  const selectedCountry = countrySelect.value;
  const symbol = countryCurrencyMap[selectedCountry] || "$"; // default to $
  salaryInput.placeholder = `Current CTC  ( ${symbol} )`;
});

// Show Prediction Result
function formatCurrency(amount, currency = "USD") {
  const currencySymbols = {
    USD: "$",
    EUR: "€",
    GBP: "£",
    CAD: "C$",
    AUD: "A$",
    CHF: "CHF",
    SGD: "S$",
    JPY: "¥",
    INR: "₹",
    CNY: "¥",
    BRL: "R$",
    MXN: "$",
    ZAR: "R",
  };

  const symbol = currencySymbols[currency] || currency;
  return `${symbol}${amount.toLocaleString()}`;
}

// Optional helper if you want to use just the symbol
function getCurrencySymbol(currency) {
  const currencySymbols = {
    USD: "$",
    EUR: "€",
    GBP: "£",
    CAD: "C$",
    AUD: "A$",
    CHF: "CHF",
    SGD: "S$",
    JPY: "¥",
    INR: "₹",
    CNY: "¥",
    BRL: "R$",
    MXN: "$",
    ZAR: "R",
  };
  return currencySymbols[currency] || currency;
}

function showPredictionResults(result) {
  // Debug: Log the result to see what we're getting
  // console.log("Prediction result:", result);

  // Check if confidence_level exists and is valid
  const confidenceLevel = result.confidence_level;
  const isValidConfidence =
    !isNaN(confidenceLevel) && confidenceLevel >= 0 && confidenceLevel <= 1;

  // Check if AI was used (confidence level > 0.7 indicates AI prediction)
  const isAIUsed = isValidConfidence && confidenceLevel > 0.7;

  // Check if web search was used (look for web search in sources)
  const hasWebSearch =
    result.sources &&
    result.sources.some(
      (source) =>
        source.toLowerCase().includes("web search") ||
        source.toLowerCase().includes("tavily")
    );

  const aiStatus = isAIUsed
    ? '<span class="badge bg-success">🤖 Groq AI</span>'
    : '<span class="badge bg-warning">📊 Market Data</span>';

  const webSearchStatus = hasWebSearch
    ? '<span class="badge bg-info">🌐 Web Search</span>'
    : '<span class="badge bg-secondary">📋 Static Data</span>';

  // Update prediction modal content
  document.getElementById("predictedSalary").textContent = formatCurrency(
    result.predicted_salary,
    result.currency
  );
  document.getElementById("futureScope").textContent = result.future_scope;

  // Add AI status to the modal
  const modalTitle = document.querySelector("#predictionModal .modal-title");
  if (modalTitle) {
    modalTitle.innerHTML = `💰 Salary Prediction ${aiStatus} ${webSearchStatus}`;
  }

  // Update the subtitle under predicted salary
  const subtitleElement = document.querySelector(
    "#predictionModal .text-muted"
  );
  if (subtitleElement) {
    let subtitle = "";
    if (isAIUsed) {
      subtitle += "Based on Groq AI analysis";
    } else {
      subtitle += "Based on market data";
    }

    if (hasWebSearch) {
      subtitle += " with real-time web data";
    } else {
      subtitle += " with static market data";
    }

    subtitleElement.textContent = subtitle;
  }

  // Add confidence level and reasoning
  const predictedSalaryCard = document.querySelector(
    "#predictionModal .card-body.text-center"
  );
  if (predictedSalaryCard) {
    const confidenceElement = predictedSalaryCard.querySelector(".text-muted");
    if (confidenceElement) {
      let confidenceText = "";
      if (isValidConfidence) {
        confidenceText += `Confidence: ${Math.round(confidenceLevel * 100)}%`;
      } else {
        confidenceText += `Confidence: Unknown`;
      }
      confidenceText += ` | ${isAIUsed ? "Groq AI" : "Market Data"}`;
      confidenceText += ` | ${hasWebSearch ? "Real-time Web" : "Static Data"}`;
      confidenceElement.innerHTML = confidenceText;
    }
  }

  // Add data sources section
  const modalBody = document.querySelector("#predictionModal .modal-body");
  if (modalBody) {
    // Check if data sources section already exists
    let dataSourcesSection = modalBody.querySelector(".data-sources-section");
    if (!dataSourcesSection) {
      dataSourcesSection = document.createElement("div");
      dataSourcesSection.className = "data-sources-section mt-3";
      dataSourcesSection.innerHTML = `
                <div class="card bg-light">
                    <div class="card-body">
                        <h6><i class="fas fa-database me-2"></i>Data Sources</h6>
                        <div id="dataSourcesInfo"></div>
                    </div>
                </div>
            `;
      modalBody.appendChild(dataSourcesSection);
    }

    // Update data sources info
    const dataSourcesInfo = document.getElementById("dataSourcesInfo");
    if (dataSourcesInfo) {
      let sourcesHtml = "";

      if (hasWebSearch) {
        sourcesHtml +=
          '<div class="alert alert-info mb-2"><i class="fas fa-globe me-2"></i><strong>Web Search Active:</strong> Real-time data from multiple websites</div>';
      } else {
        sourcesHtml +=
          '<div class="alert alert-secondary mb-2"><i class="fas fa-database me-2"></i><strong>Static Data:</strong> Using predefined market data</div>';
      }

      if (result.sources && result.sources.length > 0) {
        sourcesHtml +=
          '<div class="mt-2"><strong>Sources:</strong><ul class="list-unstyled ms-3">';
        result.sources.forEach((source) => {
          const isWebSource =
            source.toLowerCase().includes("web search") ||
            source.toLowerCase().includes("tavily");
          const icon = isWebSource
            ? "fas fa-globe text-info"
            : "fas fa-database text-secondary";
          sourcesHtml += `<li><i class="${icon} me-2"></i>${source}</li>`;
        });
        sourcesHtml += "</ul></div>";
      }

      dataSourcesInfo.innerHTML = sourcesHtml;
    }
  }

  // Add reasoning if available
  if (result.reasoning) {
    const modalBody = document.querySelector("#predictionModal .modal-body");
    if (modalBody) {
      // Check if reasoning section already exists
      let reasoningSection = modalBody.querySelector(".reasoning-section");
      if (!reasoningSection) {
        reasoningSection = document.createElement("div");
        reasoningSection.className = "reasoning-section mt-3";
        reasoningSection.innerHTML = `
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6><i class="fas fa-brain me-2"></i>Analysis</h6>
                            <p class="mb-0" id="reasoningText"></p>
                        </div>
                    </div>
                `;
        modalBody.appendChild(reasoningSection);
      }
      document.getElementById("reasoningText").textContent = result.reasoning;
    }
  }

  // Populate recommended courses
  // const coursesContainer = document.getElementById("recommendedCourses");
  // coursesContainer.innerHTML = "";

  // result.recommended_courses.forEach((course) => {
  //   const courseCard = document.createElement("div");
  //   courseCard.className = "col-md-6 mb-3";
  //   courseCard.innerHTML = `
  //           <div class="card h-100">
  //               <div class="card-body text-center">
  //                   <i class="fas fa-graduation-cap fa-2x text-primary mb-2"></i>
  //                   <h6 class="card-title">${course}</h6>
  //                   <button class="btn btn-sm btn-outline-primary">Learn More</button>
  //               </div>
  //           </div>
  //       `;
  //   coursesContainer.appendChild(courseCard);
  // });

  // Create salary growth chart with a small delay to ensure DOM is ready
  setTimeout(() => {
    createSalaryChart(result);
  }, 100);

  // Show prediction modal
  const predictionModal = new bootstrap.Modal(
    document.getElementById("predictionModal")
  );
  predictionModal.show();

  // Add success animation
  document.getElementById("predictedSalary").classList.add("success-pulse");
  setTimeout(() => {
    document
      .getElementById("predictedSalary")
      .classList.remove("success-pulse");
  }, 600);
}

function createSalaryChart(result) {
  console.log("🎯 Starting chart creation...");

  // Check if Chart.js is available
  if (typeof Chart === "undefined") {
    console.error("❌ Chart.js is not loaded");
    return;
  }

  const ctx = document.getElementById("salaryChart");
  if (!ctx) {
    console.error("❌ Chart canvas element not found");
    return;
  }

  console.log("✅ Chart.js and canvas element found");

  // Destroy existing chart if it exists
  if (window.salaryChart) {
    try {
      if (typeof window.salaryChart.destroy === "function") {
        window.salaryChart.destroy();
      }
      window.salaryChart = null;
    } catch (error) {
      console.warn("⚠️ Error destroying existing chart:", error);
      window.salaryChart = null;
    }
  }

  // Get growth projections
  const projections = result.growth_projections || {
    current_year: result.predicted_salary,
    year_5: Math.round(result.predicted_salary * 1.4),
    year_10: Math.round(result.predicted_salary * 2.2),
  };

  const currency = result.currency || "USD";
  const symbol = getCurrencySymbol(currency);

  const data = {
    labels: ["Current Year", "5 Years", "10 Years"],
    datasets: [
      {
        label: "Salary Projection",
        data: [
          projections.current_year,
          projections.year_5,
          projections.year_10,
        ],
        backgroundColor: [
          "rgba(40, 167, 69, 0.2)",
          "rgba(255, 193, 7, 0.2)",
          "rgba(220, 53, 69, 0.2)",
        ],
        borderColor: [
          "rgba(40, 167, 69, 1)",
          "rgba(255, 193, 7, 1)",
          "rgba(220, 53, 69, 1)",
        ],
        borderWidth: 3,
        tension: 0.4,
      },
    ],
  };

  const config = {
    type: "line",
    data: data,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        title: {
          display: true,
          text: "Salary Growth Projection",
          font: {
            size: 16,
            weight: "bold",
          },
        },
        legend: {
          display: false,
        },
        tooltip: {
          callbacks: {
            label: function (context) {
              return `${symbol}${context.parsed.y.toLocaleString()}`;
            },
          },
        },
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function (value) {
              return `${symbol}${value.toLocaleString()}`;
            },
          },
        },
      },
    },
  };

  try {
    window.salaryChart = new Chart(ctx, config);
    console.log("✅ Chart created successfully");
  } catch (error) {
    console.error("❌ Chart creation failed:", error);
    // Show fallback text if chart fails
    ctx.style.display = "none";
    const chartContainer = ctx.parentElement;
    if (chartContainer) {
      chartContainer.innerHTML = `
                <div class="text-center p-4">
                    <h6>Salary Growth Projection</h6>
                    <p class="text-muted">Chart could not be displayed</p>
                    <div class="row">
                        <div class="col-md-4">
                            <strong>Current:</strong> ${symbol}${projections.current_year.toLocaleString()}
                        </div>
                        <div class="col-md-4">
                            <strong>5 Years:</strong> ${symbol}${projections.year_5.toLocaleString()}
                        </div>
                        <div class="col-md-4">
                            <strong>10 Years:</strong> ${symbol}${projections.year_10.toLocaleString()}
                        </div>
                    </div>
                </div>
            `;
    }
  }

  // Update growth summary
  updateGrowthSummary(projections, currency);
}

function updateGrowthSummary(projections, currency) {
  const summaryContainer = document.getElementById("growthSummary");
  if (!summaryContainer) return;

  const symbol = getCurrencySymbol(currency);
  const growth5Year = (
    (projections.year_5 / projections.current_year - 1) *
    100
  ).toFixed(1);
  const growth10Year = (
    (projections.year_10 / projections.current_year - 1) *
    100
  ).toFixed(1);

  summaryContainer.innerHTML = `
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h6>Current Year</h6>
                    <h4>${symbol}${projections.current_year.toLocaleString()}</h4>
                    <small>Starting Point</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-dark">
                <div class="card-body text-center">
                    <h6>5 Years</h6>
                    <h4>${symbol}${projections.year_5.toLocaleString()}</h4>
                    <small>+${growth5Year}% Growth</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body text-center">
                    <h6>10 Years</h6>
                    <h4>${symbol}${projections.year_10.toLocaleString()}</h4>
                    <small>+${growth10Year}% Growth</small>
                </div>
            </div>
        </div>
    `;
}

// Sending Form Data
document.getElementById("salaryForm").addEventListener("submit", function (e) {
  e.preventDefault(); // stop page reload

  // ✅ Check if user logged in
  const userId = localStorage.getItem("user_id");
  const token = localStorage.getItem("token");

  if (!userId || !token) {
    console.log("❌ User not logged in → showing login modal");
    showLoginModal(); // your existing function
    return; // stop further execution
  }

  const form = e.target;
  const submitBtn = form.querySelector('button[type="submit"]');

  // 🔹 Disable button + Show loader
  submitBtn.disabled = true;
  document.getElementById("loaderOverlay").style.display = "flex";

  const formData = new URLSearchParams();
  formData.append("user_id", userId);
  formData.append("name", form.name.value.trim());
  formData.append("country", form.country.value);
  formData.append("city", form.city.value.trim());
  formData.append("profession", form.profession.value);
  formData.append("experience", form.experience.value);
  formData.append("current_salary", form.current_salary.value);
  formData.append("skills", form.skills.value.trim());

  console.log("📤 Form Data Sent:", Object.fromEntries(formData));

  // Send request
  fetch("https://salarypredictor.uctconsulting.com/predict-salary", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
      Authorization: `Bearer ${token}`,
    },
    body: formData.toString(),
  })
    .then(async (response) => {
      if (!response.ok) {
        const err = await response.json();
        console.error("❌ API Error:", response.status, response.statusText);
        console.error("📩 Backend Error Details:", err);
        return;
      }
      return response.json();
    })
    .then((data) => {
      if (data) {
        // ✅ Reset the form before showing the result
        document.getElementById("salaryForm").reset();
        showPredictionResults(data);
      }
    })
    .catch((error) => console.error("⚠️ Network/Code Error:", error))
    .finally(() => {
      // 🔹 Re-enable button + Hide loader
      submitBtn.disabled = false;
      document.getElementById("loaderOverlay").style.display = "none";
    });
});

// Authentication
/* =====================================================
   AUTH.JS – Authentication Handling (Login, Register, Logout) */
// 🔹 Run once DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
  // 👉 Get any stored user session data
  const userId = localStorage.getItem("user_id");
  const isAdmin = localStorage.getItem("is_admin");
  const token = localStorage.getItem("token");

  // 🛑 Safety check: if userId exists but token is missing → clear invalid session
  if (userId && !token) {
    console.log("Found userId but no token - clearing invalid session");
    localStorage.clear();
  }

  // 👉 Get fresh values after cleanup
  const freshUserId = localStorage.getItem("user_id");
  const freshIsAdmin = localStorage.getItem("is_admin");
  console.log("Page loaded - userId:", freshUserId, "isAdmin:", freshIsAdmin);

  // 🟢 Update navbar (login/register vs user info)
  setTimeout(() => {
    updateNavigation(freshUserId, freshIsAdmin);
    initializeFormHandlers();
    // Second check after short delay (safety for async updates)
    setTimeout(() => {
      const finalUserId = localStorage.getItem("user_id");
      const finalIsAdmin = localStorage.getItem("is_admin");
      console.log(
        "Final check - userId:",
        finalUserId,
        "isAdmin:",
        finalIsAdmin
      );
      updateNavigation(finalUserId, finalIsAdmin);
    }, 500);
  }, 100);
});

/* =====================================================
   🔹 Update Navbar (show/hide Login, Register, Admin, Logout)
   ===================================================== */
function updateNavigation(userId, isAdmin) {
  const authButtons = document.getElementById("authButtons"); // Login/Register buttons
  const userInfo = document.getElementById("userInfo"); // Welcome text + logout
  const welcomeText = document.getElementById("welcomeText"); // "Welcome, User!"
  const adminLink = document.getElementById("adminLink"); // Admin dashboard link

  // if (userId) {
  //   console.log("userId:", userId);
  //   // ✅ User is logged in
  //   if (authButtons) authButtons.style.display = "none";
  //   if (userInfo) userInfo.style.display = "flex";
  //   if (welcomeText) welcomeText.textContent = `Welcome, User!`;
  //   if (adminLink)
  //     adminLink.style.display = isAdmin === "1" ? "inline-block" : "none";
  // } else {
  //   // ❌ User is logged out
  //   if (authButtons) authButtons.style.display = "flex";
  //   if (userInfo) userInfo.style.display = "none";
  //   if (adminLink) adminLink.style.display = "none";
  // }
}

/* =====================================================
   🔹 Show Modals (Login / Register)
   ===================================================== */
function showLoginModal() {
  const loginModal = new bootstrap.Modal(document.getElementById("loginModal"));
  const loginTab = document.getElementById("login-tab");
  if (loginTab) new bootstrap.Tab(loginTab).show(); // Switch to Login tab
  loginModal.show();
}

function showRegisterModal() {
  const loginModal = new bootstrap.Modal(document.getElementById("loginModal"));
  const registerTab = document.getElementById("register-tab");
  if (registerTab) new bootstrap.Tab(registerTab).show(); // Switch to Register tab
  loginModal.show();
}

/* =====================================================
   🔹 Logout Function
   ===================================================== */
function logout() {
  // Clear user data from localStorage
  localStorage.removeItem("user_id");
  localStorage.removeItem("is_admin");
  localStorage.removeItem("token");

  // console.log("Logged out - cleared localStorage");

  // Update navbar
  updateNavigation(null, null);
  updateButtonUi();

  alert("Logged out successfully!");
}

/* =====================================================
   🔹 Attach Event Handlers for Forms
   ===================================================== */
function initializeFormHandlers() {
  const loginForm = document.getElementById("loginForm");
  if (loginForm) loginForm.addEventListener("submit", handleLogin);

  const registerForm = document.getElementById("registerForm");
  if (registerForm) registerForm.addEventListener("submit", handleRegister);

  // Accessibility fix for Bootstrap modal
  const loginModal = document.getElementById("loginModal");
  if (loginModal) {
    loginModal.addEventListener("shown.bs.modal", function () {
      this.removeAttribute("aria-hidden");
    });
    loginModal.addEventListener("hidden.bs.modal", function () {
      this.setAttribute("aria-hidden", "true");
    });
  }
}

// 🔹 Shared login function (used by both login & registration)
async function loginUser(username, password) {
  try {
    // Prepare form data
    const formData = new FormData();
    formData.append("username", username);
    formData.append("password", password);

    // Send request to backend
    const response = await fetch(
      "https://salarypredictor.uctconsulting.com/login",
      {
        method: "POST",
        body: formData,
      }
    );
    const result = await response.json();

    if (response.ok) {
      // ✅ Store login info in localStorage
      localStorage.setItem("user_id", result.user_id);
      localStorage.setItem("is_admin", result.is_admin); // "1" if admin
      localStorage.setItem("token", result.access_token);

      // Hide login modal if it's open
      const loginModal = bootstrap.Modal.getInstance(
        document.getElementById("loginModal")
      );
      if (loginModal) loginModal.hide();
      // Update navbar
      updateNavigation(result.user_id, result.is_admin);
      updateButtonUi();

      // 🔹 New logic: Redirect based on admin status
      if (result.is_admin === 1) {
        // Admin → redirect to admin dashboard
        // window.location.href = "/salary-predictor-dashboard"; // <-- Change path as per your admin page
        window.location.href =
          "https://www.theiotacademy.co/salary-predictor-dashboard"; // <-- Change path as per your admin page
      } else {
        // Normal user → show alert / allow normal flow
        alert("Login successful! You can now make salary predictions.");
        // Optionally, you can refresh/update page content here if needed

        // console.log(result);
      }

      return true;
    } else {
      alert("Login failed: " + result.detail);
      return false;
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred during login");
    return false;
  }
}

// 🔹 Handle manual login form submit
async function handleLogin(e) {
  e.preventDefault();

  const submitBtn = e.target.querySelector('button[type="submit"]');
  const originalText = submitBtn.innerHTML;
  submitBtn.innerHTML =
    '<i class="fas fa-spinner fa-spin me-2"></i>Logging in...';
  submitBtn.disabled = true;

  try {
    const username = document.getElementById("loginUsername").value;
    const password = document.getElementById("loginPassword").value;

    await loginUser(username, password);
  } finally {
    submitBtn.innerHTML = originalText;
    submitBtn.disabled = false;
  }
}

// 🔹 Handle registration
async function handleRegister(e) {
  e.preventDefault();

  const submitBtn = e.target.querySelector('button[type="submit"]');
  const originalText = submitBtn.innerHTML;
  submitBtn.innerHTML =
    '<i class="fas fa-spinner fa-spin me-2"></i>Registering...';
  submitBtn.disabled = true;

  try {
    const username = document.getElementById("registerUsername").value;
    const email = document.getElementById("registerEmail").value;
    const password = document.getElementById("registerPassword").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
      alert("Passwords do not match!");
      return;
    }

    const formData = new FormData();
    formData.append("username", username);
    formData.append("email", email);
    formData.append("password", password);

    const response = await fetch(
      "https://salarypredictor.uctconsulting.com/register",
      {
        method: "POST",
        body: formData,
      }
    );
    const result = await response.json();

    if (response.ok) {
      alert("Registration successful! Logging you in...");

      // ✅ Auto-login immediately
      await loginUser(username, password);
    } else {
      alert("Registration failed: " + result.detail);
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred during registration");
  } finally {
    submitBtn.innerHTML = originalText;
    submitBtn.disabled = false;
  }
}

const updateButtonUi = () => {
  const authButtons = document.getElementById("authButtons");
  const logoutBtn = document.getElementById("logoutBtn");
  const isAdmin = localStorage.getItem("is_admin");
  const userId = localStorage.getItem("user_id");

  if (authButtons) {
    if (userId && isAdmin == "0") {
      authButtons.style.display = "none";
      logoutBtn.style.display = "block";
    } else {
      authButtons.style.display = "block";
      logoutBtn.style.display = "none";
    }
  } else {
    console.log("authButtons:", authButtons);
  }
};

window.addEventListener("DOMContentLoaded", updateButtonUi);
