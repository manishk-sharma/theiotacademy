import React, { useEffect } from 'react';

const Footer = () => {
  useEffect(() => {
    // Scroll detection for sticky header
    let lastScrollTop = 0;
    const header = document.querySelector('header');
    const handleScroll = () => {
      const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
      if (header) {
        if (currentScroll > lastScrollTop) {
          header.style.position = 'static';
        } else {
          header.style.position = 'sticky';
        }
      }
      lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    };
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <>
      {/* footer */}
      <footer id="rs-footer" className="comonListActive">
        <div className="container-fluid">
          <div className="row gy-4">
            <div className="col-lg-3 f-top">
              <img
                decoding="async"
                loading="lazy"
                src="https://www.theiotacademy.co/assets/dit/images/navbar/footer-logo.svg"
                alt="iot-logo"
                className="img-fluid footer-logo"
                width="205"
                height="125"
              />
              <p className="footer-logo-copyright">Copyright &copy; The IoT Academy</p>
              <p className="f-head">CONTACT US</p>
              <ul>
                <li>
                  <a href="tel:+919354068856" aria-label="tel">
                    <img
                      src="https://www.theiotacademy.co/assets/dit/images/navbar/call-icon.svg"
                      alt="call-icon"
                      className="img-fluid"
                      width="24"
                      height="24"
                      loading="lazy"
                    />
                    +91-9354068856
                  </a>
                </li>
                <li>
                  <a href="mailto:info@theiotacademy.co" aria-label="mail">
                    <img
                      src="https://www.theiotacademy.co/assets/dit/images/navbar/mail-icon.svg"
                      alt="mail-icon"
                      className="img-fluid"
                      width="24"
                      height="24"
                      loading="lazy"
                    />
                    info@theiotacademy.co
                  </a>
                </li>
              </ul>
            </div>
            <div className="col-lg-3 col-md-4">
              <p className="f-head">RESOURCES</p>
              <ul className="a-underline">
                <li><a href="https://www.theiotacademy.co/blog/" target="_blank" rel="noreferrer">Blog</a></li>
                <li><a href="https://www.theiotacademy.co/salary-predictor" target="_blank" rel="nofollow noopener noreferrer">Salary Predictor</a></li>
                <li><a href="https://www.forum.upskillcampus.com/" target="_blank" rel="nofollow noopener noreferrer">Discussion Forum</a></li>
                <li><a href="https://job.uctconsulting.com/" target="_blank" rel="nofollow noopener noreferrer">Job Portal</a></li>
                <li><a href="https://www.upskillcampus.com/ticket-to-corporate" target="_blank" rel="nofollow noopener noreferrer">Ticket To Corporate</a></li>
                <li><a href="https://www.theiotacademy.co/industrial-visit" target="_blank" rel="nofollow noopener noreferrer">Industrial Visit</a></li>
              </ul>
            </div>
            <div className="col-lg-3 col-md-4">
              <p className="f-head">QUICK LINKS</p>
              <ul className="a-underline">
                <li><a href="/verify-certificate" target="_blank" rel="noreferrer">Verify Certificate</a></li>
                <li><a href="/startup-seed-fund-program" target="_blank" rel="noreferrer">Startup Seed Fund Program</a></li>
                <li><a href="/about-us" target="_blank" rel="noreferrer">About Us</a></li>
                <li><a href="/contact" target="_blank" rel="noreferrer">Contact Us</a></li>
                <li><a href="/events" target="_blank" rel="noreferrer">Events</a></li>
                <li><a href="/our-placements" target="_blank" rel="noreferrer">Our Placements</a></li>
                <li><a href="/short-term-courses" target="_blank" rel="noreferrer">Short Term Courses</a></li>
                <li><a href="/all-courses" target="_blank" rel="noreferrer">All Courses</a></li>
              </ul>
            </div>
            <div className="col-lg-3 col-md-4">
              <p className="f-head">TRENDING COURSES</p>
              <ul className="a-underline">
                <li><a href="/ds-ml-ai-genai-by-eict-iitroorkee" target="_blank" rel="noreferrer">Professional Program In Data Science, Machine Learning, AI & GenAI by E&ICT Academy, IIT Roorkee</a></li>
                <li><a href="/data-analytics-and-gen-ai-by-eict-iit-roorkee" target="_blank" rel="noreferrer">Advanced Program in Applied Data Analytics & Generative AI by E&ICT Academy, IIT Roorkee</a></li>
                <li><a href="/embedded-systems-training-with-ai" target="_blank" rel="noreferrer">AI-Powered Embedded & IoT Program</a></li>
                <li><a href="/data-analyst-with-genai-and-agenticai-course" target="_blank" rel="noreferrer">Master Data Analytics + Gen AI & Agentic AI</a></li>
              </ul>
            </div>
          </div>
          <div className="social-media">
            <p className="f-head">FOLLOW US</p>
            <ul className="a-underline">
              <li>
                <a href="https://www.facebook.com/academyforiot/" aria-label="facebook" target="_blank" rel="nofollow noopener noreferrer">
                  <img loading="lazy" src="https://www.theiotacademy.co/assets/dit/images/navbar/facebook-icon.svg" alt="facebook" className="img-fluid" width="25" height="24" />
                </a>
              </li>
              <li>
                <a href="https://instagram.com/the_iot_academy" aria-label="instagram" target="_blank" rel="nofollow noopener noreferrer">
                  <img loading="lazy" src="https://www.theiotacademy.co/assets/dit/images/navbar/instagram-icon.svg" alt="instagram" className="img-fluid" width="25" height="24" />
                </a>
              </li>
              <li>
                <a href="https://www.youtube.com/channel/UCyIXtUMsOX02mpi5PKex9aA" aria-label="youtube" target="_blank" rel="nofollow noopener noreferrer">
                  <img loading="lazy" src="https://www.theiotacademy.co/assets/dit/images/navbar/youtube-icon.svg" alt="youtube" className="img-fluid" width="25" height="24" />
                </a>
              </li>
              <li>
                <a href="https://twitter.com/academyforiot" aria-label="twitter" target="_blank" rel="nofollow noopener noreferrer">
                  <img loading="lazy" src="https://www.theiotacademy.co/assets/dit/images/navbar/twitter-icon.svg" alt="twitter" className="img-fluid" width="24" height="24" />
                </a>
              </li>
              <li>
                <a href="https://www.linkedin.com/school/theiotacademy/" aria-label="linkedin" target="_blank" rel="nofollow noopener noreferrer">
                  <img loading="lazy" src="https://www.theiotacademy.co/assets/dit/images/navbar/linkedin-icon.svg" alt="linkedin" className="img-fluid" width="25" height="24" />
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div className="copyright">
          <div className="container-fluid">
            <ul>
              <li><a href="/term-and-condition" target="_blank" rel="noreferrer">Term & Conditions</a></li>
              <li><a href="/privacy-policies" target="_blank" rel="noreferrer">Privacy Policy</a></li>
              <li><a href="/refund-policies" target="_blank" rel="noreferrer">Refund Policy</a></li>
              <li><a href="/disclaimer" target="_blank" rel="noreferrer">Disclaimer</a></li>
            </ul>
            <p>
              &copy; 2013 - {new Date().getFullYear()}{' '}
              <a href="/" className="a-underline">The IoT Academy</a>. All Rights Reserved, The EdTech Entity of{' '}
              <a href="https://www.uniconvergetech.in/" className="a-underline" target="_blank" rel="noreferrer">
                UniConverge Technologies Pvt. Ltd
              </a>
            </p>
          </div>
        </div>
      </footer>

      {/* WhatsApp float icon */}
      <div className="cmn--headerli-wts-icon" role="presentation">
        <a
          title="Text Us On WhatsApp"
          href="https://api.whatsapp.com/send?phone=+919354068856&text=Hi,%20I%20contacted%20you%20through%20your%20website."
          aria-label="Text us on WhatsApp"
          target="_blank"
          rel="noreferrer"
        >
          <span className="onenumberwtsft">1</span>
          <img
            decoding="async"
            loading="lazy"
            src="https://www.theiotacademy.co/assets/images/socialicons/whatsappdownload.webp"
            alt="whatsapp"
            width="100"
            height="104"
            className="img-fluid"
          />
        </a>
      </div>
    </>
  );
};

export default Footer;

