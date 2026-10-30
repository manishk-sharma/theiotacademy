
document.getElementById("contactForm").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('contactfrdsurl_source').value = window.location.href;
    
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
            document.getElementById("contactForm").reset();
            const scuccessMsg = document.getElementById('successfmb');
            scuccessMsg.style.display = 'block';
            scuccessMsg.innerHTML = data.response;
            setTimeout(() => { scuccessMsg.style.display = 'none'; }, 15000);
        } else {
            const errorMsg = document.getElementById('successfmb');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});


document.getElementById("ApplyJobapp").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('incjobapply').value = window.location.href;
    const formUrl = baseurly + 'ApplyForJob/apply_job_submit_form';
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
            document.getElementById("ApplyJobapp").reset();
            const incmsMsg = document.getElementById('resmessage');
            incmsMsg.style.display = 'block';
            incmsMsg.innerHTML = data.response;
            setTimeout(() => { incmsMsg.style.display = 'none'; }, 15000);

        } else {
            const errorMsg = document.getElementById('resmessage');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});
