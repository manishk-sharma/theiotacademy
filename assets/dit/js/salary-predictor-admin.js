// Admin Dashboard JavaScript

// Pagination variables
let currentPage = 1;
const rowsPerPage = 10;
let usersCurrentPage = 1;
const usersRowsPerPage = 10; // change as needed

let usersData = [];
let filteredUsers = []; // will initialize later

let predictionsData = [];
let filteredData = []; // will initialize later

document.addEventListener("DOMContentLoaded", function () {
  // Check if user is admin
  const isAdmin = localStorage.getItem("is_admin");
  if (isAdmin !== "1") {
    window.location.href = "/";
    return;
  }

  // Load initial data
  loadDashboardData();

  // Initialize event listeners
  initializeAdminEventListeners();
});

function initializeAdminEventListeners() {
  // Add click handlers for sidebar navigation
  document.querySelectorAll(".sidebar .nav-link").forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      // Remove active class from all links
      document
        .querySelectorAll(".sidebar .nav-link")
        .forEach((l) => l.classList.remove("active"));

      // Add active class to clicked link
      this.classList.add("active");
    });
  });
}

async function loadDashboardData() {
  try {
    // Load users and predictions data
    const [usersResponse, predictionsResponse] = await Promise.all([
      fetch("https://salarypredictor.uctconsulting.com/admin/users"),
      fetch("https://salarypredictor.uctconsulting.com/admin/predictions"),
    ]);

    usersData = await usersResponse.json();
    filteredUsers = [...usersData];

    predictionsData = await predictionsResponse.json();
    filteredData = [...predictionsData];

    // Update dashboard
    updateDashboardStats();
    updateRecentPredictions();
    updateTopCountries();

    loadUsersTable();
    loadPredictionsTable();
  } catch (error) {
    console.error("Error loading dashboard data:", error);
    alert("Failed to load dashboard data");
  }
}

function updateDashboardStats() {
  // Update total users
  document.getElementById("totalUsers").textContent = usersData.length;

  // Update total predictions
  document.getElementById("totalPredictions").textContent =
    predictionsData.length;

  // Update average salary
  if (predictionsData.length > 0) {
    const avgSalary =
      predictionsData.reduce((sum, pred) => sum + pred.predicted_salary, 0) /
      predictionsData.length;
    document.getElementById("avgSalary").textContent =
      formatCurrency(avgSalary);
  }

  // Update top profession
  if (predictionsData.length > 0) {
    const professionCounts = {};
    predictionsData.forEach((pred) => {
      professionCounts[pred.profession] =
        (professionCounts[pred.profession] || 0) + 1;
    });

    const topProfession = Object.entries(professionCounts).sort(
      ([, a], [, b]) => b - a
    )[0][0];

    document.getElementById("topProfession").textContent = topProfession;
  }
}

function updateRecentPredictions() {
  const container = document.getElementById("recentPredictions");
  const recentPredictions = predictionsData
    .sort((a, b) => new Date(b.created_at) - new Date(a.created_at))
    .slice(0, 5);

  container.innerHTML = recentPredictions
    .map(
      (pred) => `
        <div class="d-flex justify-content-between align-items-center mb-3 p-3 border rounded">
            <div>
                <h6 class="mb-1">${pred.name}</h6>
                <small class="text-muted">${pred.profession} • ${
        pred.country
      }</small>
            </div>
            <div class="text-end">
                <div class="fw-bold text-success">${formatCurrency(
                  pred.predicted_salary,
                  pred.currency || "USD"
                )}</div>
                <small class="text-muted">${formatDate(pred.created_at)}</small>
            </div>
        </div>
    `
    )
    .join("");
}

function updateTopCountries() {
  const container = document.getElementById("topCountries");
  const countryCounts = {};

  predictionsData.forEach((pred) => {
    countryCounts[pred.country] = (countryCounts[pred.country] || 0) + 1;
  });

  const topCountries = Object.entries(countryCounts)
    .sort(([, a], [, b]) => b - a)
    .slice(0, 5);

  container.innerHTML = topCountries
    .map(
      ([country, count]) => `
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span>${country}</span>
            <span class="badge bg-primary">${count}</span>
        </div>
    `
    )
    .join("");
}

function showSection(sectionName) {
  // Hide all sections
  document.querySelectorAll('[id$="-section"]').forEach((section) => {
    section.style.display = "none";
  });

  // Show selected section
  const targetSection = document.getElementById(sectionName + "-section");
  if (targetSection) {
    targetSection.style.display = "block";

    // Load section-specific data
    if (sectionName === "users") {
      loadUsersTable();
    } else if (sectionName === "predictions") {
      loadPredictionsTable();
    }
  }

  // Update active nav link
  document.querySelectorAll(".sidebar .nav-link").forEach((link) => {
    link.classList.remove("active");
  });

  const activeLink = document.querySelector(
    `[onclick="showSection('${sectionName}')"]`
  );
  if (activeLink) {
    activeLink.classList.add("active");
  }
}

// filter the User
document.addEventListener("DOMContentLoaded", () => {
  // ✅ When data is ready (either hardcoded or fetched), copy it
  filteredUsers = [...usersData];
  loadUsersTable();
});

// 🔍 Search filter
document
  .getElementById("userSearchInput")
  .addEventListener("input", function () {
    const query = this.value.toLowerCase().trim();

    if (query === "") {
      filteredUsers = [...usersData]; // show all if search is empty
    } else {
      filteredUsers = usersData.filter((user) => {
        return (
          user.username.toLowerCase().includes(query) ||
          user.email.toLowerCase().includes(query)
        );
      });
    }

    usersCurrentPage = 1; // reset to first page after filtering
    loadUsersTable();
  });

function loadUsersTable() {
  const tbody = document.querySelector("#usersTable tbody");

  if (!filteredUsers || filteredUsers.length === 0) {
    tbody.innerHTML = `<tr><td colspan="5" class="text-center">No users found</td></tr>`;
    document.getElementById("usersTable-pagination").innerHTML = "";
    return;
  }

  const startIndex = (usersCurrentPage - 1) * usersRowsPerPage;
  const endIndex = startIndex + usersRowsPerPage;
  const pageData = filteredUsers.slice(startIndex, endIndex);

  tbody.innerHTML = pageData
    .map(
      (user) => `
        <tr>
            <td>${user.id}</td>
            <td>${user.username}</td>
            <td>${user.email}</td>
            <td>
                <span class="badge ${
                  user.is_admin ? "bg-danger" : "bg-success"
                }">
                    ${user.is_admin ? "Admin" : "User"}
                </span>
            </td>
            <td>${formatDate(user.created_at)}</td>
        </tr>
      `
    )
    .join("");

  renderUsersPagination(filteredUsers.length);
}

function renderUsersPagination(totalRows) {
  const paginationContainer = document.getElementById("usersTable-pagination");
  const totalPages = Math.ceil(totalRows / usersRowsPerPage);
  if (totalPages <= 1) {
    paginationContainer.innerHTML = "";
    return;
  }

  let buttons = `<button class="btn btn-sm btn-secondary me-2" 
                        onclick="changeUsersPage(${usersCurrentPage - 1})" 
                        ${
                          usersCurrentPage === 1 ? "disabled" : ""
                        }>Prev</button>`;

  // Always show first 3 pages
  const visiblePages = 3;
  for (let i = 1; i <= Math.min(visiblePages, totalPages); i++) {
    buttons += `<button class="btn btn-sm ${
      i === usersCurrentPage ? "btn-primary" : "btn-outline-primary"
    } me-1"
                            onclick="changeUsersPage(${i})">${i}</button>`;
  }

  // Add ellipsis if needed
  if (totalPages > visiblePages + 1) {
    buttons += `<span class="mx-1">...</span>`;
  }

  // Show last page if totalPages > visiblePages
  if (totalPages > visiblePages) {
    buttons += `<button class="btn btn-sm ${
      usersCurrentPage === totalPages ? "btn-primary" : "btn-outline-primary"
    } me-1"
                            onclick="changeUsersPage(${totalPages})">${totalPages}</button>`;
  }

  buttons += `<button class="btn btn-sm btn-secondary ms-2" 
                        onclick="changeUsersPage(${usersCurrentPage + 1})" 
                        ${
                          usersCurrentPage === totalPages ? "disabled" : ""
                        }>Next</button>`;

  paginationContainer.innerHTML = buttons;
}

function changeUsersPage(page) {
  const totalPages = Math.ceil(usersData.length / usersRowsPerPage);
  if (page < 1 || page > totalPages) return;
  usersCurrentPage = page;
  loadUsersTable();
}

// Filter the prediction
document.addEventListener("DOMContentLoaded", () => {
  // 1. Copy all predictions into filteredData
  filteredData = [...predictionsData];

  // 2. Reset current page to 1
  currentPage = 1;

  // 3. Load table with all data
  loadPredictionsTable();
});

// Search filter
document
  .getElementById("searchPredictionInput")
  .addEventListener("input", function () {
    const query = this.value.toLowerCase().trim();

    if (query === "") {
      // Reset to all data if input is empty
      filteredData = [...predictionsData];
    } else {
      // Filter by name OR profession
      filteredData = predictionsData.filter((pred) => {
        return (
          pred.name.toLowerCase().includes(query) ||
          pred.profession.toLowerCase().includes(query)
        );
      });
    }

    currentPage = 1; // reset to first page after filtering
    loadPredictionsTable();
  });

function loadPredictionsTable() {
  const tbody = document.querySelector("#predictionsTable tbody");
  if (!filteredData || filteredData.length === 0) {
    tbody.innerHTML = `<tr><td colspan="8" class="text-center">No predictions found</td></tr>`;
    document.getElementById("pagination").innerHTML = "";
    return;
  }

  // Slice data for current page
  const startIndex = (currentPage - 1) * rowsPerPage;
  const endIndex = startIndex + rowsPerPage;
  const pageData = filteredData.slice(startIndex, endIndex);

  tbody.innerHTML = pageData
    .map((pred, index) => {
      const isAIUsed = pred.confidence_level > 0.7;
      const aiStatus = isAIUsed
        ? '<span class="badge bg-success">🤖 Groq</span>'
        : '<span class="badge bg-warning">📊 Market</span>';

      return `
        <tr>
            <td>${startIndex + index + 1}</td>
            <td>${pred.name}</td>
            <td>${pred.profession}</td>
            <td>${formatCurrency(
              pred.current_salary,
              pred.currency || "USD"
            )}</td>
            <td class="text-success fw-bold">${formatCurrency(
              pred.predicted_salary,
              pred.currency || "USD"
            )} ${aiStatus}</td>
            <td>${pred.country}</td>
            <td>${formatDate(pred.created_at)}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary" onclick="showPredictionDetail(${
                  pred.id
                })">
                    <i class="fas fa-eye"></i> View
                </button>
            </td>
        </tr>
        `;
    })
    .join("");

  renderPagination(filteredData.length);
}

function renderPagination(totalRows) {
  const paginationContainer = document.getElementById("pagination");
  const totalPages = Math.ceil(totalRows / rowsPerPage);

  if (totalPages <= 1) {
    paginationContainer.innerHTML = "";
    return;
  }

  let buttons = `
        <button class="btn btn-sm btn-secondary me-2" 
            onclick="changePage(${currentPage - 1})" 
            ${currentPage === 1 ? "disabled" : ""}>
            Prev
        </button>
    `;

  const visiblePages = 3; // Number of pages to show at the start

  // Show first 3 pages
  for (let i = 1; i <= Math.min(visiblePages, totalPages); i++) {
    buttons += `
            <button class="btn btn-sm ${
              i === currentPage ? "btn-primary" : "btn-outline-primary"
            } me-1" 
                onclick="changePage(${i})">
                ${i}
            </button>
        `;
  }

  // Add ellipsis if there are more pages
  if (totalPages > visiblePages + 1) {
    buttons += `<span class="mx-1">...</span>`;
  }

  // Show last page if totalPages > visiblePages
  if (totalPages > visiblePages) {
    buttons += `
            <button class="btn btn-sm ${
              currentPage === totalPages ? "btn-primary" : "btn-outline-primary"
            } me-1" 
                onclick="changePage(${totalPages})">
                ${totalPages}
            </button>
        `;
  }

  buttons += `
        <button class="btn btn-sm btn-secondary ms-2" 
            onclick="changePage(${currentPage + 1})" 
            ${currentPage === totalPages ? "disabled" : ""}>
            Next
        </button>
    `;

  paginationContainer.innerHTML = buttons;
}

function changePage(page) {
  const totalPages = Math.ceil(predictionsData.length / rowsPerPage);
  if (page < 1 || page > totalPages) return;
  currentPage = page;
  loadPredictionsTable();
}

function showPredictionDetail(predictionId) {
  const prediction = predictionsData.find((p) => p.id === predictionId);
  if (!prediction) return;

  const modal = document.getElementById("predictionDetailModal");
  const content = document.getElementById("predictionDetailContent");

  content.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <h6>Personal Information</h6>
                <p><strong>Name:</strong> ${prediction.name}</p>
                <p><strong>Profession:</strong> ${prediction.profession}</p>
                <p><strong>Location:</strong> ${prediction.city}, ${
    prediction.country
  }</p>
                <p><strong>Skills:</strong> ${prediction.skills}</p>
            </div>
            <div class="col-md-6">
                <h6>Salary Information</h6>
                <p><strong>Current Salary:</strong> ${formatCurrency(
                  prediction.current_salary,
                  prediction.currency || "USD"
                )}</p>
                <p><strong>Predicted Salary:</strong> <span class="text-success fw-bold">${formatCurrency(
                  prediction.predicted_salary,
                  prediction.currency || "USD"
                )}</span></p>
                <p><strong>Confidence:</strong> ${Math.round(
                  (prediction.confidence_level || 0.6) * 100
                )}%</p>
                <p><strong>Method:</strong> ${
                  (prediction.confidence_level || 0.6) > 0.7
                    ? "🤖 Groq AI Analysis"
                    : "📊 Market Data"
                }</p>
                <p><strong>Increase:</strong> <span class="text-success">+${(
                  (prediction.predicted_salary / prediction.current_salary -
                    1) *
                  100
                ).toFixed(1)}%</span></p>
            </div>
        </div>
        
        <div class="mt-4">
            <h6>Future Scope</h6>
            <p>${prediction.future_scope}</p>
        </div>
        
        <div class="mt-4">
            <h6>Recommended Courses</h6>
            <div class="row">
                ${prediction.recommended_courses
                  .map(
                    (course) => `
                    <div class="col-md-6 mb-2">
                        <div class="card">
                            <div class="card-body p-3">
                                <i class="fas fa-graduation-cap text-primary me-2"></i>
                                ${course}
                            </div>
                        </div>
                    </div>
                `
                  )
                  .join("")}
            </div>
        </div>
    `;

  const modalInstance = new bootstrap.Modal(modal);
  modalInstance.show();
}

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

function formatDate(dateString) {
  const date = new Date(dateString);
  return (
    date.toLocaleDateString() +
    " " +
    date.toLocaleTimeString([], { hour: "2-digit", minute: "2-digit" })
  );
}

function logout() {
  localStorage.removeItem("user_id");
  localStorage.removeItem("is_admin");
  localStorage.removeItem("token");
  window.location.href = "https://www.theiotacademy.co/salary-predictor";
}
// Add search functionality
function searchUsers(query) {
  const filteredUsers = usersData.filter(
    (user) =>
      user.username.toLowerCase().includes(query.toLowerCase()) ||
      user.email.toLowerCase().includes(query.toLowerCase())
  );

  const tbody = document.querySelector("#usersTable tbody");
  tbody.innerHTML = filteredUsers
    .map(
      (user) => `
        <tr>
            <td>${user.id}</td>
            <td>${user.username}</td>
            <td>${user.email}</td>
            <td>
                <span class="badge ${
                  user.is_admin ? "bg-danger" : "bg-success"
                }">
                    ${user.is_admin ? "Admin" : "User"}
                </span>
            </td>
            <td>${formatDate(user.created_at)}</td>
        </tr>
    `
    )
    .join("");
}

function searchPredictions(query) {
  const filteredPredictions = predictionsData.filter(
    (pred) =>
      pred.name.toLowerCase().includes(query.toLowerCase()) ||
      pred.profession.toLowerCase().includes(query.toLowerCase()) ||
      pred.country.toLowerCase().includes(query.toLowerCase())
  );

  const tbody = document.querySelector("#predictionsTable tbody");
  tbody.innerHTML = filteredPredictions
    .map(
      (pred) => `
        <tr>
            <td>${pred.id}</td>
            <td>${pred.name}</td>
            <td>${pred.profession}</td>
            <td>${formatCurrency(pred.current_salary, pred.currency)}</td>
            <td class="text-success fw-bold">${formatCurrency(
              pred.predicted_salary,
              pred.currency
            )}</td>
            <td>${pred.country}</td>
            <td>${formatDate(pred.created_at)}</td>
            <td>
                <button class="btn btn-sm btn-outline-primary" onclick="showPredictionDetail(${
                  pred.id
                })">
                    <i class="fas fa-eye"></i> View
                </button>
            </td>
        </tr>
    `
    )
    .join("");
}

// Add export functionality
function exportData(type) {
  let data, filename, contentType;

  if (type === "users") {
    data = usersData;
    filename = "users_data.json";
    contentType = "application/json";
  } else if (type === "predictions") {
    data = predictionsData;
    filename = "predictions_data.json";
    contentType = "application/json";
  }

  const blob = new Blob([JSON.stringify(data, null, 2)], { type: contentType });
  const url = window.URL.createObjectURL(blob);
  const a = document.createElement("a");
  a.href = url;
  a.download = filename;
  a.click();
  window.URL.revokeObjectURL(url);
}

// Add refresh functionality
function refreshData() {
  loadDashboardData();

  // Show loading indicator
  const refreshBtn = document.querySelector('[onclick="refreshData()"]');
  if (refreshBtn) {
    const originalText = refreshBtn.innerHTML;
    refreshBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    refreshBtn.disabled = true;

    setTimeout(() => {
      refreshBtn.innerHTML = originalText;
      refreshBtn.disabled = false;
    }, 2000);
  }
}

// Add keyboard shortcuts for admin
document.addEventListener("keydown", function (e) {
  // Ctrl/Cmd + R to refresh
  if ((e.ctrlKey || e.metaKey) && e.key === "r") {
    e.preventDefault();
    refreshData();
  }

  // Ctrl/Cmd + U to export users
  if ((e.ctrlKey || e.metaKey) && e.key === "u") {
    e.preventDefault();
    exportData("users");
  }

  // Ctrl/Cmd + P to export predictions
  if ((e.ctrlKey || e.metaKey) && e.key === "p") {
    e.preventDefault();
    exportData("predictions");
  }
});

// Add auto-refresh every 5 minutes
setInterval(refreshData, 5 * 60 * 1000);
