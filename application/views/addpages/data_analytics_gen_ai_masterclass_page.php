<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DA Gen AI Masterclass</title>
    <meta name="description"
        content="DA with Gen AI - A free The IoT Academy Masterclass on DA roles, skills and opportunities." />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="assets/dit/css/data_analytics_gen_ai_masterclass_page.css" />
    <link rel="stylesheet" href="assets/dit/css/data_analytics_gen_ai_masterclass_page_responsive.css" />
    <!-- <link rel="stylesheet" href="./data_analytics_gen_ai_masterclass_page.css" />
    <link rel="stylesheet" href="./data_analytics_gen_ai_masterclass_page_responsive.css" /> -->

    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '422496948788512');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=422496948788512&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
</head>

<body>

    <!-- Header / Navbar -->
    <header class="site-header" id="navbar">
        <div class="header-inner">
            <div class="logo-cluster">
                <div class="logo">
                    <img src="https://www.theiotacademy.co/assets/dit/images/navbar/logo.svg" alt="The IoT Academy"
                        style="height:60px;width:auto;" />
                </div>
                <div class="forbes-divider">
                    <img src="https://www.theiotacademy.co/assets/dit/images/navbar/forbes01.svg" alt="Forbes"
                        style="height:60px;width:auto;" />
                </div>
                <div class="forbes">
                    <img src="https://www.theiotacademy.co/assets/dit/images/navbar/forbes02.svg" alt="Forbes India"
                        style="height:35px;width:auto;" />
                    <div class="visionary">Visionary Companies</div>
                    <div class="rank">Rank #2</div>
                </div>
            </div>

            <button class="login-btn"
                onclick="document.getElementById('registerForm').scrollIntoView({behavior:'smooth'})">
                Reserve My Free Seat <i class="fa-solid fa-arrow-right"></i>
            </button>
        </div>
    </header>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-glow"></div>
        <svg class="hero-curves" viewBox="0 0 1440 320" preserveAspectRatio="xMidYMax slice">
            <path d="M-100,240 C200,240 200,120 520,120 C840,120 840,240 1160,240 C1480,240 1480,120 1800,120"
                stroke="rgba(59,130,246,0.22)" stroke-width="40" fill="none" stroke-linecap="round" />
            <path d="M-100,300 C200,300 200,180 520,180 C840,180 840,300 1160,300 C1480,300 1480,180 1800,180"
                stroke="rgba(59,130,246,0.14)" stroke-width="50" fill="none" stroke-linecap="round" />
        </svg>

        <div class="hero-content">
            <div class="badge glass">FREE LIVE MASTERCLASS</div>

            <h1 class="hero-title">Become a Job-Ready Data Analyst in the Age of GenAI</span>
            </h1>

            <div class="separator">
                <div class="separator-line"></div>
                <svg class="diamond" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                    fill="none">
                    <g transform="scale(1.0435)">
                        <path
                            d="M15.2933 8.93263L14.0161 5.57375H16.2659C17.1213 5.57581 17.9643 5.77859 18.7271 6.16579C19.4898 6.55299 20.1511 7.11379 20.6577 7.8031L21.3887 8.80166C21.7003 9.22668 21.9273 9.70757 22.0575 10.2182H15.6342C15.5683 9.77844 15.4539 9.3473 15.2933 8.93263ZM11.0343 3.71596C11.2807 3.71596 11.517 3.6181 11.6912 3.4439C11.8654 3.2697 11.9632 3.03343 11.9632 2.78707V0.929282C11.9632 0.682924 11.8654 0.446656 11.6912 0.272455C11.517 0.0982534 11.2807 0.000388083 11.0343 0.000388083C10.788 0.000388083 10.5517 0.0982534 10.3775 0.272455C10.2033 0.446656 10.1054 0.682924 10.1054 0.929282V2.78707C10.1054 3.03343 10.2033 3.2697 10.3775 3.4439C10.5517 3.6181 10.788 3.71596 11.0343 3.71596ZM13.5628 9.60794L12.0292 5.57375H10.0478L8.48916 9.70919C8.42937 9.8757 8.37974 10.0457 8.34054 10.2182H13.7476C13.7012 10.0105 13.6394 9.8065 13.5628 9.60794ZM15.2636 3.62307C15.3732 3.67822 15.4928 3.71107 15.6152 3.71975C15.7376 3.72842 15.8606 3.71274 15.9769 3.67361C16.0933 3.63449 16.2007 3.57269 16.293 3.49179C16.3854 3.41089 16.4607 3.31249 16.5148 3.20229L17.4437 1.3445C17.5538 1.12401 17.5718 0.868802 17.4938 0.635023C17.4158 0.401245 17.248 0.208044 17.0275 0.0979219C16.8071 -0.0122001 16.5519 -0.0302223 16.3181 0.0478199C16.0843 0.125862 15.8911 0.293576 15.781 0.514066L14.8521 2.37185C14.7966 2.48096 14.7633 2.59996 14.7539 2.72201C14.7446 2.84405 14.7595 2.96674 14.7977 3.08301C14.836 3.19928 14.8968 3.30685 14.9767 3.39954C15.0567 3.49222 15.1542 3.56819 15.2636 3.62307ZM11.0232 17.5444L13.6111 12.6649C13.6768 12.4726 13.7286 12.2758 13.7662 12.076H8.24765C8.28941 12.3153 8.35156 12.5505 8.43342 12.7792L11.0232 17.5444ZM6.76142 9.0376L8.06187 5.57375H5.81673C4.97889 5.57594 4.15274 5.77046 3.40194 6.14231C2.65113 6.51417 1.99573 7.05344 1.48623 7.71857L0.723608 8.7162C0.387594 9.16293 0.147561 9.67431 0.0185779 10.2182H6.42794C6.49935 9.81452 6.61106 9.419 6.76142 9.0376ZM15.65 12.076C15.5915 12.5199 15.4843 12.956 15.3305 13.3765C15.3165 13.4136 11.8415 19.9475 11.8387 19.9484C11.7631 20.0954 11.6485 20.2188 11.5076 20.3052C11.3666 20.3916 11.2047 20.4377 11.0394 20.4385C10.874 20.4392 10.7117 20.3946 10.5699 20.3095C10.4282 20.2244 10.3125 20.1021 10.2355 19.9558C10.2355 19.9558 6.72984 13.5353 6.71497 13.4954C6.54858 13.0371 6.43757 12.5606 6.38429 12.076H0C0.171788 12.9072 0.603865 13.662 1.23357 14.231L8.65543 21.39C9.3073 21.9714 10.1507 22.2918 11.0241 22.2901C11.9161 22.2884 12.776 21.9576 13.4392 21.3612L20.8109 14.271C21.4569 13.6933 21.9012 12.9242 22.0789 12.076H15.65ZM5.5585 3.20229C5.66862 3.42339 5.86207 3.5917 6.09628 3.67017C6.3305 3.74865 6.58629 3.73087 6.8074 3.62075C7.0285 3.51063 7.19681 3.31718 7.27529 3.08297C7.35376 2.84876 7.33599 2.59296 7.22586 2.37185L6.29697 0.514066C6.24244 0.404891 6.16695 0.307524 6.07479 0.227525C5.98264 0.147526 5.87562 0.0864625 5.75987 0.0478199C5.52609 -0.0302223 5.27089 -0.0122001 5.0504 0.0979219C4.82991 0.208044 4.66219 0.401245 4.58415 0.635023C4.50611 0.868802 4.52413 1.12401 4.63425 1.3445L5.5585 3.20229Z"
                            fill="#ffffff" />
                    </g>
                </svg>
                <div class="separator-line right"></div>
            </div>

            <p class="hero-sub">Learn what companies are looking for in Data Analysts today, how GenAI is changing the
                role, and what you should actually learn to stay ahead.
                <br>
                <br>
                Whether you're a student, fresher, career switcher or working professional, this masterclass will help
                you understand where to start, what to learn and how to become job-ready.
            </p>

            <div class="hero-stats">
                <div class="stat-pill glass">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s-8-4.5-8-11.8V5l8-3 8 3v5.2c0 7.3-8 11.8-8 11.8z" />
                            <path d="M12 8v4" />
                            <path d="M12 16h.01" />
                        </svg>
                    </div>
                    <span class="stat-label">100% FREE</span>
                </div>
                <div class="stat-pill glass">
                    <div class="stat-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <span class="stat-label">No registration fee</span>
                </div>
                <div class="stat-pill glass">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <span class="stat-label">LIVE MASTERCLASS</span>
                </div>

                <div class="stat-pill glass">
                    <div class="stat-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <span class="stat-label">Learn from industry experts</span>
                </div>
            </div>

            <p class="hero-urgency"><strong>Almost Full!</strong> Claim One Of The Last Seats For The Masterclass!</p>

            <div class="countdown-bar glass" id="countdownStrip">
                <div class="countdown-left">
                    <div class="countdown-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 22h14" />
                            <path d="M5 2h14" />
                            <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
                            <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
                        </svg>
                    </div>
                    <div class="countdown-text">
                        <h3>NEXT MASTERCLASS STARTS IN</h3>
                        <p>Reserve your free seat before registration closes.</p>
                    </div>
                </div>
                <div class="countdown-timer">
                    <div class="time-unit glass">
                        <span class="value" id="cd-days">00</span>
                        <span class="label">Days</span>
                    </div>

                    <span class="colon">:</span>

                    <div class="time-unit glass">
                        <span class="value" id="cd-hours">00</span>
                        <span class="label">Hours</span>
                    </div>

                    <span class="colon">:</span>

                    <div class="time-unit glass">
                        <span class="value" id="cd-minutes">00</span>
                        <span class="label">Minutes</span>
                    </div>

                    <span class="colon">:</span>

                    <div class="time-unit glass">
                        <span class="value" id="cd-seconds">00</span>
                        <span class="label">Seconds</span>
                    </div>
                </div>
                <button class="cta-button" data-scroll-to="registerForm">Reserve My Free Seat</button>
            </div>
        </div>
    </section>

    <!-- Who Is This For -->
    <section class="for-banner reveal">
        <div class="container">
            <div class="for-header">
                <h2 class="for-title">WHO SHOULD ATTEND THIS MASTERCLASS?</h2>
            </div>
            <div class="for-grid">
                <div class="for-card">
                    <div class="for-icon"><i class="fa-solid fa-user-graduate"></i></div>
                    <span class="for-label">Students & Freshers</span>
                    <p class="for-desc">Final year or recent graduates looking to build a career in Data Analytics</p>
                </div>
                <div class="for-card">
                    <div class="for-icon"><i class="fa-solid fa-briefcase"></i></div>
                    <span class="for-label">Working Professionals</span>
                    <p class="for-desc">Professionals who want to upskill and stay relevant in the age of AI</p>
                </div>
                <div class="for-card">
                    <div class="for-icon"><i class="fa-solid fa-arrows-rotate"></i></div>
                    <span class="for-label">Career Switchers</span>
                    <p class="for-desc">Professionals from non-tech or other domains who want to transition into Data
                        Analytics.</p>
                </div>
                <div class="for-card">
                    <div class="for-icon"><i class="fa-solid fa-chart-bar"></i></div>
                    <span class="for-label">Aspiring Data Analysts</span>
                    <p class="for-desc">Anyone who wants a clear roadmap to become a job-ready Data Analyst</p>
                </div>
                <div class="for-card">
                    <div class="for-icon"><i class="fa-solid fa-robot"></i></div>
                    <span class="for-label">Data & AI Enthusiasts</span>
                    <p class="for-desc">Anyone who wants to understand how GenAI and AI automation are changing Data
                        Analytics.</p>
                </div>
            </div>
            <div class="for-cta">
                <button class="btn btn-yellow" data-scroll-to="registerForm">Get My Free Seat <i
                        class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>
    </section>

    <!-- Two-column body -->
    <div class="container body-grid">

        <div class="body-main">

            <article class="block reveal">
                <h3 class="block-title">About this Masterclass</h3>
                <p>Stop Guessing What to Learn. Get a Clear Data Analytics Career Roadmap.</p>
                <p>In this FREE live masterclass, we'll break down what it actually takes to become a job-ready Data
                    Analyst in today's AI-driven job market.</p>
                <p>The real question is:</p>
                <p><strong>What should you actually learn to get hired?</strong></p>
                <p>In this free masterclass, we'll break down the modern Data Analytics career path and show you:</p>
                <ul class="check-list">
                    <li>Technical skills companies expect from Data Analysts</li>
                    <li>Tools you need to master - and which ones you can skip for now</li>
                    <li>How Generative AI is changing Data Analytics</li>
                    <li>How Data Analysts are using AI to work faster/smarter</li>
                    <li>Hard skills and soft skills can help you stand out</li>
                    <li>What employers look for when evaluating candidates</li>
                    <li>How to move from learning → projects → portfolio → interviews → job</li>
                </ul>
                <p>By the end of the masterclass, you'll have a clear roadmap of what to learn, what to build and what
                    to do next.</p>
                <button class="btn btn-primary" data-scroll-to="registerForm">Register Now!</button>
            </article>

            <article class="block reveal">
                <h3 class="block-title">What You'll Learn in the Masterclass</h3>
                <p class="learn-subtitle">A practical roadmap to becoming a Data Analyst in the AI era.</p>
                <div class="learn-scroll-track">
                    <div class="learn-item">
                        <span class="learn-num">01.</span>
                        <div>
                            <strong>The Data Analyst Role Is Changing</strong>
                            <p>Understand what Data Analysts do today and how GenAI and automation are changing the
                                role.</p>
                        </div>
                    </div>
                    <div class="learn-item">
                        <span class="learn-num">02.</span>
                        <div>
                            <strong>The Data Analytics Skill Stack</strong>
                            <p>Understand where <strong>Excel, SQL, Statistics, Python, Power BI/Tableau and Business
                                    Analytics</strong> fit into your career roadmap.</p>
                        </div>
                    </div>
                    <div class="learn-item">
                        <span class="learn-num">03.</span>
                        <div>
                            <strong>Data Analytics + GenAI</strong>
                            <p>Learn how GenAI can help with data analysis, insights, reporting, productivity and
                                everyday analytics workflows.
                            </p>
                        </div>
                    </div>
                    <div class="learn-item">
                        <span class="learn-num">04.</span>
                        <div>
                            <strong>The AI-Powered Data Analyst</strong>
                            <p>See how AI can help Data Analysts move from manual reporting to faster analysis, smarter
                                insights and automation.</p>
                        </div>
                    </div>
                    <div class="learn-item">
                        <span class="learn-num">05.</span>
                        <div>
                            <strong>Projects That Build Your Portfolio</strong>
                            <p>Understand what kind of real-world Data Analytics projects can help demonstrate your
                                skills to recruiters.

                            </p>
                        </div>
                    </div>
                    <div class="learn-item">
                        <span class="learn-num">06.</span>
                        <div>
                            <strong>From Learning to Getting Hired</strong>
                            <p>Learn how to connect your skills, projects, portfolio, resume and interview preparation
                                into a job-ready career plan.</p>
                        </div>
                    </div>
                    <div class="learn-item">
                        <span class="learn-num">07.</span>
                        <div>
                            <strong>What Your Portfolio Should Look Like</strong>
                            <p>Understand what makes a Data Analytics project actually valuable to recruiters - instead
                                of building
                                projects that simply look like tutorials.</p>
                        </div>
                    </div>
                    <div class="learn-item">
                        <span class="learn-num">08.</span>
                        <div>
                            <strong>Your Next Career Move</strong>
                            <p>Whether you&#39;re a:</p>
                            <p class="learn-stack">Student | Fresher | Career Switcher | Working Professional</p>
                            <p>understand what your next step should be.</p>
                        </div>
                    </div>
                </div>
            </article>

            <article class="block reveal modern-analytics-section">
                <h3 class="block-title">See What Modern Data Analytics Looks Like</h3>
                <p class="section-subtitle">It's no longer just Excel → SQL → Dashboard. AI is changing how Data
                    Analysts work.</p>

                <div class="modern-cards-grid">
                    <div class="modern-card">
                        <div class="modern-card-icon">
                            <i class="fa-solid fa-chart-pie"></i>
                        </div>
                        <h4 class="modern-card-title">Business Analytics</h4>
                        <p class="modern-card-desc">Turn raw business data into actionable insights.</p>
                    </div>

                    <div class="modern-card">
                        <div class="modern-card-icon">
                            <i class="fa-solid fa-wand-magic-sparkles"></i>
                        </div>
                        <h4 class="modern-card-title">AI-Powered Analysis</h4>
                        <p class="modern-card-desc">Use GenAI to explore data, identify patterns and generate insights
                            faster.</p>
                    </div>

                    <div class="modern-card">
                        <div class="modern-card-icon">
                            <i class="fa-solid fa-table-columns"></i>
                        </div>
                        <h4 class="modern-card-title">Dashboard & Reporting</h4>
                        <p class="modern-card-desc">Turn analysis into clear dashboards and business decisions.</p>
                    </div>

                    <div class="modern-card">
                        <div class="modern-card-icon">
                            <i class="fa-solid fa-gears"></i>
                        </div>
                        <h4 class="modern-card-title">Analytics Automation</h4>
                        <p class="modern-card-desc">Understand how AI and automation can reduce repetitive analytics
                            work.</p>
                    </div>
                </div>

                <p class="modern-footer-text">We'll show you where these skills fit into a modern Data Analyst career.
                </p>

                <div class="modern-cta">
                    <button class="btn btn-primary" data-scroll-to="registerForm">
                        See It in the Masterclass <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </article>

            <article class="block reveal">
                <h3 class="block-title">What Learners Say About Their Journey</h3>

                <div class="slider" id="testimonialSlider">
                    <button class="slider-btn prev" aria-label="Previous"><i
                            class="fa-solid fa-chevron-left"></i></button>
                    <div class="slider-track" id="sliderTrack">
                        <div class="slide"><img src="https://www.theiotacademy.co/assets/images/testimonial1.jpg"
                                alt="Learner testimonial 1" loading="lazy" />
                        </div>
                        <div class="slide"><img src="https://www.theiotacademy.co/assets/images/testimonial2.jpg"
                                alt="Learner testimonial 2" loading="lazy" />
                        </div>
                        <div class="slide"><img src="https://www.theiotacademy.co/assets/images/testimonial3.jpg"
                                alt="Learner testimonial 3" loading="lazy" />
                        </div>
                    </div>
                    <button class="slider-btn next" aria-label="Next"><i class="fa-solid fa-chevron-right"></i></button>
                    <div class="slider-dots" id="sliderDots"></div>
                </div>
            </article>

            <article class="block reveal">
                <h3 class="block-title">Why Learn Data Analytics With The IoT Academy?</h3>
                <div class="why-stats-grid">
                    <div class="why-stat">
                        <span class="why-value">2017</span>
                        <span class="why-label">Established</span>
                    </div>
                    <div class="why-stat">
                        <span class="why-value">30,000+</span>
                        <span class="why-label">Learners</span>
                    </div>
                    <div class="why-stat">
                        <span class="why-value">400+</span>
                        <span class="why-label">Hiring Partners</span>
                    </div>
                    <div class="why-stat">
                        <span class="why-value">6,200+</span>
                        <span class="why-label">Alumni</span>
                    </div>
                    <div class="why-stat">
                        <span class="why-value">95%</span>
                        <span class="why-label">Placement Rate*</span>
                    </div>
                    <div class="why-stat">
                        <span class="why-value">&#8377;35 LPA</span>
                        <span class="why-label">Highest Package*</span>
                    </div>

                </div>
                <p style="margin-top:16px;">A trusted learning ecosystem built around practical skills, career readiness
                    and industry
                    relevance.</p>
            </article>

            <article class="block reveal final-cta-block">
                <h3 class="final-cta-title">Ready to Understand Your Data Analytics Career Roadmap?</h3>
                <p class="final-cta-description">Join the FREE live masterclass and discover what to learn, what to
                    build and how to become job-ready in the age of GenAI.</p>
                <div class="final-cta-center">
                    <button class="btn btn-yellow final-cta-btn" data-scroll-to="registerForm">
                        RESERVE MY FREE SEAT <i class="fa-solid fa-arrow-right"></i>
                    </button>
                    <div class="final-cta-badges">
                        <span class="cta-badge">100% Free</span>
                        <span class="cta-badge-separator">|</span>
                        <span class="cta-badge">Live Masterclass</span>
                        <span class="cta-badge-separator">|</span>
                        <span class="cta-badge">Limited Seats</span>
                    </div>
                </div>
            </article>

            <!-- FAQ Accordion -->
            <section class="faq reveal">
                <h3 class="block-title">Frequently Asked Questions</h3>
                <div class="accordion">
                    <div class="acc-item">
                        <button class="acc-head">Is this masterclass really free? <i
                                class="fa-solid fa-plus"></i></button>
                        <div class="acc-body">
                            <p>Yes. The masterclass is completely free to attend. Simply register with your name, email
                                and phone number to reserve your seat.
                            </p>
                        </div>
                    </div>
                    <div class="acc-item">
                        <button class="acc-head">Do I need prior Data Analytics experience?<i
                                class="fa-solid fa-plus"></i></button>
                        <div class="acc-body">
                            <p>No. The masterclass is designed to help beginners, students, freshers, career switchers
                                and working professionals understand the Data Analytics career roadmap.</p>
                        </div>
                    </div>
                    <div class="acc-item">
                        <button class="acc-head">Do I need to know Python or SQL?<i
                                class="fa-solid fa-plus"></i></button>
                        <div class="acc-body">
                            <p>No prior expertise is required for the masterclass. We'll explain where Python, SQL and
                                other key tools fit into the Data Analytics roadmap.</p>
                        </div>
                    </div>
                    <div class="acc-item">
                        <button class="acc-head">Is this suitable for non-tech professionals? <i
                                class="fa-solid fa-plus"></i></button>
                        <div class="acc-body">
                            <p>Yes. The session is designed for learners from both technical and non-technical
                                backgrounds who want to understand a career in Data Analytics.
                            </p>
                        </div>
                    </div>
                    <div class="acc-item">
                        <button class="acc-head">Will you cover GenAI?<i class="fa-solid fa-plus"></i></button>
                        <div class="acc-body">
                            <p>Yes. We'll explain how GenAI is changing Data Analytics and how modern Data Analysts can
                                use AI to work faster and smarter.</p>
                        </div>
                    </div>
                    <div class="acc-item">
                        <button class="acc-head">Will I get a roadmap?<i class="fa-solid fa-plus"></i></button>
                        <div class="acc-body">
                            <p>Yes. You'll leave with a clearer understanding of what to learn, what projects to build
                                and what steps to take towards becoming job-ready.
                            </p>
                        </div>
                    </div>

                </div>
            </section>

        </div>

        <!-- Registration form -->
        <aside class="body-side">
            <form class="register-card" id="registerForm" novalidate>
                <h3>Reserve Your FREE Masterclass Seat</h3>
                <div class="field">
                    <label for="fullName">Full Name *</label>
                    <input id="fullName" name="firstname" type="text" required />
                </div>
                <div class="field">
                    <label for="email">Email *</label>
                    <input id="email" name="email" type="email" required />
                </div>
                <div class="field">
                    <label for="phone">Phone Number *</label>
                    <div class="phone-row">
                        <select aria-label="Country code">
                            <option value="+91">+91</option>
                        </select>
                        <input id="phone" name="mobileno" type="tel" minlength="10" maxlength="10" required />
                    </div>
                    <!--<small>OTP will be sent to this number for verification</small>-->
                </div>
                <label class="checkbox">
                    <input type="checkbox" checked>
                    <span>I agree to the <a href="#">Terms of Use</a>, <a href="#">Privacy Policy</a>, <a
                            href="#">Cookie
                            usage</a> and all applicable laws and regulations.</span>
                </label>
                <button type="submit" class="btn btn-primary btn-block">Reserve My Free Seat</button>
            </form>
        </aside>

    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <h3 class="footer-heading">Follow Us</h3>
            <div class="socials">
                <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" aria-label="Quora"><i class="fa-brands fa-quora"></i></a>
            </div>
        </div>
    </footer>

    <!-- Back to top -->
    <button id="backToTop" class="back-to-top" aria-label="Back to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- Popup Modal -->
    <div class="popup-overlay" id="popupOverlay">
        <div class="popup-modal">
            <button class="popup-close" id="popupClose" aria-label="Close popup">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="popup-content">
                <h3 class="popup-title">Seats Are Filling Fast! Register Now!</h3>
                <p class="popup-subtitle">Secure your free seat for the Data Analytics Gen AI Masterclass</p>
                <form class="popup-form" id="registerForm2" novalidate>
                    <div class="field">
                        <label for="popupFullName">Full Name *</label>
                        <input id="popupFullName" name="firstname" type="text" required />
                    </div>
                    <div class="field">
                        <label for="popupEmail">Email *</label>
                        <input id="popupEmail" name="email" type="email" required />
                    </div>
                    <div class="field">
                        <label for="popupPhone">Phone Number *</label>
                        <div class="phone-row">
                            <select aria-label="Country code">
                                <option value="+91">+91</option>
                            </select>
                            <input id="popupPhone" name="mobileno" type="tel" minlength="10" maxlength="10" required />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Register Now</button>
                </form>
            </div>
        </div>
    </div>

</body>

<script src="/assets/dit/js/data_analytics_gen_ai_masterclass_page.js"></script>
<!-- <script src="./data_analytics_gen_ai_masterclass_page.js"></script> -->

</html>