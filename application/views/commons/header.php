<?php if (!ini_get('date.timezone')) {
	date_default_timezone_set('Asia/Kolkata');
} ?>
<!-- ajax loader -->

<div id="enqform-overlay">
    <div class="enqform-cv-spinner">
        <span class="enqform-spinner"></span>
    </div>
</div>
<!-- ajax loader -->
<header class="header">
    <div style="padding: 0 7%;">
        <div class=" header-inner row justify-content-between align-items-center">

            <div>

                <div class="nhs-1-inner">
                    <a href="<?= base_url() ?>">
                        <img decoding="async" loading="lazy" class="nhs-1-logo" src="<?php echo asset_url() ?>images/the-iot-logo-new.webp" alt="the IoT Academy Logo">
                    </a>
                    <a href="<?php echo base_url()?>all-courses" class="allndeskancrhdr"><button
                            class="allCourseBtn ml-5"> All Courses <img decoding="async" loading="lazy" class="ml-3"
                                src="<?php echo asset_url() ?>images/newHomePage/downArrow.webp" alt="downArrow"
                                srcset=""></button></a>
                    <button class="allCourseBtnfp ml-4">All Courses <img decoding="async" loading="lazy"
                            style="width: 13px;" class="ml-3"
                            src="<?php echo asset_url() ?>images/newHomePage/downArrow.webp" alt="downArrow"
                            srcset=""></button>
                </div>

            </div>

            <div class="tg-navigationarea col-lg-auto order-lg-2">
                <nav id="tg-nav" class="tg-nav">
                    <div class="navbar-header mobnav">
                        <button class="menu-toggle btn-open first">
                            <span></span>
                        </button>
                    </div>
                    <div id="tg-navigation" class="collapse navbar-collapse tg-navigation main-menu">
                        <ul>
                            <li>
                                <div class="search-span">
                                    <input class="nhs-search-input" name="keyValue" onkeyup="SearchDataForm(this)"
                                        required="required" autocomplete="off" placeholder="Search courses......."
                                        style="width: 150px;" />
                                    <button type="submit" class="hidden-xs rs-search" type="button" aria-label="name">
                                        <i style="color:grey" class="fa fa-search"></i>
                                    </button>
                                </div>
                            </li>

                            <li class="menu-item-has-children prelative">
                                <a href="javascript:void(0);"><span class="nhs-navlink">Resources <i
                                            class="fa fa-angle-down"></i></span></a>
                                <ul class="sub-menu">
                                    <li><a target="_blank" href="https://www.upskillcampus.com/salary-predictor">Salary
                                            Predictor</a></li>
                                    <li><a target="_blank" href="https://www.forum.upskillcampus.com/">Discussion
                                            Forum</a></li>
                                    <li><a target="_blank" href="<?=base_url()?>careers">Careers</a></li>
                                    <li><a target="_blank"
                                            href="https://www.upskillcampus.com/ticket-to-corporate">Ticket To
                                            Corporate</a></li>
                                    <li><a href="<?php echo base_url(); ?>our-placements">Our Placements</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url(); ?>blog"><span class="nhs-navlink">Blog</span></a></li>
                            <li><a href="https://job.uctconsulting.com/"><span class="nhs-navlink">Job Portal <span
                                            class="upspanclsjobiconh"><img decoding="async" loading="lazy"
                                                src="https://s3-tiaimgv1.s3.ap-south-1.amazonaws.com/images/webpageicon/icon-of-job-portalh.jpg"
                                                class="header-job-portal-icon-img" alt="handbag-logo-zip" /></span>
                                    </span></a></li>
                            <li class="menu-item-has-children prelative">
                                <a href="javascript:void(0);" class="home_button_effect allCourseBtn"><span
                                        class="nhs-navlink text-white">Login <i class="fa fa-angle-down"></i></span></a>
                                <ul class="sub-menu studn-emlogjin">

                                    <li><a target="_blank"
                                            href="https://learn.upskillcampus.com/s/dashboard">Student Login</a>
                                    </li>
                                    <li><a href="https://theiotacademy.co:2096/">Employer Login</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>


            <!-- Header Menu End -->
        </div>
    </div>
    <div class="searchData">
        <ul class="search-menu" id="search-menu">
        </ul>
    </div>
</header>

<section class="container-fluid nsh-all-courses-hover">
    <div class="row nsh-ach-inner">
        <div class="p-0">
            <div class="nsh-ach-left">
                <div class="nsh-achl-each courses-active-tab2 finanace">
                    <span>Data Science/Machine Learning</span>
                    <img decoding="async" loading="lazy" class="courses-active-icon"
                        src="<?php echo asset_url() ?>images/newHomePage/rightArrow.webp" alt="rightArrow">
                </div>
                <div class="nsh-achl-each mlandai">
                    <span>Hybrid Course (Self Paced - Live) <span class="badge badge-pill badge-danger"
                    style="font-size:10px;">New</span></span>
                    <img decoding="async" loading="lazy"
                        src="<?php echo asset_url() ?>images/newHomePage/rightArrow.webp" alt="rightArrow">
                </div>
                <div class="nsh-achl-each newanalyticscourse">
                    <span>Data Analyst</span>
                    <img decoding="async" loading="lazy" class="courses-active-icon"
                        src="<?php echo asset_url() ?>images/newHomePage/rightArrow.webp" alt="rightArrow">
                </div>
                <div class="nsh-achl-each analytics">
                    <span>Java</span>
                    <img decoding="async" loading="lazy"
                        src="<?php echo asset_url() ?>images/newHomePage/rightArrow.webp" alt="rightArrow">
                </div>
                <div class="nsh-achl-each technology">
                    <span>Digital Marketing</span>
                    <img decoding="async" loading="lazy"
                        src="<?php echo asset_url() ?>images/newHomePage/rightArrow.webp" alt="rightArrow">
                </div>
                <div class="nsh-achl-each marketing">
                    <span>Python</span>
                    <img decoding="async" loading="lazy"
                        src="<?php echo asset_url() ?>images/newHomePage/rightArrow.webp" alt="rightArrow">
                </div>
                <div class="nsh-achl-each management">
                    <span>Embedded Systems & IoT</span>
                    <img decoding="async" loading="lazy"
                        src="<?php echo asset_url() ?>images/newHomePage/rightArrow.webp" alt="rightArrow">
                </div>
            </div>
        </div>
        <div class="nsh-ach-right finanace d-flex">

            <div class="nsh-achr-inner">

                <a
                    href="<?= base_url(); ?>advanced-certification-in-data-science-machine-learning-and-iot-by-eict-iitg">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="nsh-java-small-upper">
                            <img decoding="async" loading="lazy"
                                src="<?php echo asset_url() ?>images/newHomePage/home-eict-logo.webp" alt="eict-logo">
                        </div>
                        <div class="ml-4 nsh-achr-info">
                            <p class="nsh-achr-p1">Advanced Certification in Applied Data Science, Machine Learning &
                                IoT By E&ICT Academy, IIT Guwahati</p>
                            <p class="nsh-achr-p2">9 months</p>
                        </div>
                    </div>
                </a>
                <a
                    href="<?= base_url(); ?>online-certification-in-applied-data-science-machine-learning-edge-ai-by-eict-academy-iit-guwahati">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="nsh-java-small-upper">
                            <img decoding="async" loading="lazy"
                                src="<?php echo asset_url() ?>images/newHomePage/home-eict-logo.webp" alt="eict-logo">
                        </div>
                        <div class="ml-4 nsh-achr-info">
                            <p class="nsh-achr-p1">Online Certification in Applied Data Science, Machine Learning and
                                Edge AI By E&ICT Academy, IIT Guwahati </p>
                            <p class="nsh-achr-p2">6 months</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="nsh-achr-inner">

                <a href="<?= base_url(); ?>machine-learning-with-python-training-in-noida">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="nsh-java-small-upper">
                            <img decoding="async" loading="lazy"
                                src="<?php echo asset_url() ?>images/newHomePage/dsh-icon2.webp" alt="mindset-logo">
                        </div>
                        <div class="ml-4 nsh-achr-info">
                            <p class="nsh-achr-p1">Certification in Data Science and Machine Learning With Python By The
                                IoT Academy Noida </p>
                            <p class="nsh-achr-p2">180 Hrs</p>
                        </div>
                    </div>
                </a>
            </div>

        </div>

        <div class="nsh-ach-right newanalyticscourse d-none">
            <div class="nsh-achr-inner">
                <a href="<?= base_url(); ?>data-analyst-certification-course">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="nsh-java-small-upper pb-2">
                            <img decoding="async" loading="lazy"
                                src="<?php echo asset_url() ?>images/newHomePage/data-analytics-nav-icon.webp"
                                alt="data-analytics">
                        </div>
                        <div class="ml-4">
                            <p class="nsh-achr-p1">Data Analyst Certification Course by The IoT Academy </p>
                            <p class="nsh-achr-p2">4 months</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>

        <div class="nsh-ach-right analytics d-none">
            <div class="nsh-achr-inner">
                <a
                    href="<?= base_url(); ?>advanced-certification-program-in-full-stack-java-development-by-eict-academy-iit-guwahati">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="nsh-java-small-upper pb-2">
                            <img decoding="async" loading="lazy"
                                src="<?php echo asset_url() ?>images/newHomePage/javaSmall.webp" alt="java-logo">
                        </div>
                        <div class="ml-4">
                            <p class="nsh-achr-p1">Full Stack Java Developer Course by E&ICT Academy, IIT Guwahati </p>
                            <p class="nsh-achr-p2">6 months</p>
                        </div>
                    </div>
                </a>

                <a href="<?= base_url(); ?>java-certification-course-in-noida">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="nsh-java-small-upper pb-3" style="background-color:#21165e;">
                            <img decoding="async" loading="lazy"
                                src="<?php echo asset_url() ?>images/newHomePage/javah-icon2.webp" alt="java-icon">
                        </div>
                        <div class="ml-4">
                            <p class="nsh-achr-p1">Certification Course for Java Full Stack Developer by The IoT Academy
                            </p>
                            <p class="nsh-achr-p2">6 months</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="nsh-ach-right technology d-none">
            <a href="<?= base_url(); ?>digital-marketing-training">
                <div class="nsh-achr-inner">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="nsh-java-small-upper">
                            <img decoding="async" loading="lazy"
                                src="<?php echo asset_url() ?>images/newHomePage/dmh-icon2.webp" alt="speaker-tv">
                        </div>
                        <div class="ml-4">
                            <p class="nsh-achr-p1">Digital Marketing Certification Course By The IoT Academy</p>
                            <p class="nsh-achr-p2">3/7 months</p>
                        </div>
                    </div>

                </div>
            </a>
        </div>
        <div class="nsh-ach-right marketing d-none">
            <div class="nsh-achr-inner">
                <a href="<?= base_url(); ?>python-training">
                    <div class="d-flex justify-content-center align-items-center ">
                        <div class="nsh-java-small-upper">
                            <img decoding="async" loading="lazy"
                                src="<?php echo asset_url() ?>images/newHomePage/pyh-icon1.webp" alt="python-logo">
                        </div>
                        <div class="ml-4">
                            <p class="nsh-achr-p1">Python Certification Course By The IoT Academy</p>
                            <p class="nsh-achr-p2">45 Days</p>
                        </div>
                    </div>
                </a>

            </div>

        </div>

        <div class="nsh-ach-right management d-none">
            <div class="nsh-achr-inner">
                <a href="<?= base_url(); ?>embedded-systems-training">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="nsh-java-small-upper">
                            <img decoding="async" loading="lazy"
                                src="<?php echo asset_url() ?>images/newHomePage/esh-icon1.webp" alt="kit">
                        </div>
                        <div class="ml-4">
                            <p class="nsh-achr-p1">Embedded System Course In Noida By The IoT Academy </p>
                            <p class="nsh-achr-p2">1.5/3/6 months</p>
                        </div>
                    </div>
                </a>
                <a href="<?= base_url(); ?>iot-training">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="nsh-java-small-upper">
                            <img decoding="async" loading="lazy"
                                src="<?php echo asset_url() ?>images/newHomePage/esh-icon2.webp"
                                alt="system netwroking">
                        </div>
                        <div class="ml-4">
                            <p class="nsh-achr-p1">Internet Of Things Course In Noida By TheIoT Academy</p>
                            <p class="nsh-achr-p2">1.5/3/6 months</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
       
        <div class="nsh-ach-right mlandai d-none">
            <div class="nsh-achr-inner">
                
                <a href="<?= base_url(); ?>data-analytics-machine-learning-ai-course">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="nsh-java-small-upper">
                            <img decoding="async" loading="lazy"
                                src="<?php echo asset_url() ?>images/newHomePage/damlgenaiicon.svg"
                                alt="data-analytics-machine-learning-ai">
                        </div>
                        <div class="ml-4">
                            <p class="nsh-achr-p1">Data Analytics, Machine Learning & Generative AI Course</p>
                            <p class="nsh-achr-p2">6 months</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>


    </div>
</section>


<div class="zeynep-overlay"></div>
<div class="zeynep-overlay2"></div>

<div class="zeynep" id="zeynep">
    <ul>
        <li><a href="<?php echo base_url(); ?>blog">Blog</a></li>
        <li class="has-submenu"><a href="#" data-submenu="resources">Resources </a>
            <div id="resources" class="submenu">
                <div class="submenu-header"><a href="#" data-submenu-close="resources">Resources</a></div>
                <ul>
                    <li><a target="_blank" href="https://www.upskillcampus.com/salary-predictor">Salary Predictor</a>
                    </li>
                    <li><a target="_blank" href="https://www.forum.upskillcampus.com/">Discussion Forum</a></li>
                    <li><a target="_blank" href="https://job.uctconsulting.com/">Job Portal</a></li>
                    <li><a target="_blank" href="https://www.upskillcampus.com/ticket-to-corporate">Ticket To
                            Corporate</a></li>
                    <li><a href="<?php echo base_url(); ?>our-placements">Our Placements</a></li>
                    <li><a href="<?php echo base_url(); ?>instructors-apply">Become an Instructor</a></li>
                </ul>
            </div>
        </li>

        <li class="has-submenu"><a href="#" data-submenu="internshipr">Internship </a>
            <div id="internshipr" class="submenu">
                <div class="submenu-header"><a href="#" data-submenu-close="internshipr">Internship</a></div>
                <ul>
                    <li><a href="https://learn.upskillcampus.com/s/pages/basic-internships" target="_blank">Basic</a>
                    </li>
                    <li><a href="https://learn.upskillcampus.com/s/pages/online-paid-internship"
                            target="_blank">Premium</a></li>
                </ul>
            </div>
        </li>
        <li class="has-submenu"><a href="#" data-submenu="stuntemplg">Login </a>
            <div id="stuntemplg" class="submenu">
                <div class="submenu-header"><a href="#" data-submenu-close="stuntemplg">Login</a></div>
                <ul>
                    <li><a href="https://learn.upskillcampus.com/s/dashboard">Student Login</a></li>
                    <li><a href="https://theiotacademy.co:2096/">Employer Login</a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>

<div class="zeynep" id="zeynep2">
    <ul>
        <div class="submenu-header" id='custum-close'>
            <a href="#" data-submenu-close="zeynep2">Course Categories</a>
        </div>
        <ul>
            <li class="has-submenu">
                <a href="#" data-submenu="medical2">
                    <div></div> Data Science / Machine Learning
                </a>
                <div id="medical2" class="submenu">
                    <div class="submenu-header submenu-header-phone"><a href="#" data-submenu-close="medical2">Data
                            Science / Machine Learning</a></div>
                    <label>Top Courses</label>
                    <ul>
                        <li>
                            <a
                                href="<?= base_url(); ?>advanced-certification-in-data-science-machine-learning-and-iot-by-eict-iitg">
                                <div>
                                    <img decoding="async" loading="lazy"
                                        src="<?= asset_url() ?>images/master-course-image/eict-guwahati-logo.jpg"
                                        alt="the iot academy" width="100px" height="25px"><span
                                        style="font-weight: 800;color: #000;font-size: 18px;">|</span>
                                    <span
                                        style="border-radius: 20px;padding: 3px 10px;background: #196ae5;color:#fff;">&nbsp;9
                                        Months</span>
                                </div>
                                Advanced Certification in Applied Data Science, Machine Learning & IoT By E&ICT Academy,
                                IIT Guwahati
                            </a>
                        </li>
                        <li>
                            <a
                                href="<?= base_url(); ?>online-certification-in-applied-data-science-machine-learning-edge-ai-by-eict-academy-iit-guwahati">
                                <div>
                                    <img decoding="async" loading="lazy"
                                        src="<?= asset_url() ?>images/master-course-image/eict-guwahati-logo.jpg"
                                        alt="the iot academy" width="100px" height="25px"><span
                                        style="font-weight: 800;color: #000;font-size: 18px;">|</span>
                                    <span
                                        style="border-radius: 20px;padding: 3px 10px;background: #196ae5;color:#fff;">&nbsp;6
                                        Months</span>
                                </div> Online Certification in Applied Data Science, Machine Learning and Edge AI By
                                E&ICT Academy, IIT Guwahati
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url(); ?>machine-learning-with-python-training-in-noida">
                                <div>Offline
                                    <span style="font-weight: 800;color: #000;font-size: 18px;">|</span>
                                    <span
                                        style="border-radius: 20px;padding: 3px 10px;background: #196ae5;color:#fff;">&nbsp;180
                                        Hrs</span>
                                </div> Certification in Data Science and Machine Learning With Python By The IoT Academy
                                Noida
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="has-submenu">
                <a href="#" data-submenu="anudaksh2">
                <div><span class="badge badge-danger">New</span></div>Hybrid Course (Self Paced - Live)
                </a>
                <div id="anudaksh2" class="submenu">
                    <div class="submenu-header submenu-header-phone"><a href="#" data-submenu-close="anudaksh2">Hybrid Course (Self Paced - Live)</a></div>
                    <label>Top Courses</label>
                    <ul>
                        <li>
                            <a href="<?= base_url(); ?>data-analytics-machine-learning-ai-course">
                                <div>
                                <span
                                        style="border-radius: 20px;padding: 3px 10px;background: #196ae5;color:#fff;">&nbsp;6
                                        months</span>
                                      
                                </div>
                                Data Analytics, Machine Learning & Generative AI Course
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="has-submenu">
                <a href="#" data-submenu="proanatdevelop">
                    Data Analyst
                </a>
                <div id="proanatdevelop" class="submenu">
                    <div class="submenu-header submenu-header-phone"><a href="#" data-submenu-close="proanatdevelop">
                            Data Analyst Certification Course</a></div>
                    <label>Top Courses</label>
                    <ul>

                        <li>
                            <a href="<?= base_url(); ?>data-analyst-certification-course">
                                <div>
                                    <span style="font-weight: 800;color: #000;font-size: 18px;">|</span>
                                    <span
                                        style="border-radius: 20px;padding: 3px 10px;background: #196ae5;color:#fff;">&nbsp;4
                                        months</span><span
                                        style="font-weight: 800;color: #000;font-size: 18px;">|</span>
                                    <span style="padding: 3px 10px;color:#000;">&nbsp;Offline</span>
                                </div>Data Analyst Certification Course By The IoT Academy
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="has-submenu">
                <a href="#" data-submenu="Java-develop2">
                    <div></div>Java
                </a>
                <div id="Java-develop2" class="submenu">
                    <div class="submenu-header submenu-header-phone"><a href="#" data-submenu-close="Java-develop2">Java
                            Development</a></div>
                    <label>Top Courses</label>
                    <ul>
                        <li>
                            <a
                                href="<?= base_url(); ?>advanced-certification-program-in-full-stack-java-development-by-eict-academy-iit-guwahati">
                                <div>
                                    <img decoding="async" loading="lazy"
                                        src="<?= asset_url() ?>images/master-course-image/eict-guwahati-logo.jpg"
                                        alt="the iot academy" width="100px" height="25px"><span
                                        style="font-weight: 800;color: #000;font-size: 18px;">|</span>
                                    <span
                                        style="border-radius: 20px;padding: 3px 10px;background: #196ae5;color:#fff;">&nbsp;6
                                        Months</span>
                                </div>Full Stack Java Developer Course By E&ICT Academy IIT Guwahati
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url(); ?>java-certification-course-in-noida">
                                <div>
                                    <span style="font-weight: 800;color: #000;font-size: 18px;">|</span>
                                    <span
                                        style="border-radius: 20px;padding: 3px 10px;background: #196ae5;color:#fff;">&nbsp;6
                                        Months</span><span
                                        style="font-weight: 800;color: #000;font-size: 18px;">|</span>
                                    <span style="padding: 3px 10px;color:#000;">&nbsp;Offline</span>
                                </div>Certification Course for Java Full Stack Developer by The IoT Academy
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="has-submenu">
                <a href="#" data-submenu="anudaksh2">
                    Digital Marketing
                </a>
                <div id="anudaksh2" class="submenu">
                    <div class="submenu-header submenu-header-phone"><a href="#" data-submenu-close="anudaksh2">Digital
                            Marketing</a></div>
                    <label>Top Courses</label>
                    <ul>
                        <li>
                            <a href="<?= base_url(); ?>digital-marketing-training">
                                <div>
                                    <span
                                        style="border-radius: 20px;padding: 3px 10px;background: #196ae5;color:#fff;">&nbsp;7
                                        Months</span><span
                                        style="font-weight: 800;color: #000;font-size: 18px;">|</span>
                                    <span style="padding: 3px 10px;color:#000;">&nbsp;Online</span>
                                </div>
                                Digital Marketing Certification Course By The IoT Academy
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="has-submenu">
                <a href="#" data-submenu="offline2">
                    Python
                </a>
                <div id="offline2" class="submenu">
                    <div class="submenu-header submenu-header-phone"><a href="#" data-submenu-close="offline2">Python
                            Training</a></div>
                    <label>Top Courses</label>
                    <ul>
                        <li>
                            <a href="<?= base_url(); ?>python-training">
                                <div>
                                    <span
                                        style="border-radius: 20px;padding: 3px 10px;background: #196ae5;color:#fff;">&nbsp;45
                                        Days</span><span style="font-weight: 800;color: #000;font-size: 18px;">|</span>
                                    <span style="padding: 3px 10px;color:#000;">&nbsp;Online</span>
                                </div>
                                Python Certification Course By The IoT Academy
                            </a>
                        </li>

                    </ul>

                </div>
            </li>
            <li class="has-submenu">
                <a href="#" data-submenu="wevdevn">
                     Web Development
                </a>
                <div id="wevdevn" class="submenu">
                    <div class="submenu-header submenu-header-phone"><a href="#" data-submenu-close="wevdevn">Web
                            Development</a></div>
                    <label>Top Courses</label>
                    <ul>
                        <li>
                            <a href="<?= base_url(); ?>full-stack-web-development-course">
                                <div>
                                    <span
                                        style="border-radius: 20px;padding: 3px 10px;background: #196ae5;color:#fff;">&nbsp;6
                                        Weeks / 3 Months</span><span
                                        style="font-weight: 800;color: #000;font-size: 18px;">|</span>
                                    <span style="padding: 3px 10px;color:#000;">&nbsp;Online/offline</span>
                                </div>
                                Full Stack Web Development Course By The IoT Academy
                            </a>
                        </li>

                    </ul>

                </div>
            </li>
            <li class="has-submenu">
                <a href="#" data-submenu="engineering2">Embedded System and IoT</a>
                <div id="engineering2" class="submenu">
                    <div class="submenu-header submenu-header-phone"><a href="#"
                            data-submenu-close="engineering2">Embedded Systems and IoT</a></div>
                    <label>Top Courses</label>
                    <ul>
                        <li>

                            <a href="<?= base_url(); ?>embedded-systems-training">
                                <div class=" box-hover-effect">
                                    <div>
                                        <span class="top-course_menu_duration">1.5M/3M/6M</span> <span
                                            style="font-weight: 800;color: #000;font-size: 18px;"> |</span> <span
                                            style="color:#000;">Offline</span>
                                        <p>Embedded System Course In Noida By The IoT Academy</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>

                            <a href="<?= base_url(); ?>iot-training">
                                <div class=" box-hover-effect">
                                    <div>
                                        <span class="top-course_menu_duration">1.5M/3M/6M</span> <span
                                            style="font-weight: 800;color: #000;font-size: 18px;"> |</span> <span
                                            style="color:#000;">Offline</span>
                                        <p>Internet Of Things Course In Noida By The IoT Academy</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </ul>
</div>
        <div class="cmn--headerli-wts-icon"><a title="Text Us On WhatsApp"
        href="https://api.whatsapp.com/send?phone=+919354068856&amp;text=Hi, I contacted you through your website."><span
            class="onenumberwtsft">1</span><img decoding="async" loading="lazy"
            src="<?= asset_url() ?>images/socialicons/whatsapp-icon.svg" alt="whatsapp" /></a></div>

<?php  $this->load->view("commons/applied-iit-roorkee-alert-box.php")  ?>

<script>
// --------------------show on hover start----------//
const button = document.querySelector('.allCourseBtn');
const innerDiv = document.querySelector('.nsh-all-courses-hover');

button.addEventListener('mouseover', () => {
    innerDiv.style.display = 'block';
    button.children[0].style.transition = 'all .3s'
    button.children[0].style.transform = 'rotateZ(-180deg)'

});

innerDiv.addEventListener('mouseover', () => {
    innerDiv.style.display = 'block';
    button.children[0].style.transition = 'all .3s'
    button.children[0].style.transform = 'rotateZ(-180deg)'
});

innerDiv.addEventListener('mouseout', () => {
    innerDiv.style.display = 'none';
    button.children[0].style.transition = 'all .3s'
    button.children[0].style.transform = 'rotateZ(0deg)'
});

button.addEventListener('mouseout', () => {
    innerDiv.style.display = 'none';
    button.children[0].style.transition = 'all .3s'
    button.children[0].style.transform = 'rotateZ(0deg)'
});


// --------------------show on hover end----------//

// --------------all course change start-------------//

const nshachleft = document.getElementsByClassName('nsh-ach-left')[0].children
const nshachright = [...document.getElementsByClassName('nsh-ach-right')]
const allcourseChange = (e) => {
    Array.from(nshachleft).forEach((element) => {
        element.classList.remove('courses-active-tab2');
        element.children[1].classList.remove('courses-active-icon');
        element.children[1].style.transform = 'rotateZ(0deg)'
    });
    e.target.classList.add('courses-active-tab2')
    e.target.children[1].classList.add('courses-active-icon')
    e.target.children[1].style.transform = 'rotateZ(90deg)';

    nshachright.forEach((element) => {
        element.classList.remove('d-flex');
        element.classList.add('d-none');
    });

    if (e.target.classList.contains('finanace')) {
        nshachright.forEach((element) => {
            // console.log("reached here", element)
            if (element.classList.contains('finanace')) {
                element.classList.add('d-flex')
            }
        })
    } else if (e.target.classList.contains('newanalyticscourse')) {
        nshachright.forEach((element) => {
            if (element.classList.contains('newanalyticscourse')) {
                element.classList.add('d-flex')
            }
        })

    } else if (e.target.classList.contains('analytics')) {
        nshachright.forEach((element) => {
            if (element.classList.contains('analytics')) {
                element.classList.add('d-flex')
            }
        })

    } else if (e.target.classList.contains('technology')) {
        nshachright.forEach((element) => {
            if (element.classList.contains('technology')) {
                element.classList.add('d-flex')
            }
        })


    } else if (e.target.classList.contains('marketing')) {
        nshachright.forEach((element) => {

            if (element.classList.contains('marketing')) {
                element.classList.add('d-flex')
            }
        })
    }
    else if (e.target.classList.contains('mlandai')) {
        nshachright.forEach((element) => {

            if (element.classList.contains('mlandai')) {
                element.classList.add('d-flex')
            }
        })
    }
    else {
        nshachright.forEach((element) => {

            if (element.classList.contains('management')) {
                element.classList.add('d-flex')
            }
        })
    }

}

Array.from(nshachleft).forEach((element) => {


    element.addEventListener("mouseover", (e) => {
        allcourseChange(e)
    });
});



const allCourseBtnf = document.getElementsByClassName('allCourseBtnfp')[0]
const zeynep2 = document.getElementById('zeynep2')
const custumClose = document.getElementById('custum-close')
const zeynepOverlay2 = document.getElementsByClassName('zeynep-overlay2')[0]
const hasSubmenu = [...zeynep2.getElementsByClassName('has-submenu')]
const submenuHeader = [...zeynep2.getElementsByClassName('submenu-header-phone')]

allCourseBtnf.addEventListener("click", (e) => {
    zeynep2.classList.add('opened')
    zeynepOverlay2.style.display = 'block';
});

zeynepOverlay2.addEventListener("click", (e) => {
    zeynep2.classList.remove('opened')
    zeynepOverlay2.style.display = 'none';
});


hasSubmenu.forEach((element) => {

    element.addEventListener("click", (e) => {
        e.stopPropagation();
        e.target.children[1].classList.add('opened')
        e.target.children[1].classList.add('current')
    });
})


submenuHeader.forEach((element) => {
    element.addEventListener("click", (e) => {
        e.stopPropagation();
        e.target.parentNode.classList.remove("opened");
        e.target.parentNode.classList.remove("current");
    });
})

custumClose.addEventListener("click", () => {
    zeynep2.classList.remove('opened')
    zeynepOverlay2.style.display = 'none';
});
// --------------all course change end-------------//
</script>