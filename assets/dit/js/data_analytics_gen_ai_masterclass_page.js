/* =========================================
   Hero countdown timer
========================================= */
const MASTERCLASS_PAGE_SLUG = "data-analytics-gen-ai-masterclass";

const REGISTRATION_API = "/LiveLead/dagenaimasterclass";

/* =========================================
   MASTERCLASS DYNAMIC CONFIGURATION

   Add page-specific configuration above
========================================= */

let MASTERCLASS_CONFIG = null;

async function getMasterclassDate() {

    const response = await fetch(
        "/api/masterclass/date?page_slug=" +
        encodeURIComponent(MASTERCLASS_PAGE_SLUG),
        {
            method: "GET",
            cache: "no-store",
            credentials: "same-origin"
        }
    );

    if (!response.ok) {
        throw new Error(
            "Unable to fetch masterclass date"
        );
    }

    const data = await response.json();

    if (
        !data.success ||
        data.page_slug !== MASTERCLASS_PAGE_SLUG ||
        !data.formatted_date ||
        !data.date_time
    ) {
        throw new Error("Invalid masterclass configuration");
    }

    if (Number.isNaN(new Date(data.date_time).getTime())) {
        throw new Error("Invalid masterclass date");
    }

    MASTERCLASS_CONFIG = data;

    // Update all visible masterclass dates
    document.querySelectorAll("[data-masterclass-date]")
        .forEach(element => {

            element.textContent = data.formatted_date;

        });

    return data;
}


/* =========================================
   DYNAMIC HERO COUNTDOWN TIMER
========================================= */

(function () {

    const daysEl = document.getElementById("cd-days");
    const hoursEl = document.getElementById("cd-hours");
    const minutesEl = document.getElementById("cd-minutes");
    const secondsEl = document.getElementById("cd-seconds");

    let target = null;

    function pad(n) {
        return String(n).padStart(2, "0");
    }

    function update() {

        if (target === null) return;

        const diff = Math.max(0, target - Date.now());

        const days = Math.floor(diff / 86400000);

        const hours = Math.floor(
            (diff % 86400000) / 3600000
        );

        const minutes = Math.floor(
            (diff % 3600000) / 60000
        );

        const seconds = Math.floor(
            (diff % 60000) / 1000
        );

        const values = [
            [daysEl, pad(days)],
            [hoursEl, pad(hours)],
            [minutesEl, pad(minutes)],
            [secondsEl, pad(seconds)]
        ];

        values.forEach(([el, value]) => {

            if (el && el.textContent !== value) {
                el.textContent = value;
            }

        });
    }

    async function refreshCountdown() {

        try {

            const data = await getMasterclassDate();

            target = new Date(data.date_time).getTime();

            update();

        } catch (error) {

            console.error("Countdown Error:", error);

        }
    }

    refreshCountdown();

    // Update countdown every second
    setInterval(update, 1000);

    // Check dashboard date changes every 60 seconds
    setInterval(refreshCountdown, 60000);

})();


/* =========================================
   NAVBAR & COUNTDOWN STRIP
========================================= */

const navbar = document.getElementById("navbar");

const countdownStrip = document.getElementById("countdownStrip");

let lastY = 0;

window.addEventListener("scroll", () => {

    const y = window.scrollY;

    if (navbar) {

        navbar.classList.toggle("scrolled", y > 10);

        navbar.classList.toggle(
            "hide",
            y > lastY && y > navbar.offsetHeight
        );

    }

    lastY = y;

});


if (countdownStrip) {

    const triggerY =
        countdownStrip.getBoundingClientRect().top +
        window.scrollY;

    window.addEventListener(
        "scroll",
        () => {

            if (window.innerWidth <= 992) {

                if (countdownStrip.classList.contains("is-sticky")) {

                    countdownStrip.classList.remove("is-sticky");

                    countdownStrip.style.width = "";
                    countdownStrip.style.height = "";

                }

                return;
            }

            const shouldStick = window.scrollY > triggerY;

            if (
                shouldStick &&
                !countdownStrip.classList.contains("is-sticky")
            ) {

                const rect = countdownStrip.getBoundingClientRect();

                countdownStrip.style.width = rect.width + "px";
                countdownStrip.style.height = rect.height + "px";

                countdownStrip.classList.add("is-sticky");

            } else if (
                !shouldStick &&
                countdownStrip.classList.contains("is-sticky")
            ) {

                countdownStrip.classList.remove("is-sticky");

                countdownStrip.style.width = "";
                countdownStrip.style.height = "";

            }

        },
        { passive: true }
    );

}


/* =========================================
   SMOOTH SCROLL
========================================= */

document.querySelectorAll("[data-scroll-to]").forEach(btn => {

    btn.addEventListener("click", () => {

        const target = document.getElementById(
            btn.dataset.scrollTo
        );

        target?.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });

    });

});


/* =========================================
   TESTIMONIAL SLIDER
========================================= */

(function initSlider() {

    const track = document.getElementById("sliderTrack");

    if (!track) return;

    const slides = track.querySelectorAll(".slide");

    const dotsWrap = document.getElementById("sliderDots");

    const prev = document.querySelector(".slider-btn.prev");

    const next = document.querySelector(".slider-btn.next");

    if (!slides.length || !dotsWrap) return;

    let index = 0;

    slides.forEach((_, i) => {

        const b = document.createElement("button");

        b.setAttribute(
            "aria-label",
            "Go to slide " + (i + 1)
        );

        b.addEventListener("click", () => go(i));

        dotsWrap.appendChild(b);

    });

    const dots = dotsWrap.querySelectorAll("button");

    function go(i) {

        index = (i + slides.length) % slides.length;

        track.style.transform =
            `translateX(-${index * 100}%)`;

        dots.forEach((d, di) => {

            d.classList.toggle("active", di === index);

        });

    }

    prev?.addEventListener("click", () => go(index - 1));

    next?.addEventListener("click", () => go(index + 1));

    go(0);

    setInterval(() => go(index + 1), 5000);

})();


/* =========================================
   FAQ ACCORDION
========================================= */

document.querySelectorAll(".acc-head").forEach(head => {

    head.addEventListener("click", () => {

        head.parentElement.classList.toggle("open");

    });

});


/* =========================================
   REVEAL ON SCROLL
========================================= */

const revealEls = document.querySelectorAll(".reveal");

if ("IntersectionObserver" in window) {

    const io = new IntersectionObserver(
        entries => {

            entries.forEach(e => {

                if (e.isIntersecting) {

                    e.target.classList.add("visible");

                    io.unobserve(e.target);

                }

            });

        },
        { threshold: 0.12 }
    );

    revealEls.forEach(el => io.observe(el));

} else {

    revealEls.forEach(el => el.classList.add("visible"));

}


/* =========================================
   BACK TO TOP
========================================= */

const backBtn = document.getElementById("backToTop");

if (backBtn) {

    window.addEventListener("scroll", () => {

        backBtn.classList.toggle(
            "show",
            window.scrollY > 400
        );

    });

    backBtn.addEventListener("click", () => {

        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });

    });

}


/* =========================================
   REGISTRATION FORM 1 & FORM 2
========================================= */

document.addEventListener("DOMContentLoaded", function () {

    const formIds = [
        "registerForm",
        "registerForm2"
    ];

    const urlParams = new URLSearchParams(
        window.location.search
    );

    const utmFields = [
        "utm_source",
        "utm_medium",
        "utm_campaign",
        "utm_term",
        "utm_content",
        "adset_name",
        "ad_name",
        "utm_id"
    ];

    formIds.forEach(function(formId) {

        const registerForm = document.getElementById(formId);

        if (!registerForm) return;

        registerForm.addEventListener(
            "submit",
            async function(e) {

                e.preventDefault();

                const submitBtn = registerForm.querySelector(
                    'button[type="submit"]'
                );

                if (!submitBtn || submitBtn.disabled) return;

                const originalButtonText = submitBtn.innerText;

                submitBtn.disabled = true;

                submitBtn.innerText = "Registering...";

                try {

                    // Fetch latest date from dashboard API
                    const masterclass = await getMasterclassDate();

                    const formData = new FormData(registerForm);

                    // Form details
                    formData.set(
                        "form_name",
                        "Masterclass Registration Form"
                    );

                    // Landing page URL
                    formData.set(
                        "url_source",
                        window.location.href
                    );

              // UTM tracking
formData.set("utm_source", urlParams.get("utm_source") || "");
formData.set("utm_medium", urlParams.get("utm_medium") || "");
formData.set("utm_campaign", urlParams.get("utm_campaign") || "");
formData.set("utm_term", urlParams.get("utm_term") || "");
formData.set("utm_content", urlParams.get("utm_content") || "");
formData.set("utm_id", urlParams.get("utm_id") || "");

// Support BOTH:
// adset_name=xxx
// adset+name=xxx
let adsetName =
    urlParams.get("adset_name") ||
    urlParams.get("adset name") ||
    "";

let adName =
    urlParams.get("ad_name") ||
    urlParams.get("ad name") ||
    "";

formData.set("adset_name", adsetName);
formData.set("ad_name", adName);

console.log("FULL URL:", window.location.href);
console.log("ADSET:", adsetName);
console.log("AD NAME:", adName);

                    // Batch
                    formData.set(
                        "batch",
                        "Upcoming Batch"
                    );

                    // Dynamic masterclass date
                    formData.set(
                        "masterclass_date_time",
                        masterclass.formatted_date
                    );

                    // Identify landing page
                    formData.set(
                        "page_slug",
                        MASTERCLASS_PAGE_SLUG
                    );

                    console.log("Form Data:");

                    for (const [key, value] of formData.entries()) {

                        console.log(key, value);

                    }

                    // Submit to existing backend
                    const response = await fetch(
                        REGISTRATION_API,
                        {
                            method: "POST",
                            body: formData,
                            credentials: "same-origin"
                        }
                    );

                    const responseText = await response.text();

                    let data;

                    try {

                        data = JSON.parse(responseText);

                    } catch (error) {

                        console.error(
                            "Invalid server response:",
                            responseText
                        );

                        throw new Error(
                            "Invalid server response."
                        );

                    }

                    if (!response.ok || data.message === "error") {

                        throw new Error(
                            data.response ||
                            "Registration failed. Please try again."
                        );

                    }

                    // Existing success page
                    window.location.href =
                        "/data-analytics-gen-ai-masterclass-registration-successfully";

                } catch (error) {

                    console.error("Registration Error:", error);

                    alert(
                        error.message ||
                        "Something went wrong. Please try again."
                    );

                } finally {

                    submitBtn.disabled = false;

                    submitBtn.innerText = originalButtonText;

                }

            }
        );

    });

});


/* =========================================
   POPUP MODAL
========================================= */

(function initPopup() {

    const popupOverlay = document.getElementById("popupOverlay");

    const popupClose = document.getElementById("popupClose");

    if (!popupOverlay) return;

    setTimeout(() => {

        popupOverlay.classList.add("show");

        document.body.style.overflow = "hidden";

    }, 2000);

    if (popupClose) {

        popupClose.addEventListener("click", closePopup);

    }

    popupOverlay.addEventListener("click", e => {

        if (e.target === popupOverlay) {

            closePopup();

        }

    });

    document.addEventListener("keydown", e => {

        if (
            e.key === "Escape" &&
            popupOverlay.classList.contains("show")
        ) {

            closePopup();

        }

    });

    function closePopup() {

        popupOverlay.classList.remove("show");

        document.body.style.overflow = "";

    }

})();
