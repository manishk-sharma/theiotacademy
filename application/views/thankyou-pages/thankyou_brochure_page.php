<?php
/**
 * Dedicated Brochure Thank You Confirmation Page
 * File: application/views/thankyou_brochure_page.php
 * Framework: CodeIgniter
 */

declare(strict_types=1);

// --- SECURITY & UTILITY FUNCTIONS ---
if (!function_exists('sanitize_val')) {
    function sanitize_val(mixed $data): string {
        return htmlspecialchars((string)($data ?? ''), ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('validate_doc_target')) {
    function validate_doc_target(?string $url, string $fallback): string {
        if (empty($url)) {
            return $fallback;
        }
        $sanitized = filter_var($url, FILTER_SANITIZE_URL);
        return is_string($sanitized) && !empty($sanitized) ? $sanitized : $fallback;
    }
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
    ],
    'ds_iitg' => [
        'title'         => 'Advanced Certification in Data Science, ML & AI by E&ICT Academy IIT Guwahati',
        'type'          => 'Program Brochure',
        'format'        => 'PDF',
        'rel_path'      => 'assets/coursesyllabus/ds-ml-and-ai-by-eict-academy-iit-guwahati/dsmlai-brochure-9months.pdf',
        'download_name' => 'DS_ML_AI_IIT_Guwahati_Brochure.pdf',
        'pages'         => 14
    ]
];

// Capture requested brochure key
$brochure_key = sanitize_val($_GET['brochure'] ?? ($brochure_key ?? 'dsml'));
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
$document_title   = sanitize_val($_GET['title'] ?? ($document_title ?? $default_title));
$document_type    = sanitize_val($_GET['type'] ?? ($document_type ?? $default_type));
$document_format  = sanitize_val($_GET['format'] ?? ($document_format ?? $default_format));
$document_pdf_url = validate_doc_target($_GET['pdf_url'] ?? ($pdf_web_url ?? null), $default_pdf_url);
$document_pages   = max(1, (int)($_GET['pages'] ?? ($document_pages ?? $default_pages)));
$download_action  = site_url('download-brochure?brochure=' . urlencode($brochure_key));
$current_page_url = current_url();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You! Your Brochure is Ready | The IoT Academy</title>
    <meta name="description" content="Thank you for requesting the program brochure from The IoT Academy. Download or browse the curriculum directly online.">
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
        <div class="tia-confirmation-container">
            <!-- Page Heading -->
            <div class="tia-confirmation-header">
                <h1 class="tia-main-title">
                    Thank You! Your Brochure is Ready
                    <span class="tia-checkmark-badge" aria-label="Confirmed checkmark">✔</span>
                </h1>
                <p class="tia-subtitle">
                    We've also emailed a copy to you. Feel free to download or browse the curriculum below.
                </p>
            </div>

            <!-- Two-Column Main Layout -->
            <section class="tia-two-column-layout" aria-label="Brochure information and interactive PDF preview">
                <!-- Left Column: What's Next? -->
                <aside class="tia-details-column">
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

                        <!-- PDF Viewport with Real-Time PDF.js Scroll Sync -->
                        <div class="tia-pdf-viewport" id="tiaPdfViewport" data-pdf-url="<?= $document_pdf_url ?>" role="region" aria-label="Brochure PDF Viewer" tabindex="0">
                            <div class="tia-pdf-canvas-container" id="tiaPdfCanvasContainer">
                                <div class="tia-pdf-loading-indicator" id="tiaPdfLoading">
                                    <i class="fas fa-spinner fa-spin"></i> Loading brochure preview...
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
