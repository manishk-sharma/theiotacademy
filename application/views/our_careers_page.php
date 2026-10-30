<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career</title>
    <meta name="robots" content="noindex, nofollow" />
    <meta name="googlebot" content="noindex, nofollow" />
    <meta name="yahooSeeker" content="noindex, nofollow" />
    <meta name="msnbot" content="noindex, nofollow" />
    <?php $this->load->view("commons/commonheaderlink.php") ?>
    <style type="text/css">
    .sectionWrapper {
        max-width: 1540px;
        margin: 0 auto;
    }

    .navbarSection {
        background-color: #D9D9D9 !important;
        padding: 5px 0;

    }

    .headerPart2 {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .navBarList {
        display: flex;
        list-style: none;
        gap: 15px;
    }

    .navbarItem {
        display: flex;
        align-items: center;
        gap: 40px;
    }

    .navBarList li a {
        font-family: "nunito";
        font-size: 20px;
        font-weight: 600;
        color: #000 !important;
    }

    .inputField1 {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .inputField1 input {
        padding: 10px 30px 10px 10px;
        background-color: transparent;
        border: 1px solid #9B9B9B;
        font-family: "Montserrat";
        font-size: 14px;
        border-radius: 0px !important;
    }

    .inputField1 button {
        border: none;
        background-color: #2B0F64;
        padding: 10px 20px;
        margin-left: 5px;
        color: #fff;
        font-family: "nunito";
        border-radius: 0px !important;
    }

    .careerBanner {
        background-image: url("<?= aws_asset_url()?>banner/careerbackground.webp");
        height: 70vh;
        width: 100%;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-origin: content-box;

    }

    .bannerHeader {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100%;
    }

    .modalbodyheightcstm {
        max-height: 550px;
        overflow-y: scroll;
    }

    .bannerHeader h1 {
        text-align: center;
        color: white;
        font-size: 40px;
        letter-spacing: 1px;
        font-family: "Montserrat";
    }

    .contentSection {
        background-color: #ECF8FF;
        padding: 40px 0;
    }

    .headersss {
        text-align: center;
        margin: 50px 0;
        font-family: "Montserrat";
        font-weight: 600;
        color: #000;
    }

    .iconicFlex {
        display: flex;
        /* justify-content: center; */
    }

    .contentItem h4 {
        font-size: 20px;
        font-weight: 500;
        font-family: Nunito;
        color: #000000;

    }

    .contentItem p {
        font-size: 14px;
        margin: 10px 0;
        color: black;
        font-weight: 500;
        font-family: Nunito;
    }

    .container1 {
        max-width: 90% !important;
    }

    .imageHeader {
        width: 100px;
        margin: 0 !important;
    }

    .imageHeader img {
        width: 100%;
    }

    .programmerBox {
        background-color: white;
        padding: 30px 20px;
        border-radius: 7px;
        margin-top: 32px;
        cursor: pointer;
        box-shadow: 0px 0px 25px 0px #9370db78;
        transition: 1s ease-in-out;
        overflow: hidden;

    }

    .programmerBox:hover {
        transform: scale(1.06);
        transition: 2s ease-in-out;
    }

    .programmerBox button {
        margin: 25px 0 0 0;
        background-color: #00E5E0;
        border-radius: 20px;
        border: none;
        padding: 5px 10px;
        min-width: 130px;
        font-family: "nunito";
        color: #000;
    }

    .programmerBox h4 {
        font-family: "nunito";
        font-size: 20px;
    }

    .programmerBox p {
        margin-top: 8px;
        font-size: 14px;
        color: #696969;
        font-family: "nunito";
    }

    .instructionPart {
        background-color: #2B0F64;
        padding: 25px 0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 60px 0;
        gap: 10px;
    }

    .instructionPart h4 {
        color: #fff;
        font-family: "Montserrat";
        font-size: 28px;
        font-weight: 600;
    }

    .instructionPart a {
        background-color: #00E5E0;
        border-radius: 20px;
        border: none;
        padding: 5px 10px;
        font-family: "nunito";
        min-width: 125px;
        text-align: center;
        color: #000;
        cursor: pointer;
    }

    .modalHeader {
        display: flex;
        background-color: #00E5E0;
        justify-content: space-between;
        padding: 5px 8px;
    }

    .buttonHeader {
        width: 100% !important;
        padding: 10px 1.5rem;
        border-top-left-radius: 5px;
        align-items: center;
        border-top-right-radius: 5px;
    }

    .newclsofcrdvcf {
        padding-bottom: 10%;
    }

    .buttonHeader p {
        color: #000;
        font-size: 22px;
        font-weight: 700;
        font-family: "nunito";
    }

    #applyEnquiryBtn {
        padding: 4px 20px;
        border-radius: 20px;
        border: none;
        cursor: pointer;
        color: white;
        background-color: #2B0F64;
        font-family: "nunito";
    }

    .header-modal {
        padding: 0 !important;
    }

    .dialog-modal {
        max-width: 800px !important;
    }

    .body-modal h4 {
        font-family: "nunito";
        font-weight: 600;
        font-size: 24px;
        color: black;
        margin: 8px 0;
    }

    .body-modal {
        padding: 20px 34px !important;
    }

    .orderlist1 li {
        font-size: 14px;
        color: #000;
        font-family: "nunito";
    }

    #formSection {
        display: none;
    }

    .formParent {
        padding: 2rem 2rem 3rem 2rem;
    }

    .form-group {
        margin: 20px 0;
    }

    .form-group input {
        font-family: "nunito";
    }

    .btn-primary1 {
        background-color: #2B0F64 !important;
        border: none;
        color: #fff;
        padding: 5px 20px;
        border-radius: 25px;
    }

    .navbarss {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
    }

    #jobdetailsd>ul {
        list-style: disc !important;
    }

    @media (max-width:992px) {

        .navbarss {
            display: none;
            position: absolute;
            top: 100%;
            background-color: #e7e7e7;
            left: 0;
        }

        .headerList2 {
            display: flex;
            justify-content: space-between;
            width: 100%;
            padding: 0 30px;
            border-bottom: 1px solid gray;
            padding-bottom: 7px;
        }

        .navBarList {
            gap: 0px;
        }

        .container1 {
            max-width: unset !important;
        }

        .navBarList li a {
            font-size: 14px;
            padding-bottom: 0 !important;
            padding: 6px 16px;
        }

        .navbarSection {
            padding: 0;
        }

        .bannerHeader h1 {
            font-size: 22px;
        }
    }

    .listWidth {
        width: 210px;
    }

    .listWidthSearch {
        width: 120px;
    }
    </style>

</head>

<body>
    <?php $this->load->view("commons/header.php")?>
    <div class="sectionWrapper">

        <!-- headerSection start -->
        <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light navbarSection" style="z-index:99;">
            <div class="container">
                <div class="headerList2"><a href="<?=base_url()?>">
                        <img decoding="async" loading="lazy"  class="nhs-1-logo "
                            src="<?=asset_url()?>images/the-iot-logo-new.webp"
                            alt="the IoT Academy Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>

                <div class="navbarss" id="navbarSupportedContent" style="padding:0 30px; width:100%;">
                    <ul class="navbar-nav mr-auto navBarList">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Blogs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link listWidthSearch" href="#">Job Search</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link listWidth ">Job Interview Guides</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0 searchInputField">
                        <div class="inputField1">
                            <input class="form-control mr-sm-2 " type="search"
                                placeholder="Type here to search job...rch" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </div>

                    </form>
                </div>
            </div>
        </nav> -->
        <!-- headerSection end -->
        <!-- banner section  start-->
        <section class="articles-for-visibility">
            <div class="careerBanner">
                <div class="bannerHeader">
                    <h1>Top Career Development <br>
                        Company for Job Seekers and <br>
                        Upskilling</h1>
                </div>
            </div>

        </section>
        <!-- banner section end -->

        <!-- team section start -->
        <div class="contentSection">
            <div class="container container1">
                <h2 class="headersss">Join Our Growing Team If You Are</h2>
                <div class="row g-2 ">
                    <div class="col-12 col-sm-6 col-md-3 my-4">
                        <div class="iconicFlex">
                            <div class="imageHeader">
                                <img decoding="async" loading="lazy" src="<?= aws_asset_url()?>banner/lightbulb1.webp"
                                    alt="lightbulb">
                            </div>
                            <div class="contentItem">
                                <h4>Solution Oriented</h4>
                                <p>Problem-solving, focused on
                                    finding practical resolutions
                                    efficiently.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 my-4">
                        <div class="iconicFlex">
                            <div class="imageHeader">
                                <img decoding="async" loading="lazy" src="<?= aws_asset_url()?>banner/motivation1.webp"
                                    alt="self-motivated-logo">
                            </div>
                            <div class="contentItem">
                                <h4>Self-Motivated</h4>
                                <p>Intrinsically motivated
                                    and dedicated to
                                    personal growth.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 my-4">
                        <div class="iconicFlex">
                            <div class="imageHeader">
                                <img decoding="async" loading="lazy" src="<?= aws_asset_url()?>banner/solutions1.webp"
                                    alt="find-a-better-way">
                            </div>
                            <div class="contentItem">
                                <h4>A Go-Getter</h4>
                                <p>You get all the peculiar ideas
                                    and a sudden urge to
                                    implement them</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 my-4">
                        <div class="iconicFlex">
                            <div class="imageHeader">
                                <img decoding="async" loading="lazy" src="<?= aws_asset_url()?>banner/passionate1.webp"
                                    alt="passionte-for-your-carrer">
                            </div>
                            <div class="contentItem">
                                <h4>Passionate</h4>
                                <p>Enthusiastic, dedicated,
                                    and deeply committed to
                                    company goals and values.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <h2 class="headersss">Openings At The IoT Academy</h2>
                <div style="margin:50px 0;">
                    <div class="row ">
                        <?php if (count($result)>0){
                         foreach($result as $row){ ?>
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="programmerBox">
                                <h4><?=$row['job_title']?></h4>
                                <p><?=$row['job_location']?></p>
                                <p><span
                                        style="border-radius:15px;background: #eee;color:#000;padding:0px 10px;font-size: small;"><?php
                                 $date1 = new DateTime($row['created_at']);
                                $date1 = $date1->format('Y-m-d');
                                $date2 = new DateTime('now');
                                $date2 = $date2->format('Y-m-d');
                                $date1 = new DateTime($date1);
                                $date2 = new DateTime($date2);
                                $interval = $date2->diff($date1);
                                $fdate = $interval->days;
                                if ($fdate>100) {
                                   echo "expired";
                                }
                                else{
                                    echo $fdate ." Days Ago";
                                }
                            ?></span></p>
                                <div style="text-align:right;">
                                    <button type="button" class="showsingledjbd btn btn-primary readmorebtnid"
                                        data-jb-id="<?=$row['id']?>" data-toggle="modal"
                                        data-target="#Applyjobnowcgfv">Read More</button>
                                </div>
                            </div>
                        </div>

                        <?php }}
                        else{
                            echo "<h2 class='text-center'>Oops! currently there is no job Available.</h2>";
                        }

                        ?>
                    </div>
                </div>
                <div class="instructionPart">
                    <h4>Want to Become an Instructor? -</h4>
                    <a href="<?=base_url()?>instructors-apply" target="_blank">Apply Here</a>
                </div>


            </div>
        </div>
        <!-- team section end -->
    </div>

        <!-- popup modaal start -->
    <div class="modal fade" id="Applyjobnowcgfv" tabindex="-1" aria-labelledby="ApplyjobnowcgfvLabel"
                aria-hidden="true">
                <div class="modal-dialog dialog-modal">
                    <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="position:absolute; top:0; right:5px;">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="detailsSection">
                            <!-- <div class=" modal-header header-modal">  hide here predefined class modal-header-->
                            <div class="header-modal">
                                <h5 class="modal-title" id="ApplyjobnowcgfvLabel"></h5>
                                <div class="modalHeader buttonHeader">
                                    <div>
                                        <p><span id="findtitelnm"></span> <span style="font-size:14px; font-weight:600;"
                                                id="findjblocatininm"></span></p>
                                    </div>
                                    <div>
                                        <button id="applyEnquiryBtn" class="applyEnquiryBtn">Apply Now</button>
                                    </div>
                                </div>
                                <div class="modal-body body-modal modalbodyheightcstm">
                                    <div id="jobdetailsd"></div>
                                </div>
                            </div>
                        </div>
                        <div class="formSection">
                            <div class="formParent">
                                <form id="ApplyJobapp" method="post" onsubmit="return false"
                                    enctype="multipart/form-data" class="form-horizontal">
                                    <div class="form-group">
                                        <input type="hidden" name="form_job_name"
                                            value="Employee Application Form Data" />
                                        <input type="hidden" name="job_url_source_name"
                                            value="<?php echo base_url() ?>careers" />
                                        <input type="text" class="form-control" id="exampleInputname" name="fullname"
                                            placeholder="Enter Your Name*" aria-describedby="NameHelp">
                                    </div>
                                    <div class="form-group">
                                        <input type="tel"
                                            oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                            minlength="10" maxlength="13" class="form-control" id="exampleInputPhone"
                                            aria-describedby="phoneHelp" placeholder="Enter Your Mobile No*"
                                            name="phoneno">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" id="exampleInputEmail1"
                                            aria-describedby="emailHelp" placeholder="Enter Your Email*" name="email">
                                    </div>
                                    <div class="form-group">
                                        <input name="select_job_category" class="form-control category"
                                            id="Selectjbcategry" readonly="true">
                                    </div>

                                    <div class="form-group">
                                        <input type="file" class="form-control" id="exampleInputresume"
                                            aria-describedby="resumeHelp" placeholder="Add Your CV*" name="resume">
                                        <small id="resumeHelp" class="form-text text-muted">
                                            &nbsp; &nbsp; Only pdf / doc size maximum 1mb.</small>
                                    </div>
                                    <div style="margin-top:40px; text-align:center;" class="form-group">
                                        <!-- <button type="reset" class="btn btn-primary1">Reset</button> -->
                                        <button type="submit" class="btn btn-primary1"
                                            style="min-width: 150px;">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="d-none" id="dmenquiry-successmsg_dv">
                            <div class="dm-demo_sucessmsg-dvv newclsofcrdvcf">
                                <div class="text-center">
                                    <img decoding="async" loading="lazy" class="dm_demo-sucesfd_img"
                                        src="<?= aws_asset_url()?>digital-marketing/enquire-succ-iconm.png">
                                </div>
                                <p class="text-center dm_we-recieved-fvm">
                                    <span>We have received your request and will connect with you soon 😃</span>
                                </p>
                                <div class="dm-thnk_srtfvdc"><span class="dm-scssfd_spn"><span
                                            class="nk_srtfvdc-imgspn"><img decoding="async" loading="lazy"
                                                class="dm-succedssf_icbdv"
                                                src="<?= aws_asset_url()?>digital-marketing/dmsubmit-arrowd.png"></span>
                                        Thank You!</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <!-- popup modaal end  -->
    <?php $this->load->view("commons/footer.php") ?>

    <script>
    $(".readmorebtnid").click(function() {
        $(".detailsSection").addClass('d-block');
        $(".formSection").addClass('d-none');
        $(".formSection").removeClass('d-block');
        $("#dmenquiry-successmsg_dv").addClass('d-none');
        $("#dmenquiry-successmsg_dv").removeClass('d-block');
    });
    $(".applyEnquiryBtn").click(function() {
        $(".detailsSection").removeClass('d-block');
        $(".detailsSection").addClass('d-none');
        $(".formSection").addClass('d-block');
        $(".formSection").removeClass('d-none');
        $("#dmenquiry-successmsg_dv").addClass('d-none');
        $("#dmenquiry-successmsg_dv").removeClass('d-block');
    });

    $(document).ready(function() {
        $("#megaMenu").click(function() {
            $("#navbarSupportedContent").show();

        });
    });


    $(document).ready(function() {
        $(".showsingledjbd").on("click", function(e) {
            var updidforj = $(this).data('jb-id');
            const formUrl = '<?= base_url() ?>JobUploadController/editmatjobdata';
            $.ajax({
                type: 'post',
                url: formUrl,
                data: {
                    'e_idupv': updidforj
                },
                dataType: 'json',

                success: function(data) {
                    if (data.message == "success") {

                        $("#findtitelnm").html(data.response[0].job_title);
                        $("#findjblocatininm").html(data.response[0].job_location);
                        $("#Selectjbcategry").val(data.response[0].job_title);
                        // $("#findnofvc").val(data.response[0].vacancy);
                        $("#jobdetailsd").html(data.response[0].job_details);

                    } else {
                        $('#error-msg').show();
                        $('#error-msg').html(data.response);
                        $('#error-msg').fadeOut(15000);
                    }
                }
            });
        });
    });



    $("#ApplyJobapp").submit(function(e) {
        const formUrl = '<?=base_url()?>ApplyForJob/apply_job_submit_form';
        const formData = new FormData(this);
        $.ajax({
            type: 'post',
            url: formUrl,
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            beforeSend: function() {
                $("#enqform-overlay").show();
            },
            success: function(data) {
                if (data.message == "error") {
                    alert(removeTags(data.response));
                    $("#enqform-overlay").hide();
                } else {
                    if (data.message == "success") {
                        $("#enqform-overlay").hide();
                        $("#ApplyJobapp")[0].reset();
                        $("#SuccessAlert").html(data.response);
                        $("#SuccessAlert").removeClass("hide");
                        $("#SuccessAlert").addClass("show");
                        $("#SuccessAlert").fadeIn();
                        $("#SuccessAlert").fadeOut(15000);
                        $(".formSection").css("display", "none");
                        $(".formSection").removeClass("d-block");
                        $("#dmenquiry-successmsg_dv").addClass('d-block');
                    } else {
                        $('.senerror-msg').show();
                        $('.senerror-msg').html(data.response);
                        $(".senerror-msg").fadeOut(15000);
                        $("#dmenquiry-successmsg_dv").addClass('d-none');
                    }
                }
            }
        });
    })
    </script>
</body>

</html>