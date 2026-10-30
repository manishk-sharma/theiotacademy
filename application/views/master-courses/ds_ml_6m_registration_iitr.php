<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Application form -  Advanced Certification In Data Science And Machine Learning Course</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="preconnect" href="https://api.whatsapp.com" crossorigin>
    <link rel="preconnect" href="https://web.whatsapp.com" crossorigin>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon"
            href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png"
            type="image/png" />
    
    <!--preconnect-->
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com" />
    <link rel="dns-prefetch" href="//fonts.googleapis.com" />
    <link rel="preconnect" href="https://cdn.jsdelivr.net" />
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net" />
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" />
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com" />
    <link rel="preconnect" href="https://www.googletagmanager.com" />
    <link rel="dns-prefetch" href="https://www.googletagmanager.com" />
    <link rel="preconnect" href="https://api.whatsapp.com" crossorigin>
    <link rel="preconnect" href="https://web.whatsapp.com" crossorigin>
    <link rel="preload" as="image" href="https://www.theiotacademy.co/assets/dit/images/navbar/logo.svg">
    <!--font family-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!--css links-->
    <link href="https://www.theiotacademy.co/assets/dit/css/custom.css" rel="stylesheet">
    <link href="https://www.theiotacademy.co/assets/dit/css/apply-now-9m-dsmlai.css" rel="stylesheet">
    <!--bootstrap links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="preload" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <style>
    @font-face {
        font-display: swap;
        font-family: Nunito, sans-serif;
        font-weight: normal;
        font-style: normal
    }
    </style>
</head>
<body>
<?php $this->load->view("commons/inc/new-header.php")?>

<!--main body work start , css data-science name-->
<section class="banner" style="background: radial-gradient(circle, rgba(190, 189, 199, 1) 76%, rgb(0 86 172) 100%);">
    <div class="container-fluid">
        <div class="d-flex flex-wrap gap-2 gap-lg-2 text-start justify-content-start align-items-center col-lg-7 pt-3">
            <h1 class="heading m-0 ">Application Form</h1>
            <img src="https://www.theiotacademy.co/assets/dit/images/home/iitroorkee-logo-sm.webp" alt="roorkee logo" style="max-height:100px;" loading="lazy" class="img-fluid">
        </div>
        <div class="row justify-content-center gy-4">
            <div class="col-lg-7 col-md-12">
                <form method="post" id="SubmitMlRegistrationForm" onsubmit="return false">
                <input type="hidden" name="url_ml_iot_name" value="">
                <input type="hidden" name="came_from_course" value="9 Months DS, ML and AI By IIT Guwahati">
                    <div class="part">
                        <div class="head">Personal Details</div>
                        <div class="form-group">
                            <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Enter Your Name*">
                        </div>
                        <div class="form-group">
                            <input type="tel" name="mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" minlength="10" maxlength="11" class="form-control" id="mobile" placeholder="Enter Your Mobile Number*">
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email Address*">
                        </div>
                    </div>
        
                    <div class="part">
                        <div class="head">Professional Details</div>
                        <div class="form-group">
                            <select name="degree" id="degree" class="form-select">
                                <option value="" selected>Select Degree</option>
                                <option value="B.E./B.Tech.">B.E./B.Tech.</option>
                                <option value="B.Com/B.Com-Hons." >B.Com./B.Com.(Hons.)</option>
                                <option value="B.Sc/B.Sc-Hons." >B.Sc./B.Sc.(Hons.)</option>
                                <option value="B.C.A./B.C.A-Hons" >B.C.A./B.C.A.(Hons.)</option>
                                <option value="B.A./B.A-Hons." >B.A./B.A.(Hons.)</option>
                                <option value="BBA/BBM/BMS" >BBA/BBM/BMS</option>
                                <option value="B.Ed/M.Ed">B.Ed/M.Ed</option>
                                <option value="B.Pharma" >B.Pharma</option>
                                <option value="mtech">M.Tech</option>
                                <option value="MBA">MBA</option>
                                <option value="MCA">MCA</option>
                                <option value="M.Com">M.Com</option>
                                <option value="PhD">PhD</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="experience" id="experience" class="form-select">
                                <option value="">---Select Work Experience---</option>
                                <option value="College Student">College Student</option>
                                <option value="0-5 Years">0-5 Years</option>
                                <option value="5-10 Years" >5-10 Years</option>
                                <option value="10-15 Years" >10-15 Years</option>
                                <option value="More Than 15 Years" >More Than 15 Years</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="industry" id="industry" class="form-select">
                                <option value="">---Select Industry---</option>
                                <option value="Automobile">Automobile</option>
                                <option value="Banking/Finance">Banking/Finance </option>
                                <option value="Consulting">Consulting</option>
                                <option value="Education">Education</option>
                                <option value="Energy">Energy</option>
                                <option value="Government">Government</option>
                                <option value="Recruitment">Recruitment</option>
                                <option value="IT & Technology" >IT & Technology</option>
                                <option value="Manufacturing" >Manufacturing</option>
                                <option value="Pharma/Healthcare" >Pharma/Healthcare</option>
                                <option value="Research" >Research</option>
                                <option value="Retail" >Retail</option>
                                <option value="Telecom" >Telecom</option>
                                <option value="Design" >Design</option>
                                <option value="Others" >Others</option>
                            </select>
                        </div>
                    </div>
        
                    <div class="part">
                        <div class="head">Statement of Purpose</div>
                        <p>Help the admissions committee to evaluate your cantididature. Please answer the following question. </p>
                        <div class="form-group">
                            <label for="exampleInputstatement">Why do you want to learn Data Science, Machine Learning, AI & GenAI? (Optional)</label>
                            <textarea name="statement" class="form-control" id="statement" style="resize: none; height:120px;" placeholder="Writing a statement of purpose and increase your chances of selection to the course (maximum 5000 characters)"></textarea>
                        </div>
                    </div>
        
                    <div class="part">
                        <div class="head">Upload Resume / CV</div>
                        <div class="form-group uploadfile">
                            <label for="exampleInputupload">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="26" viewBox="0 0 28 26" fill="none">
                                <path d="M7.51682 9.11257C9.0818 9.11257 10.3505 10.3812 10.3505 11.9462V17.8156C10.3505 18.6986 11.042 19.4137 11.894 19.4137H16.107C16.959 19.4137 17.6505 18.6987 17.6505 17.8156V11.9452C17.6505 10.3808 18.9187 9.11257 20.4832 9.11257C20.9525 9.11257 21.3743 8.82003 21.5547 8.37104C21.7333 7.92388 21.634 7.40694 21.3024 7.06365L14.8195 0.350877C14.3668 -0.116959 13.6333 -0.116959 13.1795 0.350877L6.69772 7.06365C6.3661 7.40694 6.26675 7.92299 6.44629 8.37104C6.62662 8.81915 7.04753 9.11257 7.51682 9.11257Z" fill="#020274"/>
                                <path d="M26.6078 12.3745C25.8396 12.3745 25.2165 13.0198 25.2165 13.8159V19.8429C25.2165 21.6483 23.7969 23.1171 22.0529 23.1171H5.94693C4.20302 23.1171 2.78439 21.6483 2.78439 19.8429V13.8159C2.78439 13.0198 2.16027 12.3745 1.39218 12.3745C0.623177 12.3745 0 13.0198 0 13.816V19.8429C0 23.2379 2.66775 26 5.94693 26H22.0529C25.3321 26 28 23.2379 28 19.8429V13.816C28 13.0198 27.3768 12.3745 26.6078 12.3745Z" fill="#020274"/>
                            </svg>
                            Drag & Drop or Choose file to upload <span>(only pdf, doc and docx having max size 2MB)</span></label>
                            <input type="file" name="resume" class="form-control" id="uploadfile">
                        </div>
                    </div>
        
                   <div class="form-group form-check">
                     <input type="checkbox" name="checkbox" class="form-check-input" id="Checkbox">
                     <label class="form-check-label" for="exampleCheck1">I hereby declare all the information provided is true to my knowledge.</label>
                   </div>
                   <div id="Successdvpp" class="alert alert-success alert-dismissible d-none text-center" role="alert">
                    <span id="SuccessAlert"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <div id="Errordvpp" class="alert alert-danger alert-dismissible d-none text-center" role="alert">
                    <span id="ErrorAlert"></span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                    <button type="submit" class="blue-btn">Submit Application</button>
                    
               </form>
            </div>
            <div class="col-lg-5 col-md-8">
                <div class="right-part">
                    <h2 class="head">Professional Program In Data Science & Machine Learning By E&ICT Academy, IIT Roorkee</h2>
                    <!--<p class="tagline">Application Deadline:<?php //$this->load->view("course-deadline-date/9m_ds_ml_and_ai_deadline")?></p>-->
                    <div class="seats">
                        <p>Scholarship Seats Left <span class="num">08</span></p>
                    </div>
                    <div class="head">Contact Us.</div>
                    <ul>
                        <li><a href="tel:+919354068856"><img src="<?=asset_url()?>dit/images/apply-now-9m-dsmlai/call.webp" alt="call icon" class="img-fluid" width="" height="" loading="lazy"> +91-9354068856</a></li>
                        <li><a href="mailto:"><img src="<?=asset_url()?>dit/images/apply-now-9m-dsmlai/mail.webp" alt="mail icon" class="img-fluid" width="" height="" loading="lazy"> admissions.eictiitr@theiotacademy.co</a> <span>in case of any queries</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!--main body work end-->


    
    <!--bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!--custom js-->
    <script src="https://www.theiotacademy.co/assets/dit/js/custom1.js"></script>
    <script>
        document.getElementById("SubmitMlRegistrationForm").addEventListener("submit", function(e) {
    e.preventDefault();
    
    document.querySelector("input[name='url_ml_iot_name']").value = window.location.href;
    const formUrl = '<?=base_url()?>Mlwithiotregistration/ml_with_iot_registration_submit_form';
    const formData = new FormData(this);
    
    document.getElementById("enqform-overlay").style.display = "block";
    
    fetch(formUrl, {
        method: "POST",
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === "error") {
            alert(removeTags(data.response));
            document.getElementById("enqform-overlay").style.display = "none";
        } else if (data.message === "success") {
            document.getElementById("SubmitMlRegistrationForm").reset();
            const successAlert = document.getElementById("SuccessAlert");
            const SuccessdsAlert = document.getElementById("Successdvpp");
            successAlert.innerHTML = data.response;
            SuccessdsAlert.classList.add("d-block");
            SuccessdsAlert.classList.remove("d-none");
            document.getElementById("enqform-overlay").style.display = "none";
        } else {
            const errorAlert = document.getElementById("ErrorAlert");
            const ErrordpcAlert = document.getElementById("Errordvpp");
            errorAlert.innerHTML = data.response;
            ErrordpcAlert.classList.add("d-block");
            ErrordpcAlert.classList.remove("d-none");
        }
    })
    .catch(error => console.error("Error:", error));
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

  </body>
</html>