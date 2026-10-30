<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Verify Certificate | The IoT Academy</title>

    <link href="assets/dit/css/custom.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style type="text/css">
        .start-divveri {

            text-align: center;
            align-items: center;
            margin: auto;
            max-width: 666px;
            box-shadow: 0 2px 4px 0 rgb(0 0 0 / 35%);
            margin-top: 4%;
            margin-bottom: 50px;
            padding-top: 30px;
            padding-bottom: 90px;
        }

        .input__filed-stdv {
            margin-top: 30px;
        }

        .serialinpyt {
            border-radius: 20px;
            max-width: 442px;
            text-align: center;
            margin: auto;
        }

        .btnvalidsate {
            text-align: center;
            float: right;
            font-size: 17px;
            min-width: 26%;
            margin-top: 15px;
            font-weight: 500;
            padding: 5px 16px;
            border-radius: 20px;
            margin-right: 18%;
        }

        .nameemb {
            background: #ececec;
            font-size: 18px;
            padding: 10px 5px;
            text-align: left;
            display: flex;
            padding-left: 20%;
        }

        .firstnamel {
            background: #196ae5;
            color: #fff;
            font-weight: 700;
            font-size: 25px;
            border-radius: 50px;
            padding: 13px 23px;
        }

        .fstppf {
            padding-top: 13px;
            padding-right: 11px;
        }

        .verif-ups-images img {
            width: 40%;
        }

        .verifycertificateimglogo {
            max-width: 190px;
        }
    </style>

</head>

<body>

     <?php $this->load->view("commons/inc/new-header.php") ?>

    <div class="container">

        <div class="start-divveri">
            <img class="verifycertificateimglogo" src="<?=asset_url()?>images/the-iot-logo-new.webp">
            <h2 class="mt-3">Verify a Certificate</h2>

            <form id="VerifyCertificateForm" method="post" onsubmit="return false">
                <div class="input__filed-stdv">
                    <input type="text" name="serialno" class="form-control serialinpyt"
                        placeholder="Enter Your Certification Id *">
                    <p></p>
                    <input type="submit" value="Validate" class="btnvalidsate btn btn-outline-success">

                </div>
            </form>
        </div>
    </div>
    <!-- modal for data -->
    <!-- <div class="modal fade" id="getsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="getCodedata"></div>
                    <div class="text-center pb-4">
                        <a href="<?=base_url()?>verify-certificate">Verify Another Certificate</a>
                    </div>

                </div>
            </div>
        </div>
    </div> -->

    <div class="modal fade" id="getsModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Certificate Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div id="getCodedata"></div>

                <div class="text-center pt-3">
                    <a class="btn btn-outline-primary btn-sm"
                        href="<?=base_url()?>verify-certificate">
                        Verify Another Certificate
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>


     <?php $this->load->view("commons/inc/new-footer.php") ?>
    
     <!-- Bootstrap JS (deferred) -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    <script defer src="<?php echo asset_url(); ?>dit/js/custom1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- header with swiper -->
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
    <!-- modal data end -->
    <!-- <script type="text/javascript">

        function removeTags(str) {
            if ((str === null) || (str === ''))
                return false;
            else
                str = str.toString();
            return str.replace(/(<([^>]+)>)/ig, '');
        }

        
        $("#VerifyCertificateForm").submit(function (e) {

            const formUrl = '<?=base_url()?>Certificatepdf/iotuser_verified_certimem';
            const formData = new FormData(this);
            $.ajax({
                type: 'post',
                url: formUrl,
                processData: false,
                contentType: false,
                dataType: 'json',
                
                data: formData,
                success: function (data) {
                    if (data.message == "error") {
                        alert(removeTags(data.response));
                        $("#enqform-overlay").hide();
                    }
                    else {
                        if (data.message == "success") {
                            $("#VerifyCertificateForm")[0].reset();
                            $("#getCodedata").html(data.response);
                            $("#getsModal").modal('show');
                        }
                        else {
                            $("#VerifyCertificateForm")[0].reset();
                            $("#getCodedata").html(data.response);
                            $("#getsModal").modal('show');

                        }
                    }
                }

            });
        });
    </script> -->



    <script type="text/javascript">

function removeTags(str) {
    if ((str === null) || (str === ''))
        return false;
    else
        str = str.toString();
    return str.replace(/(<([^>]+)>)/ig, '');
}

/*======start certification Form =======*/
$("#VerifyCertificateForm").on("submit", function (e) {

    e.preventDefault();   // very important

    const formUrl = '<?=base_url()?>Certificatepdf/iotuser_verified_certimem';
    const formData = new FormData(this);

    $.ajax({
        type: 'post',
        url: formUrl,
        processData: false,
        contentType: false,
        dataType: 'json',
        data: formData,
        success: function (data) {

            if (data.message === "error") {

                alert(removeTags(data.response));
                $("#enqform-overlay").hide();

            } else {

                $("#VerifyCertificateForm")[0].reset();
                $("#getCodedata").html(data.response);

                
                const modalEl = document.getElementById('getsModal');
                const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
                modal.show();

            }
        },
        error: function () {
            alert("Something went wrong. Please try again.");
        }
    });

});
</script>

</body>

</html>