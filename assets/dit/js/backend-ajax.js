// function removeTags(str) {
//     if ((str === null) || (str === ''))
//         return false;
//     else
//         str = str.toString();
//     return str.replace(/(<([^>]+)>)/ig, '');
// }
// const baseurly="https://www.theiotacademy.co/";


    document.getElementById("BookFreeDemopForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('Bookfrdsurl_source').value = window.location.href;
    
    const formUrl = baseurly + 'LiveLead/FormSubmitDAMLgenerarativeai';
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
            document.getElementById("demo-ssmsgform_dv").classList.add("d-none");
            document.getElementById("Videopopaddlngpopup").classList.add("modal-lg");
            document.getElementById("Videocustombodybg").classList.add("custom-modal-content-shw-video");
            document.getElementById("demo-successmsg_dv").classList.remove("d-none");
            document.getElementById("BookFreeDemopForm").reset();
        } else {
            const errorMsg = document.getElementById('Berror-msg');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});


document.getElementById("EnquiryNowpopForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('enqcxfrdsurl_source').value = window.location.href;
    
    const formUrl = baseurly + 'LiveLead/FormSubmitDAMLgenerarativeai';
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


document.getElementById("RequestCallbackForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('scheduleodsainurlsource').value = window.location.href;
    const formUrl = baseurly + 'LiveLead/FormSubmitDAMLgenerarativeai';
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
            const sucessmsgMsg= document.getElementById("Callsuccess-msg");
            sucessmsgMsg.innerHTML=data.response;
            setTimeout(() => { sucessmsgMsg.style.display = 'none'; }, 15000);
            document.getElementById("EnquiryNowpopForm").reset();
        } else {
            const errorMsg = document.getElementById('sheshulsror-msg');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});

document.getElementById("DownloadbrochForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('dwnbrosurl_source').value = window.location.href;
    const formUrl = baseurly + 'LiveLead/FormSubmitDAMLgenerarativeai';
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


document.getElementById("DownloadCurriculumdaForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('dwncurrisurl_source').value = window.location.href;
    const formUrl = baseurly + 'LiveLead/FormSubmitDAMLgenerarativeai';
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
            window.location.href =baseurly + "assets/coursesyllabus/online-courses/da_ml_ai_course_curriculum.pdf";
            document.getElementById("DownloadCurriculumdaForm").reset();
        } else {
            const errorMsg = document.getElementById('Curricrerror-msg');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});


document.addEventListener("DOMContentLoaded", function() {
    var dmnameInputField = document.getElementById('dmnameinput_fld');
    var dmnaenImgIcon = document.getElementById('dmnaenimgicn');
    var dmmobileInputField = document.getElementById('dmmobile-input_fld');
    var dmemlImgIcon = document.getElementById('dmemlimgicn');

    dmnameInputField.addEventListener('keyup', function() {
        var inputValue = this.value;
        if (inputValue.length > 4) {
            dmnaenImgIcon.classList.remove('d-none');
            dmnaenImgIcon.classList.add('d-block');
        } else {
            dmnaenImgIcon.classList.remove('d-block');
            dmnaenImgIcon.classList.add('d-none');
        }
    });

    dmmobileInputField.addEventListener('keyup', function() {
        var inputValue = this.value;
        if (inputValue.length > 9) {
            dmemlImgIcon.classList.remove('d-none');
            dmemlImgIcon.classList.add('d-block');
        } else {
            dmemlImgIcon.classList.remove('d-block');
            dmemlImgIcon.classList.add('d-none');
        }
    });
});

document.getElementById("DAMLAIStillhaveqForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('stilquestionurl').value = window.location.href;
    const formUrl = baseurly + 'LiveLead/FormSubmitDAMLgenerarativeai';
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
            const stucessmsgMsg= document.getElementById("stillsuccesror-msg");
            stucessmsgMsg.innerHTML=data.response;
            setTimeout(() => { stucessmsgMsg.style.display = 'none'; }, 15000);
            document.getElementById("DAMLAIStillhaveqForm").reset();
        } else {
            const sterrorMsg = document.getElementById('stilleror-msg');
            sterrorMsg.style.display = 'block';
            sterrorMsg.innerHTML = data.response;
            setTimeout(() => { sterrorMsg.style.display = 'none'; }, 15000);
        }
    })
});