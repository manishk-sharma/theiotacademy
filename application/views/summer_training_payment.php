<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QR Payment</title>
   <link rel="icon" href="https://www.theiotacademy.co/assets/images/iot-academy-favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="canonical" href="https://www.theiotacademy.co/payment" />
    <meta name="subject" content="Best IT Training Institute in Delhi NCR">
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="yahooSeeker" content="noindex, nofollow" />
    <meta name="msnbot" content="noindex, nofollow" />
    <meta name="copyright" content="The IoT Academy">
    <meta name="Revisit-after" content="1 Days" />
    <meta name="Classification" content="Education/Training">
    <meta name="author" content="The IoT Academy, info@theiotacademy.co">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  <style>
      body::-webkit-scrollbar {
      width: 0;
    }
    .payment-sec{
        padding: 20px;
    }
    .payment-sec .head-part{
       margin-bottom: 20px;
       align-items: center;
    }
    .payment-sec .head-part p{
        color: #000;
        text-align: center;
        font-family: Inter;
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
       margin-bottom: 0;
    }
    .payment-sec .center-part{
        border-radius: 20px;
        background: #FFF;
        box-shadow: 0px 4px 20px 4px rgba(0, 0, 0, 0.10);
        padding: 30px;
    }
    .payment-sec .center-part .left-box{
        border-radius: 20px;
        background: #0D337E;
        padding: 30px 20px;
        height: 100%;
    }
    .payment-sec .center-part .left-box .heading{
        color: #FFF;
        text-align: center;
        font-family: Inter;
        font-size: 25px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        margin-bottom: 30px;
    }
    .payment-sec .center-part .left-box .form-control, .payment-sec .center-part .left-box .form-select{
        border-radius: 10px;
        background: #1341A0;
        min-height: 43px;
        padding: 12px 20px;
        margin-bottom: 10px;
        color: #FFF;
        font-family: Inter;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        box-shadow: none;
        outline: none;
        border: none;
    }
    .payment-sec input:-internal-autofill-selected, .payment-sec input:-webkit-autofill{
        box-shadow: 0 0 0px 1000px #1341A0 inset !important;
        -webkit-text-fill-color: #fff;
        transition: none;
    }
    .payment-sec .center-part .left-box .form-select{
        appearance: none; /* Removes default styling */
      -webkit-appearance: none;
      -moz-appearance: none;

      background-color: #1341A0;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 32 32'%3E%3Cpath fill='none' stroke='%23ffffff' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 0 top 10px;
      padding: 12px 40px 12px 20px;
    }
    .payment-sec .center-part .left-box .form-control::placeholder{
        color: #FFF;
    }
    .payment-sec .center-part .left-box .add-screenshot {
      display: inline-flex;
      align-items: center;
      justify-content: space-between;
      background-color: #0f3f96; /* Blue background */
      color: #fff;
      font-family: Inter, sans-serif;
      font-size: 16px;
      font-weight: 400;
      padding: 12px 20px;
      border-radius: 10px;
      cursor: pointer;
      width: 100%;
      max-width: 400px;
      box-shadow: none;
      border: none;
      transition: background 0.3s;
    }
    .payment-sec .center-part .left-box .add-screenshot label{
        cursor: pointer;   
        display: contents;
    }
    
    .payment-sec .center-part .left-box .add-screenshot svg {
      margin-left: 10px;
      width: 20px;
      height: 20px;
      fill: white;
    }
    
    .payment-sec .center-part .left-box .add-screenshot input[type="file"] {
      display: none;
    }
    .payment-sec .center-part .left-box .btn-group{
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
    }
    .payment-sec .center-part .left-box .btn-group .blue-btn{
        display: inline-flex;
        padding: 10px 20px;
        justify-content: center;
        align-items: center;
        gap: 10px;
        color: #0D327E;
        text-align: center;
        font-family: Inter;
        font-size: 16px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        border-radius: 10px;
        background: #FFF;
    }
    .payment-sec .center-part .right-box{
        border-radius: 20px;
        border: 1px solid #000;
        background: #fff;
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        gap: 20px;
        text-align: center;
        height: 100%;
    }
    .payment-sec .center-part .right-box .heading{
        color: #0D327E;
        text-align: center;
        font-family: Inter;
        font-size: 30px;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
        margin-bottom: 0;
    }
    .payment-sec .center-part .right-box .heading span{
        border-radius: 5px;
        background: #ECF2FF;
        padding: 6px 20px;
    }
    .payment-sec .center-part .right-box .note{
        color: #000;
        text-align: center;
        font-family: Inter;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        margin-bottom: 0;
    }
    .payment-sec .center-part .right-box .info, .payment-sec .center-part .right-box .info a{
        display: inline-block;
        background: #1341A0;
        color: #fff;
        text-align: center;
        font-family: Inter;
        font-size: 16px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        margin-bottom: 0;
        text-decoration: none;
        border-radius: 10px;
        padding: 10px 20px;
    }
    @media screen and (max-width: 768px) {
        .payment-sec .head-part{
            justify-content: center;
            gap: 20px;
            text-align: center;
        }
        .payment-sec .center-part{
            row-gap: 30px;
            padding: 20px;
        }
        .payment-sec .center-part .right-box{
            padding: 20px;
        }
        .payment-sec .center-part .left-box .heading, .payment-sec .center-part .right-box .heading{
            font-size: 22px;
        }
    }

    #enqform-overlay{position:fixed;top:0;z-index:1200;width:100%;height:100%;display:none;background:rgba(0,0,0,.6)}
.enqform-cv-spinner{height:100%;display:flex;justify-content:center;align-items:center}
.enqform-spinner{width:40px;height:40px;border:4px #ddd solid;border-top:4px #2e93e6 solid;border-radius:50%;animation:sp-anime .8s infinite linear}
@keyframes sp-anime{100%{transform:rotate(360deg)}}
  </style>
</head>
<body>
    <div id="enqform-overlay">
        <div class="enqform-cv-spinner">
            <span class="enqform-spinner"></span>
        </div>
    </div>
    <section class="payment-sec">
        <div class="container">
            <div class="head-part row">
                <div class="col-md-4">
                    <img src="https://www.theiotacademy.co/assets/dit/images/navbar/logo.svg" alt="the IoT Academy Logo" class="img-fluid" width="122" height="75">
                </div>
                <div class="col-md-8">
                    <p><strong>The IoT Academy</strong> Ed-tech Entity of <strong>UniConverge Technologies Pvt. Ltd.</strong></p>
                </div>
            </div>
            <div class="row center-part">
                <div class="col-md-4">
                    <div class="left-box">
                        <h1 class="heading">Payment Details Form</h1>
                        <form class="form_of_payment_dtcf" id="Payment_Details_Submit" method="post"enctype="multipart/form-data" onsubmit="return false;">
                            <input type="hidden" name="url_source" id="enqurl_source">
                            <input type="text" name="fullname" class="form-control" placeholder="Full Name*">
                            <input type="email" name="email" class="form-control" placeholder="Email ID*">
                            <input type="tel" name="mobile" class="form-control" placeholder="Mobile Number*" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" minlength="9" maxlength="10">
                            <select class="form-select" name="program_name" aria-label="Default select example">
                                <option value="" selected>Program Name*</option>
                                <option value="IoT & Embedded Systems">IoT & Embedded Systems</option>
                                <option value="Data Analytics">Data Analytics</option>
                                <option value="Data Science & Machine Learning">Data Science & Machine Learning</option>
                            </select>
                            <!-- <input type="text" name="program_name" class="form-control" placeholder="Program Name*"> -->
                            <input type="text" name="college_name" class="form-control" placeholder="College Name*">
                            <input type="text" name="location" class="form-control" placeholder="Location*">
                            <div class="add-screenshot">
                                <label for="screenshot">
                                <span id="file-name">Add Screenshot of Your Payment</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.5528 8.45986C10.9943 9.15545 9.23032 10.7168 8.55099 13.2877C7.87479 15.848 8.61042 18.0743 10.5227 19.9728C10.3926 19.9841 10.3069 19.9972 10.2218 19.9972C8.22009 19.9985 6.21838 20.0035 4.21604 19.996C1.84402 19.9872 0.00995523 18.1613 0.00495096 15.7942C-0.00255544 11.8634 -0.000678843 7.93316 0.00495096 4.00231C0.00807863 2.16261 1.50498 0.412367 3.32779 0.115864C3.74689 0.047681 4.17601 0.0139022 4.60075 0.00827237C5.65352 -0.00674045 6.70692 0.00326809 7.75969 0.00326809C8.12792 0.00326809 8.31225 0.192805 8.31267 0.571878C8.31267 2.2921 8.31267 4.01231 8.31267 5.73316C8.31267 6.76028 8.74616 7.55784 9.65068 8.037C9.99535 8.21966 10.4201 8.30598 10.8142 8.32912C11.6142 8.37541 12.4187 8.34852 13.2219 8.35352C13.3219 8.35415 13.422 8.36791 13.5221 8.37541C13.5321 8.40356 13.5421 8.43234 13.5528 8.46049V8.45986Z" fill="white"/>
                                    <path d="M15.0184 10.0143C17.7526 10.0224 19.9976 12.2862 19.9964 15.0323C19.9951 17.7321 17.7076 20.0066 14.9952 19.9947C12.338 19.9828 9.97534 17.8629 10.0097 14.8334C10.0391 12.2312 12.3355 10.0056 15.0184 10.0143ZM14.1683 16.4267H14.1702C14.1702 16.7807 14.1639 17.1354 14.1714 17.4894C14.1833 18.0161 14.5055 18.3389 15.0046 18.3377C15.4932 18.337 15.8278 18.003 15.8385 17.4832C15.8491 16.9521 15.8416 16.4204 15.8422 15.8893C15.8422 15.318 16.1229 15.0257 16.6842 15.0123C16.6948 15.0123 16.7048 15.0123 16.7155 15.0123C17.0614 15.0123 17.3103 14.8678 17.4555 14.5432C17.5968 14.2273 17.4861 13.9658 17.2778 13.7437C16.8794 13.3184 16.4765 12.8949 16.0486 12.5002C15.4187 11.9191 14.6155 11.9028 13.9988 12.4664C13.5459 12.8799 13.123 13.3278 12.7039 13.7763C12.5037 13.9902 12.408 14.2473 12.5532 14.5501C12.6995 14.8553 12.9291 15.0111 13.2663 15.0123C13.4639 15.0123 13.6622 15.0205 13.8599 15.0129C14.0895 15.0042 14.1758 15.1099 14.1702 15.3338C14.1608 15.6979 14.1677 16.0632 14.1677 16.4273L14.1683 16.4267Z" fill="white"/>
                                    <path d="M16.2363 6.62265C16.1193 6.63642 16.0399 6.65331 15.9604 6.65331C14.3234 6.65456 12.6864 6.65581 11.0494 6.65205C10.4695 6.6508 10.2062 6.48942 10.0617 6.0653C10.0323 5.97835 10.0147 5.88265 10.0141 5.79069C10.011 4.07048 10.0116 2.34963 10.0129 0.629415C10.0129 0.57124 10.0323 0.513065 10.0485 0.419861C10.7241 0.667572 11.3221 1.00724 11.8132 1.48577C12.9698 2.61361 14.1064 3.76209 15.2286 4.92433C15.679 5.39035 16.0086 5.94958 16.2351 6.62265H16.2363Z" fill="white"/>
                                    </svg>
                                </label>
                                <input type="file" id="screenshot" name="screenshot" class="form-control" accept="image/*">
                            </div>
                            <div class="btn-group">
                                <input type="submit" value="Submit" class="blue-btn">
                            </div>
                            <div id="Successdvpp" class="alert alert-success alert-dismissible d-none text-center mt-2" role="alert">
                                <span id="SuccessAlert"></span>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </form>
                    </div>
                </div>                
                <div class="col-md-8">
                    <div class="right-box">
                        <h2 class="heading"><span>Scan QR Code</span></h2>
                        <div class="qr_iamge">
                            <img src="https://www.theiotacademy.co/assets/dit/images/qr-image-payment.png" alt="qr code scan" class="img-fluid" width="221" height="221">
                        </div>
                        <div class="upi-icons">
                            <img src="https://www.theiotacademy.co/assets/dit/images/payment-image-upi.png" alt="Paytm">
                        </div>
                        <p class="note">Scan the QR Code with any UPI apps like BHIM, Paytm, Google Pay, PhonePe or any Banking UPI app to make payment for this order.</p>
                        <p class="info"><strong>If you have any queries connect us</strong><br><a href="tel:+9198118 46919">Phone: 98118 46919</a><a href="mailto:info@theiotacademy.co">Email: info@theiotacademy.co</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
  <script>
    setTimeout(() => {
        const script = document.createElement("script");
        script.src = "https://www.theiotacademy.co/assets/dit/js/payment_backend_ajax.js?v=<?= time()?>";
        script.defer = true;
        document.head.appendChild(script);
    }, 2000);
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    const fileInput = document.getElementById('screenshot');
    const fileNameDisplay = document.getElementById('file-name');

    fileInput.addEventListener('change', function () {
      if (this.files && this.files.length > 0) {
        const file = this.files[0];
        fileNameDisplay.textContent = `${file.name}`;
      } else {
        fileNameDisplay.textContent = '';
      }
    });
  </script>
</body>
</html>
