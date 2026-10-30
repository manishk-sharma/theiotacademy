<?php
/**
 * Brochure Download Confirmation Page (Thank You Page)
 * Pixel-accurate implementation matching reference design (image_4.png)
 * 
 * Framework: CodeIgniter (PHP 8.x)
 */

declare(strict_types=1);

// --- SECURITY & UTILITY FUNCTIONS ---
function sanitize_val(mixed $data): string {
    return htmlspecialchars((string)($data ?? ''), ENT_QUOTES, 'UTF-8');
}

function validate_doc_target(?string $url, string $fallback): string {
    if (empty($url)) {
        return $fallback;
    }
    $sanitized = filter_var($url, FILTER_SANITIZE_URL);
    return is_string($sanitized) && !empty($sanitized) ? $sanitized : $fallback;
}

// --- ALLOWED BROCHURE CATALOG (Mapped to real server files) ---
$brochure_catalog = [
    'dsml' => [
        'title'         => 'Professional Program In Data Science, Machine Learning, AI & GenAI',
        'type'          => 'Program Brochure',
        'format'        => 'PDF',
        'rel_path'      => 'assets/pdf/dsml-10months/10_months_new_brochure.pdf',
        'download_name' => 'Data_Science_Machine_Learning_AI_GenAI_Brochure.pdf',
        'pages'         => 12
    ],
    'ds_iitr' => [
        'title'         => 'Applied Data Science and Machine Learning with Python',
        'type'          => 'Program Brochure',
        'format'        => 'PDF',
        'rel_path'      => 'assets/data-science-program-by-eict-academy-iit-roorkee/brochure.pdf',
        'download_name' => 'Data_Science_Program_IIT_Roorkee_Brochure.pdf',
        'pages'         => 16
    ],
    'genai' => [
        'title'         => 'Data Analytics and Generative AI Program',
        'type'          => 'Program Brochure',
        'format'        => 'PDF',
        'rel_path'      => 'assets/pdf/genai-6months/Data_Analytics_Generative_AI_Brochure.pdf',
        'download_name' => 'Data_Analytics_Generative_AI_Brochure.pdf',
        'pages'         => 12
    ]
];

// Capture requested brochure key
$brochure_key = sanitize_val($_GET['brochure'] ?? 'dsml');
if (!isset($brochure_catalog[$brochure_key])) {
    $brochure_key = 'dsml';
}
$selected_brochure = $brochure_catalog[$brochure_key];

// Fallback or explicit query params
$default_title   = $selected_brochure['title'];
$default_type    = $selected_brochure['type'];
$default_format  = $selected_brochure['format'];
$default_pdf_url = base_url($selected_brochure['rel_path']);
$default_pages   = $selected_brochure['pages'];

// Optional: Retrieve course title from database if course_id is supplied
if (!empty($_GET['course_id']) && isset($this->db)) {
    $cid = (int)$_GET['course_id'];
    $query = $this->db->select('course_title')->where('course_id', $cid)->limit(1)->get('courses');
    if ($query && $query->num_rows() > 0) {
        $default_title = $query->row()->course_title;
    }
}

// Final sanitized values
$document_title   = sanitize_val($_GET['title'] ?? $default_title);
$document_type    = sanitize_val($_GET['type'] ?? $default_type);
$document_format  = sanitize_val($_GET['format'] ?? $default_format);
$document_pdf_url = validate_doc_target($_GET['pdf_url'] ?? null, $default_pdf_url);
$document_pages   = max(1, (int)($_GET['pages'] ?? $default_pages));
$download_action  = site_url('download-brochure?brochure=' . urlencode($brochure_key));
$current_page_url = current_url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Placement After Certification Courses</title>
    <meta name="description"
        content="Discover real success stories of job placement after certification courses at The IoT Academy. Explore how our students launched careers across top tech companies!" />
    <meta name="keywords"
        content="Job placement after certification courses, Best placement record institute, Placement training institute" />
    <meta name="subject" content="https://www.theiotacademy.co/our-placements">
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="yahooSeeker" content="index, follow" />
    <meta name="msnbot" content="index, follow" />
    <meta name="copyright" content="The IoT Academy">
    <meta name="Revisit-after" content="1 Days" />
    <meta name="Classification" content="Education/Training">
    <meta name="author" content="The IoT Academy, info@theiotacademy.co">
    <meta name="owner" content="Kaushal">
    <meta name="url" content="https://www.theiotacademy.co/">
    <meta name="identifier-URL" content="https://www.theiotacademy.co/">
    <link rel="canonical" href="https://www.theiotacademy.co/our-placements">
    <meta name="directory" content="submission">
    <meta name="category" content="Training/Education">
    <meta name="coverage" content="Worldwide">
    <meta name="distribution" content="Global">
    <meta name="rating" content="General">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link rel="apple-touch-icon" href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png">
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta name="og:email" content="info@theiotacademy.co" />
    <meta name="og:phone_number" content="9354068856" />
    <meta property="og:site_name" content="theiotacademy" />
    <meta property="og:url" content="https://www.theiotacademy.co/our-placements" />
    <meta property="og:title" content="Job Placement After Certification Courses" />
    <meta property="og:description"
        content="Discover real success stories of job placement after certification courses at The IoT Academy. Explore how our students launched careers across top tech companies!" />
    <meta property="og:image" content="https://www.theiotacademy.co/assets/images/the-iot-logo-new.webp" />
    <meta property="og:image:type" content="webp" />
    <meta property="og:image:alt" content="The IoT Academy" />
    <meta property="og:ttl" content="345600" />
    <meta name="og:latitude" content="28.620764" />
    <meta name="og:longitude" content="77.363930" />
    <meta name="og:street-address" content="Block C-56/11, Sector-62, Noida, Near Stellar IT Park" />
    <meta name="og:locality" content="Noida Sector 62" />
    <meta name="og:region" content="Noida" />
    <meta name="og:postal-code" content="201301" />
    <meta name="og:country-name" content="India" />
    <meta name="fb:page_id" content="426804161019130" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@academyforiot" />
    <meta name="twitter:creator" content="@academyforiot" />
    <meta name="geo.region" content="IN-UP" />
    <meta name="geo.position" content="28.613207;77.372733" />
    <meta name="ICBM" content="28.613207, 77.372733" />
    <meta name="google-site-verification" content="C9Cq_KXvbhDfCA8PO4rSqFevR_ebDyX4_y8iuj4">
    <meta name="msvalidate.01" content="B59ACA364606E77DFA470E8E79DBC20A" />
    <link rel="preconnect" href="https://api.whatsapp.com" crossorigin>
    <link rel="preconnect" href="https://web.whatsapp.com" crossorigin>
    <link rel="icon" href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png"
        type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
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
    <link rel="preconnect" href="https://embed.tawk.to" crossorigin>
    <link rel="preload" href="https://embed.tawk.to/64ec8dbba91e863a5c103e35/1h8u0j9ph" as="script">
    <link rel="preconnect" href="https://api.whatsapp.com" crossorigin>
    <link rel="preconnect" href="https://web.whatsapp.com" crossorigin>
    <link rel="preload" as="image" type="image/svg"
        href="https://www.theiotacademy.co/assets/dit/images/navbar/logo.svg">
    <link rel="preload" as="image" type="image/webp" href="images/java-certification-course/banner-image.webp">
    <!--font family-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="preload" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!--css links-->
    <link href="<?php echo asset_url(); ?>dit/css/custom.css" rel="stylesheet">
    <!-- Page Specific Stylesheet -->
    <link href="<?= base_url('assets/dit/css/thank-you.css') ?>" rel="stylesheet">
    <!--bootstrap links-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="preload"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"
        as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" media="print"
        onload="this.onload=null;this.media='all'">
    <style>
        @font-face {
            font-display: swap;
            font-family: Nunito, sans-serif;
            font-weight: normal;
            font-style: normal
        }
    </style>
    
</head>
<body class="tia-thankyou-body">

       <?php $this->load->view("commons/inc/new-header.php") ?>
    

        <!-- =========================================================
             1. MAIN CONFIRMATION CONTENT AREA
             ========================================================= -->
        <main class="tia-confirmation-main" id="main-content">
            <div class="tia-confirmation-container">
                <!-- Page Main Heading -->
                <div class="tia-confirmation-header">
                    <h1 class="tia-main-title">
                        Thank You for Your Interest!
                        <span class="tia-checkmark-badge" aria-label="Confirmed checkmark">✔</span>
                    </h1>
                    <p class="tia-subtitle">
                        Feel free to download or browse the curriculum below.
                    </p>
                </div>

                <!-- Two-Column Main Layout -->
                <section class="tia-two-column-layout" aria-label="Brochure information card and interactive PDF preview">
                    <!-- Left Column: What's Next? -->
                    <aside class="tia-details-column">
                        <!-- <h2 class="tia-column-heading">What's Next?</h2> -->

                        <div class="tia-brochure-card">
                            <div class="tia-card-content">
                                <h3 class="tia-program-title"><?= $document_title ?></h3>

                                <div class="tia-metadata-list">
                                    <p class="tia-metadata-item">
                                        <strong>Document:</strong> <?= $document_type ?>
                                    </p>
                                    <p class="tia-metadata-item">
                                        <strong>Format:</strong> <?= $document_format ?>
                                    </p>
                                </div>
                            </div>

                            <div class="tia-card-actions">
                                <a href="<?= $download_action ?>" class="tia-btn tia-btn-download" download="<?= $selected_brochure['download_name'] ?>" id="btnDownloadBrochure">
                                    <span>Download Brochure</span>
                                    <svg class="tia-download-icon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                        <polyline points="7 10 12 15 17 10"></polyline>
                                        <line x1="12" y1="15" x2="12" y2="3"></line>
                                    </svg>
                                </a>

                                <a href="<?= base_url() ?>" class="tia-btn tia-btn-return-home">
                                    Return to Home
                                </a>
                            </div>
                        </div>
                    </aside>

                    <!-- Right Column: Brochure Preview -->
                    <article class="tia-preview-column">
                        <h2 class="tia-column-heading">Brochure Preview</h2>

                        <div class="tia-pdf-preview-card" id="tiaPdfPreviewCard">
                            <!-- PDF Toolbar -->
                            <div class="tia-pdf-toolbar">
                                <button type="button" class="tia-toolbar-title-btn" id="tiaToggleViewBtn" onclick="openPdfFullPage('<?= $document_pdf_url ?>')" title="Click to open brochure in full page" aria-label="Open PDF in full page">
                                    <span>PDF View</span>
                                    <i class="fas fa-external-link-alt" style="font-size: 11px; margin-left: 5px; opacity: 0.85;"></i>
                                </button>

                                <div class="tia-pdf-toolbar-right">
                                    <a href="<?= $download_action ?>" class="tia-toolbar-action" download="<?= $selected_brochure['download_name'] ?>" title="Download PDF">
                                        <i class="fas fa-download tia-toolbar-icon"></i>
                                        <span>Download PDF</span>
                                    </a>

                                    <button type="button" class="tia-toolbar-action" onclick="handlePrint('<?= $document_pdf_url ?>')" title="Print Brochure">
                                        <i class="fas fa-print tia-toolbar-icon"></i>
                                        <span>Print</span>
                                    </button>

                                    <button type="button" class="tia-toolbar-action" onclick="handleShare('<?= addslashes($document_title) ?>', '<?= $current_page_url ?>')" title="Share Brochure">
                                        <i class="fas fa-share-nodes tia-toolbar-icon"></i>
                                        <span>Share</span>
                                    </button>

                                    <div class="tia-toolbar-separator" aria-hidden="true"></div>

                                    <span class="tia-page-indicator" id="tiaPageIndicator">
                                        Page <span id="tiaCurrentPage">1</span> of <span id="tiaTotalPages"><?= $document_pages ?></span>
                                    </span>
                                </div>
                            </div>

                            <!-- PDF Viewport with Continuous Scroll & Real-Time Sync -->
                            <div class="tia-pdf-viewport" id="tiaPdfViewport" data-pdf-url="<?= $document_pdf_url ?>" role="region" aria-label="Brochure PDF Viewer" tabindex="0">
                                <div class="tia-pdf-canvas-container" id="tiaPdfCanvasContainer">
                                    <div class="tia-pdf-loading-indicator" id="tiaPdfLoading">
                                        <i class="fas fa-spinner fa-spin"></i> Loading brochure...
                                    </div>
                                </div>
                                <noscript>
                                    <iframe src="<?= $document_pdf_url ?>#toolbar=0&navpanes=0&scrollbar=1" class="tia-embedded-pdf-frame" title="Brochure PDF Document"></iframe>
                                </noscript>
                            </div>
                        </div>
                    </article>
                </section>
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