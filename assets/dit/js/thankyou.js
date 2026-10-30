/**
 * The IoT Academy - Brochure Preview & Interaction Handler
 * Integrated with PDF.js for Real-Time Page Number Sync & Full Page View
 */

// Global document instance
let globalPdfDoc = null;
let renderedPagesTracker = {};
let totalPagesCount = 1;
let activeRenderTasks = {};
let currentRenderWidth = 0;
let resizeDebounceTimer = null;
let defaultPageAspectRatio = 1.414; // Default standard ratio (A4 height/width ~ 1.414)
let isInitializingPdf = false;

document.addEventListener("DOMContentLoaded", function () {
  // 1. Mobile Menu Toggle
  const mobileToggleBtn = document.getElementById("tiaMobileMenuBtn");
  const navMenu = document.getElementById("tiaNavMenu");

  if (mobileToggleBtn && navMenu) {
    mobileToggleBtn.addEventListener("click", function () {
      navMenu.classList.toggle("tia-nav-menu-open");
      const expanded = navMenu.classList.contains("tia-nav-menu-open");
      mobileToggleBtn.setAttribute("aria-expanded", expanded);
    });
  }

  // 2. Programs Dropdown Toggle
  const programsDropdownItem = document.getElementById("tiaProgramsDropdown");
  const dropdownToggleBtn = document.getElementById("tiaDropdownToggleBtn");

  if (programsDropdownItem && dropdownToggleBtn) {
    dropdownToggleBtn.addEventListener("click", function (e) {
      e.stopPropagation();
      programsDropdownItem.classList.toggle("open");
    });

    document.addEventListener("click", function (e) {
      if (!programsDropdownItem.contains(e.target)) {
        programsDropdownItem.classList.remove("open");
      }
    });
  }

  // 3. Initialize PDF.js Viewer with Real-Time Page Sync
  initPdfPreview();
});

/**
 * Open the Brochure PDF in Full Page / New Tab
 */
function openPdfFullPage(pdfUrl) {
  const viewport = document.getElementById("tiaPdfViewport");
  const targetUrl = pdfUrl || (viewport ? viewport.dataset.pdfUrl : "") || window.location.href;
  if (targetUrl) {
    window.open(targetUrl, "_blank");
  }
}

/**
 * Calculate usable width inside the PDF viewport accurately for all screen sizes
 */
function getViewerUsableWidth() {
  const viewport = document.getElementById("tiaPdfViewport");
  if (!viewport) return 520;

  const style = window.getComputedStyle(viewport);
  const paddingLeft = parseFloat(style.paddingLeft) || 0;
  const paddingRight = parseFloat(style.paddingRight) || 0;

  // clientWidth includes horizontal padding and excludes the vertical scrollbar
  let usable = viewport.clientWidth - (paddingLeft + paddingRight);

  // Fallback if clientWidth is not yet calculated or hidden
  if (!usable || usable <= 0) {
    const rect = viewport.getBoundingClientRect();
    if (rect && rect.width > 0) {
      usable = rect.width - (paddingLeft + paddingRight);
    }
  }

  if (!usable || usable <= 0) {
    usable = Math.min(680, Math.max(200, window.innerWidth - 32));
  }

  // Round down and subtract 2px buffer to guarantee no subpixel wrapping or clipping
  return Math.max(160, Math.floor(usable - 2));
}

/**
 * Ensure all placeholder slots and existing canvases immediately adapt to new width
 * Prevents previously rendered pages and unrendered slots from retaining old/desktop dimensions
 */
function updateAllSlotDimensions(newWidth) {
  const container = document.getElementById("tiaPdfCanvasContainer");
  if (!container || !newWidth) return;

  const estimatedHeight = Math.round(newWidth * defaultPageAspectRatio);

  const allSlots = container.querySelectorAll(".tia-pdf-page-slot");
  allSlots.forEach(function (slot) {
    slot.style.width = newWidth + "px";
    slot.style.maxWidth = "100%";
    slot.style.minHeight = estimatedHeight + "px";

    const canvas = slot.querySelector(".tia-pdf-page-canvas");
    if (canvas) {
      canvas.style.width = newWidth + "px";
      canvas.style.maxWidth = "100%";
      if (canvas.width > 0) {
        canvas.style.height = estimatedHeight + "px";
      }
    }
  });
}

/**
 * Dynamic loader to guarantee PDF.js library is available even if script tag was missing/redirected
 */
function ensurePdfJsLoaded(callback) {
  if (typeof pdfjsLib !== "undefined") {
    callback(null, pdfjsLib);
    return;
  }

  console.info("PDF.js library not detected on window. Loading verified 3.11.174 bundle...");
  const script = document.createElement("script");
  script.src = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js";
  script.async = true;

  script.onload = function () {
    if (typeof pdfjsLib !== "undefined") {
      callback(null, pdfjsLib);
    } else {
      callback(new Error("pdfjsLib undefined after script load"));
    }
  };

  script.onerror = function (err) {
    callback(new Error("Failed to load PDF.js from CDN and local sources"));
  };

  document.head.appendChild(script);
}

/**
 * Initialize PDF.js Viewer
 */
function initPdfPreview() {
  if (isInitializingPdf) return;
  isInitializingPdf = true;

  const viewport = document.getElementById("tiaPdfViewport");
  const container = document.getElementById("tiaPdfCanvasContainer");
  const loading = document.getElementById("tiaPdfLoading");
  const currentPageEl = document.getElementById("tiaCurrentPage");
  const totalPagesEl = document.getElementById("tiaTotalPages");

  if (!viewport || !container) {
    isInitializingPdf = false;
    return;
  }

  const pdfUrl = viewport.dataset.pdfUrl;
  if (!pdfUrl) {
    console.error("PDF Preview Error: No data-pdf-url specified on #tiaPdfViewport");
    showFallbackView(viewport, "", new Error("Missing data-pdf-url"));
    isInitializingPdf = false;
    return;
  }

  // Ensure PDF.js is loaded
  ensurePdfJsLoaded(function (loadErr, lib) {
    if (loadErr || !lib) {
      console.error("PDF.js initialization failed:", loadErr);
      showFallbackView(viewport, pdfUrl, loadErr || new Error("PDF.js library unavailable"));
      isInitializingPdf = false;
      return;
    }

    // Set worker compatible with 3.11.174
    try {
      const cdnWorker = "https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js";
      let workerPath = cdnWorker;
      if (typeof tiaPdfWorkerUrl !== "undefined" && tiaPdfWorkerUrl) {
        // Discard any worker URL pointing to known broken local redirects
        if (!tiaPdfWorkerUrl.includes("assets/js/pdf.worker.min.js")) {
          workerPath = tiaPdfWorkerUrl;
        }
      }
      lib.GlobalWorkerOptions.workerSrc = workerPath;
    } catch (e) {
      console.warn("Worker setup warning:", e);
    }

    // Load the PDF document
    const loadingTask = lib.getDocument({
      url: pdfUrl,
      cMapUrl: "https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174/cmaps/",
      cMapPacked: true,
    });

    loadingTask.promise
      .then(function (pdf) {
        globalPdfDoc = pdf;
        totalPagesCount = pdf.numPages;

        // Update total pages indicator
        if (totalPagesEl) {
          totalPagesEl.textContent = totalPagesCount;
        }

        // Hide loading spinner
        if (loading) {
          loading.style.display = "none";
        }

        // Clear container and create placeholder slots for all pages
        container.innerHTML = "";
        for (let i = 1; i <= totalPagesCount; i++) {
          const slot = document.createElement("div");
          slot.className = "tia-pdf-page-slot";
          slot.id = "tia-page-slot-" + i;
          slot.dataset.pageNum = i;

          const canvas = document.createElement("canvas");
          canvas.id = "tia-canvas-" + i;
          canvas.className = "tia-pdf-page-canvas";
          slot.appendChild(canvas);

          container.appendChild(slot);
        }

        // Apply initial responsive slot dimensions
        const initialWidth = getViewerUsableWidth();
        currentRenderWidth = initialWidth;
        updateAllSlotDimensions(initialWidth);

        // Setup IntersectionObserver for real-time page number syncing & lazy loading
        setupPageObserver(viewport, pdf);

        // Setup window resize, orientation change, and ResizeObserver
        setupResizeHandler(pdf);

        // Render first 2 pages immediately
        renderPageCanvas(pdf, 1);
        if (totalPagesCount > 1) {
          renderPageCanvas(pdf, 2);
        }
        isInitializingPdf = false;
      })
      .catch(function (error) {
        console.error("PDF.js failed to load PDF document from " + pdfUrl, error);
        showFallbackView(viewport, pdfUrl, error);
        isInitializingPdf = false;
      });
  });
}

/**
 * Setup IntersectionObserver to track visible page and sync "Page X of Y"
 */
function setupPageObserver(viewport, pdf) {
  const currentPageEl = document.getElementById("tiaCurrentPage");
  const slots = viewport.querySelectorAll(".tia-pdf-page-slot");

  if ("IntersectionObserver" in window) {
    const observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            const pageNum = parseInt(entry.target.dataset.pageNum, 10);
            if (currentPageEl && pageNum) {
              currentPageEl.textContent = pageNum;
            }
            renderPageCanvas(pdf, pageNum);
            // Preload next page
            if (pageNum + 1 <= totalPagesCount) {
              renderPageCanvas(pdf, pageNum + 1);
            }
          }
        });
      },
      {
        root: viewport,
        threshold: 0.35,
      }
    );

    slots.forEach(function (slot) {
      observer.observe(slot);
    });
  }

  // Scroll listener fallback & continuous accurate sync
  let scrollTimeout = null;
  viewport.addEventListener(
    "scroll",
    function () {
      if (scrollTimeout) return;
      scrollTimeout = setTimeout(function () {
        scrollTimeout = null;
        const viewportRect = viewport.getBoundingClientRect();
        const middleY = viewportRect.top + viewportRect.height / 2;

        let activePage = 1;
        slots.forEach(function (slot) {
          const rect = slot.getBoundingClientRect();
          if (rect.top <= middleY && rect.bottom >= middleY) {
            activePage = parseInt(slot.dataset.pageNum, 10);
          }
        });

        if (currentPageEl && activePage) {
          currentPageEl.textContent = activePage;
        }
      }, 50);
    },
    { passive: true }
  );
}

/**
 * Setup debounced window resize, orientation, and container ResizeObserver
 */
function setupResizeHandler(pdf) {
  const viewport = document.getElementById("tiaPdfViewport");

  function triggerDebouncedResize() {
    if (resizeDebounceTimer) {
      clearTimeout(resizeDebounceTimer);
    }

    resizeDebounceTimer = setTimeout(function () {
      if (!globalPdfDoc) return;
      const newWidth = getViewerUsableWidth();
      if (Math.abs(newWidth - currentRenderWidth) >= 4) {
        currentRenderWidth = newWidth;

        // Immediately update all slots and canvases so NO page retains desktop dimensions
        updateAllSlotDimensions(newWidth);

        // Reset rendered tracker so visible pages re-render crisp
        renderedPagesTracker = {};

        const currentPageEl = document.getElementById("tiaCurrentPage");
        const activePage = currentPageEl ? parseInt(currentPageEl.textContent, 10) || 1 : 1;

        // Re-render currently active page and adjacent page
        renderPageCanvas(globalPdfDoc, activePage, true);
        if (activePage + 1 <= totalPagesCount) {
          renderPageCanvas(globalPdfDoc, activePage + 1, true);
        }
        if (activePage > 1) {
          renderPageCanvas(globalPdfDoc, activePage - 1, true);
        }
      }
    }, 100);
  }

  // Modern ResizeObserver: triggers immediately when viewport settles on mobile load
  if ("ResizeObserver" in window && viewport) {
    try {
      const ro = new ResizeObserver(function (entries) {
        for (const entry of entries) {
          if (entry.contentRect && entry.contentRect.width > 0) {
            triggerDebouncedResize();
          }
        }
      });
      ro.observe(viewport);
    } catch (e) {
      console.warn("ResizeObserver warning:", e);
    }
  }

  window.addEventListener("resize", triggerDebouncedResize);
  window.addEventListener("orientationchange", function () {
    setTimeout(triggerDebouncedResize, 200);
  });
  window.addEventListener("load", triggerDebouncedResize);
}

/**
 * Render individual page on canvas with responsive scaling
 */
function renderPageCanvas(pdf, pageNum, forceReRender) {
  if (!forceReRender && renderedPagesTracker[pageNum]) return;
  renderedPagesTracker[pageNum] = true;

  pdf.getPage(pageNum).then(function (page) {
    const canvas = document.getElementById("tia-canvas-" + pageNum);
    const slot = document.getElementById("tia-page-slot-" + pageNum);
    if (!canvas || !slot) return;

    // Cancel any in-progress render task for this canvas to avoid conflicts
    if (activeRenderTasks[pageNum]) {
      try {
        activeRenderTasks[pageNum].cancel();
      } catch (e) {}
      delete activeRenderTasks[pageNum];
    }

    const containerWidth = getViewerUsableWidth();
    currentRenderWidth = containerWidth;

    const unscaledViewport = page.getViewport({ scale: 1.0 });

    // Update aspect ratio from page 1 and adjust placeholder slots
    if (pageNum === 1 && unscaledViewport.width > 0) {
      defaultPageAspectRatio = unscaledViewport.height / unscaledViewport.width;
      updateAllSlotDimensions(containerWidth);
    }

    const scale = containerWidth / unscaledViewport.width;
    const scaledViewport = page.getViewport({ scale: scale });

    const pixelRatio = window.devicePixelRatio || 1;
    const targetWidth = Math.floor(scaledViewport.width);
    const targetHeight = Math.floor(scaledViewport.height);

    canvas.width = Math.floor(targetWidth * pixelRatio);
    canvas.height = Math.floor(targetHeight * pixelRatio);

    canvas.style.width = targetWidth + "px";
    canvas.style.height = targetHeight + "px";
    canvas.style.maxWidth = "100%";

    slot.style.width = targetWidth + "px";
    slot.style.maxWidth = "100%";
    slot.style.minHeight = targetHeight + "px";

    const ctx = canvas.getContext("2d");
    const transform = pixelRatio !== 1 ? [pixelRatio, 0, 0, pixelRatio, 0, 0] : null;

    const renderContext = {
      canvasContext: ctx,
      transform: transform,
      viewport: scaledViewport,
    };

    const renderTask = page.render(renderContext);
    activeRenderTasks[pageNum] = renderTask;

    renderTask.promise
      .then(function () {
        delete activeRenderTasks[pageNum];
      })
      .catch(function (err) {
        if (err && err.name === "RenderingCancelledException") {
          return;
        }
        console.error("Error rendering page " + pageNum, err);
        delete activeRenderTasks[pageNum];
      });
  }).catch(function (err) {
    console.error("Error fetching page " + pageNum, err);
  });
}

/**
 * Non-destructive fallback message when PDF.js cannot render
 * Preserves toolbar, responsive structure, and provides direct view/download actions
 */
function showFallbackView(viewport, pdfUrl, error) {
  console.error("Brochure Preview Unavailable:", error);

  const container = document.getElementById("tiaPdfCanvasContainer");
  const loading = document.getElementById("tiaPdfLoading");
  if (loading) {
    loading.style.display = "none";
  }

  const targetUrl = pdfUrl || (viewport ? viewport.dataset.pdfUrl : "") || "#";

  const fallbackHtml = `
    <div class="tia-pdf-fallback-card" role="alert">
      <div class="tia-pdf-fallback-icon">
        <i class="fas fa-file-pdf"></i>
      </div>
      <h3 class="tia-pdf-fallback-title">
        Brochure Preview
      </h3>
      <p class="tia-pdf-fallback-desc">
        The interactive viewer could not load directly in this browser. You can view or download the complete brochure below.
      </p>
      <div class="tia-pdf-fallback-actions">
        <a href="${targetUrl}" target="_blank" rel="noopener noreferrer" class="tia-pdf-fallback-btn-primary">
          <i class="fas fa-external-link-alt"></i>
          <span>Open Full PDF</span>
        </a>
        <a href="${targetUrl}" download class="tia-pdf-fallback-btn-secondary">
          <i class="fas fa-download"></i>
          <span>Download PDF</span>
        </a>
      </div>
    </div>
  `;

  if (container) {
    container.innerHTML = fallbackHtml;
  } else if (viewport) {
    viewport.innerHTML = fallbackHtml;
  }
}

/**
 * Backward compatibility fallback function name
 */
function showIframeFallback(viewport, pdfUrl) {
  showFallbackView(viewport, pdfUrl, new Error("Fallback requested"));
}

/**
 * Handle document print action
 */
function handlePrint(pdfUrl) {
  if (pdfUrl) {
    const printWindow = window.open(pdfUrl, "_blank");
    if (printWindow) {
      printWindow.focus();
      setTimeout(function () {
        printWindow.print();
      }, 800);
      return;
    }
  }
  window.print();
}

/**
 * Handle Web Share API and Clipboard Copy Fallback
 */
async function handleShare(shareTitle, shareUrl) {
  const urlToShare = shareUrl || window.location.href;
  const title = shareTitle || "The IoT Academy - Program Brochure";

  const shareData = {
    title: title,
    text: "Check out the curriculum brochure for this program at The IoT Academy!",
    url: urlToShare,
  };

  if (navigator.share) {
    try {
      await navigator.share(shareData);
      return;
    } catch (err) {
      // User cancelled share or share aborted
    }
  }

  // Clipboard fallback
  try {
    await navigator.clipboard.writeText(urlToShare);
    showToastNotification("Brochure link copied to clipboard!");
  } catch (e) {
    showToastNotification("Share URL: " + urlToShare);
  }
}

/**
 * Lightweight Toast Notification UI
 */
function showToastNotification(message) {
  let toast = document.getElementById("tiaBrochureToast");
  if (!toast) {
    toast = document.createElement("div");
    toast.id = "tiaBrochureToast";
    toast.style.position = "fixed";
    toast.style.bottom = "85px";
    toast.style.left = "24px";
    toast.style.backgroundColor = "#0b2545";
    toast.style.color = "#ffffff";
    toast.style.padding = "10px 18px";
    toast.style.borderRadius = "8px";
    toast.style.fontSize = "13px";
    toast.style.fontWeight = "600";
    toast.style.boxShadow = "0 6px 18px rgba(0,0,0,0.25)";
    toast.style.zIndex = "10001";
    toast.style.transition = "opacity 0.3s ease, transform 0.3s ease";
    toast.style.opacity = "0";
    toast.style.transform = "translateY(10px)";
    document.body.appendChild(toast);
  }

  toast.textContent = message;
  toast.style.opacity = "1";
  toast.style.transform = "translateY(0)";

  setTimeout(function () {
    toast.style.opacity = "0";
    toast.style.transform = "translateY(10px)";
  }, 3200);
}
