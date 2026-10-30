<?php
/**
 * Simple Thank You Confirmation Page (Without PDF)
 * File: application/views/thankyou_simple_page.php
 * Framework: CodeIgniter
 */

declare(strict_types=1);

// --- SECURITY & UTILITY FUNCTIONS ---
if (!function_exists('sanitize_val')) {
    function sanitize_val(mixed $data): string {
        return htmlspecialchars((string)($data ?? ''), ENT_QUOTES, 'UTF-8');
    }
}

$page_heading   = sanitize_val($_GET['heading'] ?? ($page_heading ?? 'Thank You for Your Interest!'));
$applicant_name = sanitize_val($_GET['name'] ?? ($applicant_name ?? ''));
$custom_message = sanitize_val($_GET['message'] ?? ($page_message ?? ''));
$current_page_url = current_url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $page_heading ?> | The IoT Academy</title>
    <meta name="description" content="Thank you for submitting your request to The IoT Academy. Our team will connect with you shortly.">
    <link rel="canonical" href="<?= $current_page_url ?>">
    <link rel="icon" href="<?= base_url('assets/images/iot-academy-favicon-32x32.png') ?>" type="image/x-icon">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Site CSS & Page Stylesheet -->
    <link href="<?= asset_url(); ?>dit/css/custom.css" rel="stylesheet">
    <link href="<?= base_url('assets/dit/css/thank-you.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="tia-thankyou-body">

    <!-- Top Navigation Header -->
    <?php $this->load->view("commons/inc/new-header.php") ?>

    <!-- Main Confirmation Content Area -->
    <main class="tia-confirmation-main" id="main-content">
        <div class="tia-simple-container">
            <div class="tia-simple-card">
                <div class="tia-simple-card-body">
                    <!-- Success Icon Badge -->
                    <div class="tia-simple-icon-circle" aria-hidden="true">
                        <i class="fas fa-check"></i>
                    </div>

                    <!-- Heading -->
                    <h1 class="tia-simple-title">
                        <?= !empty($applicant_name) ? 'Thank You for Your Interest, ' . $applicant_name . '!' : $page_heading ?>
                    </h1>

                    <!-- Message Body -->
                    <?php if (!empty($custom_message)): ?>
                        <p class="tia-simple-subtitle">
                            <?= $custom_message ?>
                        </p>
                    <?php else: ?>
                        <div class="tia-simple-message-block">
                            <p class="tia-simple-highlight">
                                Your information has been submitted successfully.
                            </p>
                            <p class="tia-simple-text">
                                Our team will connect with you shortly to guide you through the program details and answer any questions you may have.
                            </p>
                            <p class="tia-simple-tagline">
                                We look forward to being a part of your learning journey!
                            </p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Card Actions -->
                <div class="tia-simple-actions">
                    <a href="<?= base_url('ds-ml-ai-genai-by-eict-iitroorkee') ?>" class="tia-btn tia-btn-return-home">
                        Return to Program
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!--footer-->
    <?php $this->load->view("commons/inc/new-footer.php") ?>
    <!--bootstrap js-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <!-- PDF.js Library -->
    <script src="<?= base_url('assets/js/pdf.min.js') ?>"></script>
    <script>
        const tiaPdfWorkerUrl = '<?= base_url("assets/js/pdf.worker.min.js") ?>';
    </script>
    <!-- Page Interaction Script -->
    <script src="<?= base_url('assets/dit/js/thankyou.js') ?>"></script>
    <!--swiper js-->
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
   

    <script src="<?= asset_url(); ?>dit/js/placementpage_ajax.js"></script>
    <script>
        window.addEventListener("load", function () {
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
        });
    </script>
    <script>
        // Fallback for browsers that don’t support requestIdleCallback
        window.requestIdleCallback = window.requestIdleCallback || function (cb) {
            return setTimeout(cb, 1);
        };

        requestIdleCallback(() => {
            const swiperScript = document.createElement("script");
            swiperScript.src = "https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js";
            swiperScript.onload = () => {
                const configs = {
                    mySwiper2: 4,
                    // mySwiper3: 2,
                    // mySwiper4: 3,
                    mySwiper5: 4,
                    mySwiper6: 2,
                    mySwiper7: 2,
                };

                Object.entries(configs).forEach(([className, slidesView]) => {
                    new Swiper(`.${className}`, {
                        slidesPerView: slidesView,
                        spaceBetween: 30,
                        loop: true,
                        freeMode: true,
                        breakpoints: {
                            280: {
                                slidesPerView: 1,
                                spaceBetween: 10
                            },
                            320: {
                                slidesPerView: 1,
                                spaceBetween: 10
                            },
                            480: {
                                slidesPerView: 2,
                                spaceBetween: 10
                            },
                            768: {
                                slidesPerView: Math.max(2, slidesView - 1),
                                spaceBetween: 10,
                            },
                            1200: {
                                slidesPerView: slidesView,
                                spaceBetween: 10
                            },
                        },
                        autoplay: {
                            delay: 3500,
                            disableOnInteraction: true,
                            pauseOnMouseEnter: true,
                        },
                        navigation: {
                            nextEl: `.swiper-button-next${className.slice(-1)}`,
                            prevEl: `.swiper-button-prev${className.slice(-1)}`,
                        },
                        pagination: {
                            el: `.swiper-pagination${className.slice(-1)}`,
                            clickable: true,
                        },
                    });
                });
            };
            document.body.appendChild(swiperScript);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const cards = document.querySelectorAll(".testimonial-card");

            cards.forEach((card) => {
                const text = card.querySelector(".testimonial-text");
                const btn = card.querySelector(".read-more-btn");
                setTimeout(() => {
                    const isClamped = text.scrollHeight > text.clientHeight;

                    if (!isClamped) {
                        btn.style.display = "none";
                    }
                }, 100);

                btn.addEventListener("click", () => {
                    text.classList.toggle("expanded");
                    btn.textContent = text.classList.contains("expanded") ?
                        "Read less" :
                        "Read more";
                });
            });
        });
    </script>
    <script>
        const container = document.getElementById('recruiter-container');
        for (let i = 1; i <= 30; i++) {
            const div = document.createElement('div');
            div.className = 'col-lg-2 col-md-4 d-flex align-items-center justify-content-center py-3';
            const img = document.createElement('img');
            img.src = `<?php echo asset_url(); ?>dit/images/our-placements/recruiters/${i}.webp`;
            img.alt = `recruiter ${i}`;
            img.className = 'img-fluid';
            img.width = 150;
            img.height = 80;
            img.loading = 'lazy';
            div.appendChild(img);
            container.appendChild(div);
        }
    </script>
</body>
</html>
