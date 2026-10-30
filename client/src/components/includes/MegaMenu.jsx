import React, { useEffect } from 'react';

const MegaMenu = () => {
  useEffect(() => {
    // Load mega menu script if not already present
    if (!document.getElementById('megamenu-script')) {
      const script = document.createElement('script');
      script.id = 'megamenu-script';
      script.src = '/assets/dit/js/new-megamenu.js';
      script.defer = true;
      document.body.appendChild(script);
    }
  }, []);

  return (
    <>
      <section className="new-megamenu-desktop d-none d-lg-block">
        <div className="container-fluid">
          <div className="megamenu-grid">
            {/* Navigation Starts */}
            <div className="megamenu-navigation">
              <div
                className="navigation-header sticky-top d-flex justify-content-center align-items-center px-3"
                style={{
                  minHeight: '70px',
                  gap: '20px'
                }}
              >
                <h5
                  className="m-0"
                  style={{
                    color: '#FFF',
                    fontFamily: 'Inter',
                    fontSize: '18px',
                    fontStyle: 'normal',
                    fontWeight: 700,
                    lineHeight: 'normal'
                  }}
                >
                  E&ICT Academy, IIT Roorkee Programs
                </h5>
              </div>

              <div className="primary-navigation">
                <ul className="list-unstyled m-0"></ul>
              </div>

              <div className="secondary-navigation">
                <ul className="list-unstyled m-0"></ul>
              </div>
            </div>
            {/* Navigation Ends */}

            {/* Megamenu Content Starts */}
            <div className="megamenu-content-container position-relative">
              <div className="megamenu-content"></div>
              <div className="megamenu-banner position-absolute d-flex">
                <img
                  className="w-100"
                  loading="lazy"
                  src="https://www.theiotacademy.co/assets/dit/images/navbar/new-megamenu-banner-secondary02.webp"
                  alt="Mega menu banner"
                />
              </div>
            </div>
            {/* Megamenu Content Ends */}
          </div>
        </div>
      </section>
      <div className="megamenu-backdrop" id="megamenu-backdrop"></div>
    </>
  );
};

export default MegaMenu;

