document.getElementById("limited-seats-submit-form").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('page_url').value = window.location.href;
    
    const formUrl = baseurly + 'LiveLead/Master_Data_Analytics_Gen_AI_And_Agentic_AI';
    const formData = new FormData(this);

    // Loader from new-header
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
            //loading false
            document.getElementById("enqform-overlay").style.display = "none";
            const successMsg = document.getElementById("Bsuccess-msg");
            successMsg.classList.add("d-block");
            successMsg.classList.remove("d-none");
            successMsg.innerHTML = data.response || "Successfully submitted your details";


            document.getElementById("limited-seats-submit-form").reset();
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
    
    const formUrl = baseurly + 'LiveLead/Master_Data_Analytics_Gen_AI_And_Agentic_AI';
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


document.getElementById("bottom-form-submit-form").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('urlainurlsource').value = window.location.href;
    const formUrl = baseurly + 'LiveLead/Master_Data_Analytics_Gen_AI_And_Agentic_AI';
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
            const sucessmsgMsg= document.getElementById("second-successmsg_dv");
            sucessmsgMsg.innerHTML=data.response;
            setTimeout(() => { sucessmsgMsg.style.display = 'none'; }, 15000);
            document.getElementById("bottom-form-submit-form").reset();
        } else {
            const errorMsg = document.getElementById('second-successmsg_dv');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});

document.getElementById("DownloadbrochForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('dwnbrosurl_source').value = window.location.href;
    const formUrl = baseurly + 'LiveLead/Master_Data_Analytics_Gen_AI_And_Agentic_AI';
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
            document.getElementById("enqform-overlay").style.display = "none";
             window.location.href =baseurly + "assets/coursesyllabus/offline-courses/data-analytics-with-ai-brochure.pdf";
            document.getElementById("DownloadbrochForm").reset();
        } else {
            const errorMsg = document.getElementById('dwnbrerror-msg');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});


