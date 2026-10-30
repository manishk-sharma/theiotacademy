<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Seed Fund Program | The IoT Academy</title>
  <meta property="og:image" content="https://www.theiotacademy.co/assets/dit/images/logo.webp" />
   <!-- Icons -->
    <link rel="icon" href="https://www.theiotacademy.co/assets/images/favicon-32x32.webp" type="image/webp"
        sizes="32x32">
    <link rel="apple-touch-icon" href="https://www.theiotacademy.co/assets/images/favicon-32x32.webp" />

    <!-- Preconnect and DNS Prefetch -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://www.theiotacademy.co/assets/dit/css/custom.css" rel="stylesheet">
  <link href="https://www.theiotacademy.co/assets/dit/css/seed-fund-program.css" rel="stylesheet">
  <!--swiper css links-->
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" media="print"
        onload="this.onload=null;this.media='all'">
        
</head>
<body>
<?php $this->load->view("commons/inc/new-header.php") ?>
<!-- Hero Section -->
<section class="pt-5 text-center py-5 sbanner-mvp-class">
  <span class="badge bg-primary-subtle text-primary px-3 py-2 mb-3 fs-5">Empowering Innovation</span>
  <h1 class="display-5 fw-bold text-dark">Turn Your MVP into a 
    <span class="gradient-text">Market Success</span>
  </h1>
  <p class="lead text-secondary mx-auto" style="max-width:700px;">
    Get seed funding up to <strong class="text-dark">₹5 Lakhs</strong> to scale your innovative startup.  
    Exclusive for The IoT Academy learners and alumni with working MVPs.
  </p>
  <div class="mt-4 pb-4">
    <button class="btn btn-blue btn-lg me-3 btn-banner-apply-and-elg" onclick="showForm()">Apply for Funding <i class="bi bi-arrow-right ms-2"></i></button>
    <button class="btn btn-outline-secondary btn-lg btn-banner-apply-and-elg" onclick="scrollToSection('eligibility')">Check Eligibility</button>
  </div>
</section>

<!-- Stats Section -->
<section class="bg-white py-5">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-4 mb-4">
        <div class="bg-light rounded-circle d-inline-flex justify-content-center align-items-center mb-3" style="width:60px;height:60px;">
          <i class="bi bi-bullseye text-primary fs-4"></i>
        </div>
        <h3 class="fw-bold text-dark">₹5 Lakhs</h3>
        <p class="text-secondary">Maximum Funding</p>
      </div>
      <div class="col-md-4 mb-4">

        <div class="bg-light rounded-circle d-inline-flex justify-content-center align-items-center mb-3" style="width:60px;height:60px;">
          <i class="bi bi-people-fill text-info fs-4"></i>
        </div>
        <h3 class="fw-bold text-dark">6 Sectors</h3>
        <p class="text-secondary">High-Impact Domains</p>
      </div>
      <div class="col-md-4 mb-4">
        <div class="bg-light rounded-circle d-inline-flex justify-content-center align-items-center mb-3" style="width:60px;height:60px;">
          <i class="bi bi-rocket-takeoff-fill text-primary fs-4"></i>
        </div>
        <h3 class="fw-bold text-dark">MVP Ready</h3>
        <p class="text-secondary">Must Have Working Product</p>
      </div>
    </div>
  </div>
</section>

<!-- Eligibility -->
<section id="eligibility" class="py-5 container">
  <div class="text-center mb-5">
    <h2 class="section-title mb-3">Eligibility Criteria</h2>
    <p class="text-secondary">Make sure you meet these requirements before applying</p>
  </div>
  <div class="row g-4">
    <div class="col-md-4">
      <div class="card border-0 card-hover eligibility-crd">
        <div class="card-body text-center">
          <div class="bg-primary-subtle rounded-circle d-inline-flex justify-content-center align-items-center mb-3" style="width:50px;height:50px;">
            <i class="bi bi-mortarboard-fill text-primary fs-5"></i>
          </div>
          <h5>IoT Academy Connection</h5>
          <p class="text-secondary">Must be a current learner or alumni of The IoT Academy.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 card-hover eligibility-crd">
        <div class="card-body text-center">
          <div class="bg-info-subtle rounded-circle d-inline-flex justify-content-center align-items-center mb-3" style="width:50px;height:50px;">
            <i class="bi bi-check-circle-fill text-info fs-5"></i>
          </div>
          <h5>Working MVP</h5>
          <p class="text-secondary">Must have a functional MVP that demonstrates potential for growth.</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card border-0 card-hover eligibility-crd">
        <div class="card-body text-center">
          <div class="bg-primary-subtle rounded-circle d-inline-flex justify-content-center align-items-center mb-3" style="width:50px;height:50px;">
            <i class="bi bi-graph-up-arrow text-primary fs-5"></i>
          </div>
          <h5>Growth Potential</h5>
          <p class="text-secondary">Must aim for employment generation and scalability.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Funding Domains -->
<section class="bg-white py-5">
  <div class="container">
    <div class="text-center">
      <h2 class="section-title mb-3">Funding Domains</h2>
      <p class="text-secondary">We support innovations in these high-impact sectors</p>
    </div>
  </div>
  <div class="container py-5">
  <div class="row g-4">
    <div class="col-md-4">
      <div class="domain-card">
        <div class="icon-box"><i class="bi bi-coin"></i></div>
        <div class="domain-title">FinTech</div>
        <div class="domain-text">Financial technology and digital payment solutions</div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="domain-card">
        <div class="icon-box"><i class="bi bi-mortarboard"></i></div>
        <div class="domain-title">EdTech</div>
        <div class="domain-text">Educational technology and learning platforms</div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="domain-card">
        <div class="icon-box"><i class="bi bi-signpost-split-fill"></i></div>
        <div class="domain-title">AgriTech</div>
        <div class="domain-text">Agricultural technology and smart farming</div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="domain-card">
        <div class="icon-box"><i class="bi bi-building"></i></div>
        <div class="domain-title">Smart City Solutions</div>
        <div class="domain-text">Urban infrastructure and smart city technologies</div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="domain-card">
        <div class="icon-box"><i class="bi bi-truck"></i></div>
        <div class="domain-title">Smart Logistics</div>
        <div class="domain-text">Supply chain management and logistics optimization</div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="domain-card">
        <div class="icon-box"><i class="bi bi-cpu"></i></div>
        <div class="domain-title">Industry 4.0</div>
        <div class="domain-text">Digital transformation and industrial automation</div>
      </div>
    </div>
  </div>
</div>
</section>

<section class="process-section">
  <div class="container">
    <h2>Application Process</h2>
    <p>Follow these steps to secure your seed funding</p>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="process-card">
          <div class="process-icon"><i class="bi bi-file-earmark-text"></i></div>
          <div class="step-badge">Step 1</div>
          <div class="process-title">Submit Application</div>
          <div class="process-desc">Fill out the detailed application form with your MVP details</div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="process-card">
          <div class="process-icon"><i class="bi bi-search"></i></div>
          <div class="step-badge">Step 2</div>
          <div class="process-title">Initial Review</div>
          <div class="process-desc">Our team reviews your submission and MVP demonstration</div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="process-card">
          <div class="process-icon"><i class="bi bi-display"></i></div>
          <div class="step-badge">Step 3</div>
          <div class="process-title">Pitch Presentation</div>
          <div class="process-desc">Present your idea to our investment committee</div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="process-card">
          <div class="process-icon"><i class="bi bi-clipboard-check"></i></div>
          <div class="step-badge">Step 4</div>
          <div class="process-title">Due Diligence</div>
          <div class="process-desc">Technical and business validation of your startup</div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="process-card">
          <div class="process-icon"><i class="bi bi-graph-up-arrow"></i></div>
          <div class="step-badge">Step 5</div>
          <div class="process-title">Funding Decision</div>
          <div class="process-desc">Committee decides on funding amount up to ₹5 Lakhs</div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="process-card">
          <div class="process-icon"><i class="bi bi-wallet2"></i></div>
          <div class="step-badge">Step 6</div>
          <div class="process-title">Term Sheet & Funding</div>
          <div class="process-desc">Finalize agreement and receive seed funding</div>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Application Form (Hidden by default) -->
 <section id="application-form" class="py-5 bg-white d-none">
    <div class="form-container">
    <h4 class="mb-3">Seed Fund Application Form</h4>
    <p>Please provide detailed information about your startup and MVP.</p>

    <!-- Personal Information -->
     <form action="<?= base_url('LiveLead/seed_fund_submit_form');?>" method="post" id="seedFundForm">
    <h5 class="form-appli-h5">Personal Information</h5>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Full Name *</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required="true">
      </div>
      <div class="col-md-6">
        <label class="form-label">Email Address *</label>
        <input type="email" name="email" class="form-control" placeholder="yourname@example.com" required="true">
      </div>
      <div class="col-md-6">
        <label class="form-label">Phone Number *</label>
        <input type="tel" name="mobile" class="form-control" placeholder="+91 99999 99999" required="true">
      </div>
      <div class="col-md-6">
        <label class="form-label">LinkedIn / Portfolio ID</label>
        <input type="url" name="portfolio" class="form-control" placeholder="Enter profile link" required="true">
      </div>
    </div>

    <!-- Startup Information -->
    <h5 class="form-appli-h5">Startup Information</h5>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Startup Name *</label>
        <input type="text" name="startup_name" class="form-control" placeholder="Enter startup name" required="true">
      </div>
      <div class="col-md-6">
        <label class="form-label">Funding Stream *</label>
        <select class="form-select" name="funding_stream" required="true">
          <option selected disabled>Select domain</option>
          <option value="FinTech">FinTech</option>  
          <option value="EdTech">EdTech</option>  
          <option value="AgriTech">AgriTech</option>  
          <option value="Smart City Solutions">Smart City Solutions</option>  
          <option value="Smart Logistics">Smart Logistics</option>  
          <option value="Industry 4.0">Industry 4.0</option>
          <!-- <option value="HealthTech">HealthTech</option>
          <option value="Other">Other</option> -->
        </select>
      </div>
      <div class="col-12">
        <label class="form-label">Problem Statement *</label>
        <textarea class="form-control" name="problem_statement" rows="2" placeholder="Describe the problem your startup is solving..." required="true"></textarea>
      </div>
      <div class="col-12">
        <label class="form-label">Your Solution *</label>
        <textarea class="form-control" name="solution" rows="2" placeholder="Explain how your product/service solves this problem..." required="true"></textarea>
      </div>
      <div class="col-12">
        <label class="form-label">Technology Stack *</label>
        <input type="text" class="form-control" name="technology_stack" placeholder="e.g. React, Django, MongoDB, AWS etc." required="true">
      </div>
    </div>

    <!-- Team Information -->
    <h5 class="form-appli-h5">Team Information</h5>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Team Size *</label>
        <select class="form-select" name="team_size" required="true">
          <option selected disabled>Select team size</option>
          <option>1-3</option>
          <option>4-7</option>
          <option>8-10</option>
          <option>10+</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label">Team Expertise *</label>
        <input type="text" class="form-control" name="team_expertise" placeholder="e.g. AI, marketing, design, sales, etc." required="true">
      </div>
      <div class="col-12">
        <textarea class="form-control" rows="2" name="team_description" placeholder="Describe your team's expertise, background, and key skills..." required="true"></textarea>
      </div>
    </div>

    <!-- MVP Details -->
    <h5 class="form-appli-h5">MVP Details</h5>
    <div class="row g-3">
      <div class="col-12">
        <label class="form-label">MVP Description *</label>
        <textarea class="form-control" name="mvp_description" rows="2" placeholder="Describe your MVP: what it does, key features, current stage..." required="true"></textarea>
      </div>
      <div class="col-md-6">
        <label class="form-label">MVP Demo Link</label>
        <input type="url" class="form-control" name="mvp_url" placeholder="https://example.com/demo" required="true">
      </div>
    </div>

    <!-- Business Model -->
    <h5 class="form-appli-h5">Business Model & Scalability</h5>
    <div class="row g-3">
      <div class="col-12">
        <label class="form-label">Revenue Model *</label>
        <textarea class="form-control" name="revenue_model" rows="2" placeholder="Explain your revenue and pricing structure..." required="true"></textarea>
      </div>
      <div class="col-12">
        <label class="form-label">Target Market *</label>
        <textarea class="form-control" name="target_marketing" rows="2" placeholder="Who are your target customers? Market size and demographics..." required="true"></textarea>
      </div>
      <div class="col-12">
        <label class="form-label">Marketing Plan *</label>
        <textarea class="form-control" name="marketing_plan" rows="2" placeholder="How do you plan to acquire your first 100 users?" required="true"></textarea>
      </div>
      <div class="col-12">
        <label class="form-label">Employment Impact *</label>
        <textarea class="form-control" name="employment_impact" rows="2" placeholder="How will your startup generate employment opportunities?" required="true"></textarea>
      </div>
    </div>

    <!-- Funding Requirements -->
    <h5 class="form-appli-h5">Funding Requirements</h5>
    <div class="row g-3">
      <div class="col-md-6">
        <label class="form-label">Funding Amount Required *</label>
        <select class="form-select" name="funding_ammount" required="true">
          <option selected disabled>Select amount</option>
          <option>₹1-2 Lakhs</option>
          <option>₹2–3 Lakhs</option>
          <option>₹3–4 Lakhs</option>
          <option>₹4-5 Lakhs</option>
        </select>
      </div>
      <div class="col-12">
        <label class="form-label">Funding Utilization Plan *</label>
        <textarea class="form-control" name="funding_utilization" rows="2" placeholder="Provide a detailed breakdown of how you'll utilize the funding..." required="true"></textarea>
      </div>
    </div>

    <!-- Additional Info -->
    <h5 class="form-appli-h5">Additional Information</h5>
    <div class="mb-3">
      <label class="form-label">Any Additional Information</label>
      <textarea class="form-control" name="additional_information" rows="2" placeholder="Share any other relevant information about your startup..." required="true"></textarea>
    </div>
         
         <div id="formResponse" class="text-success my-2"></div>
         <div class="col-12 mt-4">
        <button type="submit" class="btn btn-blue btn-lg">Submit Application <i class="bi bi-check-circle ms-2"></i></button>
      </div>
      </form>
  </div>

 </section>

<!-- CTA Section -->
<section id="cta" class="py-5 text-center text-white mb-5" style="background:linear-gradient(to right,#2563eb,#06b6d4);">
  <div class="container">
    <h2 class="fw-bold mb-3 text-white">Ready to Scale Your Startup?</h2>
    <p class="lead mb-4 text-white">Don’t let funding be a barrier. Apply now and get the support you need.</p>
    <button class="btn application-btn-cls btn-lg" onclick="showForm()">Start Your Application <i class="bi bi-arrow-right ms-2"></i></button>
  </div>
</section>

<!--main body work end-->
    <?php $this->load->view("commons/inc/new-footer.php") ?>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <!--custom js-->
    <script defer src="https://www.theiotacademy.co/assets/dit/js/custom1.js"></script>

<script>
  document.getElementById('year').textContent = new Date().getFullYear();

  function scrollToSection(id) {
    document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });
  }

  function showForm() {
    document.getElementById('application-form').classList.remove('d-none');
    document.getElementById('application-form').scrollIntoView({ behavior: 'smooth' });
  }

  // Form submission simulation
  document.getElementById('fundForm').addEventListener('submit', function(e){
    e.preventDefault();
    document.getElementById('formAlert').classList.remove('d-none');
    this.reset();
  });
</script>

    <!--swiper js-->
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer>
        window.addEventListener("load", function() {
            const swiperContainer = document.querySelector(".scrollHeaderSwiper .swiper-wrapper");

            if (swiperContainer) {
                const slides = swiperContainer.querySelectorAll(".swiper-slide");

                if (slides.length < 4) {
                    const needed = 4 - slides.length;
                    const fragment = document.createDocumentFragment();
                    for (let i = 0; i < needed; i++) {
                        fragment.appendChild(slides[i % slides.length].cloneNode(true));
                    }
                    swiperContainer.appendChild(fragment); // Append once, reduce layout thrashing
                }

                // Wait for layout to settle before initializing Swiper
                requestAnimationFrame(() => {
                    const swiperHeader = new Swiper(".scrollHeaderSwiper", {
                        slidesPerView: "auto",
                        loop: true,
                        speed: 6000,
                        autoplay: {
                            delay: 0,
                            disableOnInteraction: false,
                        },
                        allowTouchMove: false,
                    });

                    const swiperEl = document.querySelector(".scrollHeaderSwiper");
                    swiperEl.addEventListener("mouseenter", () => swiperHeader.autoplay.stop());
                    swiperEl.addEventListener("mouseleave", () => swiperHeader.autoplay.start());
                });
            }

            // ===== Marquee Swiper =====
            const swiperContainer2 = document.querySelector(".marquee-container .swiper-wrapper");
            if (swiperContainer2) {
                const swiper2 = new Swiper(".mySwiper", {
                    slidesPerView: "auto",
                    loop: true,
                    speed: 2000,
                    autoplay: {
                        delay: 0,
                        disableOnInteraction: false,
                    },
                    allowTouchMove: false,
                });

                const swiperEl2 = document.querySelector(".mySwiper");
                swiperEl2.addEventListener("mouseenter", () => swiper2.autoplay.stop());
                swiperEl2.addEventListener("mouseleave", () => swiper2.autoplay.start());
            }
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
  
  $('#seedFundForm').on('submit', function(e) {
    e.preventDefault(); // Prevent normal form submit

    // Disable button & show loading
    const submitBtn = $('button[type="submit"]');
    submitBtn.prop('disabled', true).html('Submitting...');

    // Clear any previous messages
    $('#formResponse').html('');

    // Send AJAX
    $.ajax({
      url: $(this).attr('action'),
      method: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(response) {
        if (response.message === 'success') {
          $('#formResponse').html(`
            <div class="alert alert-success mt-3">
              <i class="bi bi-check-circle-fill me-2"></i>${response.response}
            </div>
          `);
          $('#seedFundForm')[0].reset();
        } else if (response.message === 'error') {
          $('#formResponse').html(`
            <div class="alert alert-warning mt-3">
              <i class="bi bi-exclamation-triangle-fill me-2"></i>${response.response}
            </div>
          `);
        } else {
          $('#formResponse').html(`
            <div class="alert alert-danger mt-3">
              <i class="bi bi-x-circle-fill me-2"></i>${response.response}
            </div>
          `);
        }
      },
      error: function() {
        $('#formResponse').html(`
          <div class="alert alert-danger mt-3">
            <i class="bi bi-x-circle-fill me-2"></i>Server error! Please try again later.
          </div>
        `);
      },
      complete: function() {
        submitBtn.prop('disabled', false).html('Submit Application <i class="bi bi-check-circle ms-2"></i>');
      }
    });
  });

});
</script>


</body>
</html>
