import fs from 'fs';
import { parseHtmlToJsx } from './domToJsx.js';

const indexPhpPath = 'c:/xampp/htdocs/theiotacademy/application/views/index.php';
const content = fs.readFileSync(indexPhpPath, 'utf-8');
const lines = content.split('\n');

// Body is from line 153 to 6683
const bodyLines = lines.slice(152, 6682);
const bodyHtml = bodyLines.join('\n');
console.log('Total body lines extracted:', bodyLines.length);

const bodyJsx = parseHtmlToJsx(bodyHtml);

const homeComponent = `import React, { useEffect, useState } from 'react';
import Header from '../components/includes/Header';
import Footer from '../components/includes/Footer';
import { submitEnquiry } from '../services/api';

const Home = () => {
  const [enqLoading, setEnqLoading] = useState(false);
  const [enqSuccess, setEnqSuccess] = useState('');
  const [enqError, setEnqError] = useState('');

  useEffect(() => {
    if (typeof window !== 'undefined' && window.Swiper) {
      try {
        new window.Swiper('.bannerSwiper', {
          slidesPerView: 1,
          loop: true,
          autoplay: { delay: 4500, disableOnInteraction: false },
          pagination: { el: '.swiper-pagination', clickable: true }
        });

        new window.Swiper('.clientreviewswiper', {
          slidesPerView: 4,
          spaceBetween: 20,
          freeMode: true,
          loop: true,
          breakpoints: {
            280: { slidesPerView: 1, spaceBetween: 20 },
            320: { slidesPerView: 1, spaceBetween: 20 },
            480: { slidesPerView: 2, spaceBetween: 20 },
            768: { slidesPerView: 3, spaceBetween: 20 },
            1200: { slidesPerView: 4, spaceBetween: 20 }
          },
          autoplay: { delay: 3500, disableOnInteraction: false },
          pagination: { el: '.swiper-pagination3', clickable: true }
        });

        new window.Swiper('.expertiseswiper', {
          slidesPerView: 3,
          spaceBetween: 30,
          freeMode: true,
          loop: true,
          breakpoints: {
            280: { slidesPerView: 1, spaceBetween: 20 },
            320: { slidesPerView: 1, spaceBetween: 20 },
            480: { slidesPerView: 2, spaceBetween: 30 },
            768: { slidesPerView: 2, spaceBetween: 30 },
            1200: { slidesPerView: 3, spaceBetween: 30 }
          },
          autoplay: { delay: 3500, disableOnInteraction: false }
        });
      } catch (e) {
        console.warn('Swiper init error:', e);
      }
    }
  }, []);

  const handleEnquirySubmit = async (e) => {
    e.preventDefault();
    setEnqLoading(true);
    setEnqError('');
    setEnqSuccess('');

    try {
      const formData = new FormData(e.target);
      formData.set('url_source', window.location.href);
      const res = await submitEnquiry(formData);
      setEnqLoading(false);

      if (res.message === 'success') {
        setEnqSuccess(res.response || 'Enquiry Submitted Successfully!');
        e.target.reset();
        setTimeout(() => setEnqSuccess(''), 15000);
      } else {
        setEnqError(res.response || 'Submission failed. Please check inputs.');
        setTimeout(() => setEnqError(''), 15000);
      }
    } catch (err) {
      setEnqLoading(false);
      setEnqError('Something went wrong. Please try again.');
      setTimeout(() => setEnqError(''), 15000);
    }
  };

  return (
    <>
      <Header />
      <main>
        {enqLoading && (
          <div id="enqform-overlay" style={{ display: 'block' }}>
            <div className="enqform-cv-spinner">
              <span className="enqform-spinner"></span>
            </div>
          </div>
        )}
        {enqSuccess && (
          <div id="success-msg" className="alert alert-success position-fixed top-0 end-0 m-4 z-3" style={{ display: 'block' }}>
            {enqSuccess}
          </div>
        )}
        {enqError && (
          <div id="error-msg" className="alert alert-danger position-fixed top-0 end-0 m-4 z-3" style={{ display: 'block' }}>
            {enqError}
          </div>
        )}

        ${bodyJsx}
      </main>
      <Footer />
    </>
  );
};

export default Home;
`;

fs.writeFileSync('c:/xampp/htdocs/theiotacademy/frontend/src/pages/Home.jsx', homeComponent, 'utf-8');
console.log('Successfully written frontend/src/pages/Home.jsx with DOM parser!');
