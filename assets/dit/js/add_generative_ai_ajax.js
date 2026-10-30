
document.getElementById("EnquiryNowpopForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('enqcxfrdsurl_source').value = window.location.href;
    
    const formUrl = baseurly + 'LiveLead/liveleadsubmit';
    const formData = new FormData(this);
    document.getElementById("enqform-overlay").style.display = "block";
    
    fetch(formUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === "error") {
            alert(removeTags(data.response));
            document.getElementById("enqform-overlay").style.display = "none";
        } else if (data.message === "success") {
            document.getElementById("enqform-overlay").style.display = "none";
            document.getElementById("enquiry-ssmsgform_dv").classList.add("d-none");
            document.getElementById("enquiry-successmsg_dv").classList.remove("d-none");
            document.getElementById("EnquiryNowpopForm").reset();
        } else {
            const errorMsg = document.getElementById('enqsror-msg');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});


document.getElementById("BannerEnquireForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('bannersurl_source').value = window.location.href;
    const formUrl = baseurly + 'LiveLead/liveleadsubmit';
    const formData = new FormData(this);
    document.getElementById("enqform-overlay").style.display = "block";
    
    fetch(formUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === "error") {
            alert(removeTags(data.response));
            document.getElementById("enqform-overlay").style.display = "none";
        } else if (data.message === "success") {
            document.getElementById("enqform-overlay").style.display = "none";
            const sgmMsg = document.getElementById('successmsg-msg');
            sgmMsg.style.display = 'block';
            sgmMsg.innerHTML = data.response;
            setTimeout(() => { sgmMsg.style.display = 'none'; }, 15000);
           
            document.getElementById("BannerEnquireForm").reset();
        } else {
            const errorMsg = document.getElementById('enqsror-msg');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});

document.getElementById("DownloadbrochForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('dwnbrosurl_source').value = window.location.href;
    const formUrl = baseurly + 'LiveLead/liveleadsubmit';
    const formData = new FormData(this);
    document.getElementById("enqform-overlay").style.display = "block";
    
    fetch(formUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === "error") {
            alert(removeTags(data.response));
            document.getElementById("enqform-overlay").style.display = "none";
        } else if (data.message === "success") {
            document.getElementById("enqform-overlay").style.display = "none";
            window.location.href =baseurly + "assets/coursesyllabus/online-courses/da_ml_ai_course_brochure.pdf";
            document.getElementById("DownloadbrochForm").reset();
        } else {
            const errorMsg = document.getElementById('dwnbrerror-msg');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});

document.getElementById("GetFreeCourseForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('getfreeurl_source').value = window.location.href;
    const formUrl = baseurly + 'LiveLead/liveleadsubmit';
    const formData = new FormData(this);
    document.getElementById("enqform-overlay").style.display = "block";
    
    fetch(formUrl, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === "error") {
            alert(removeTags(data.response));
            document.getElementById("enqform-overlay").style.display = "none";
        } else if (data.message === "success") {
            document.getElementById("enqform-overlay").style.display = "none";
            document.getElementById("GetFreeCourseForm").reset();
            const Succesmfcv = document.getElementById('Succesmfcv-msg');
            Succesmfcv.style.display = 'block';
            Succesmfcv.innerHTML = data.response;
            setTimeout(() => { Succesmfcv.style.display = 'none'; }, 15000);
        } else {
            const errorMsg = document.getElementById('dwnbrerror-msg');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});

