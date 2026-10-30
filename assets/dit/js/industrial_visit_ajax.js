
document.getElementById("BookFreeDemopForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('Bookfrdsurl_source').value = window.location.href;
    
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
            document.getElementById("demo-ssmsgform_dv").classList.add("d-none");
            document.getElementById("demo-successmsg_dv").classList.remove("d-none");
            document.getElementById("demo-successmsg_dv").classList.add("d-block");
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


document.getElementById("DAMLAIStillhaveqForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('stilquestionurl').value = window.location.href;
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