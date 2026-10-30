
document.getElementById("Hire_Enquiry_Now_Form").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('enqurl_source').value = window.location.href;
    const formUrl = baseurly + 'Hire_From_Us_Controller/submit_hire_from_us';
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
            document.getElementById("Hire_Enquiry_Now_Form").reset();
            const successAlert = document.getElementById("SuccessAlert");
            const SuccessdsAlert = document.getElementById("Successdvpp");
            successAlert.innerHTML = data.response;
            SuccessdsAlert.classList.add("d-block");
            SuccessdsAlert.classList.remove("d-none");
            document.getElementById("enqform-overlay").style.display = "none";
        } else {
            const successAlert = document.getElementById("SuccessAlert");
            const SuccessdsAlert = document.getElementById("Successdvpp");
            successAlert.innerHTML = data.response;
            SuccessdsAlert.classList.add("d-block");
            SuccessdsAlert.classList.remove("d-none");
            document.getElementById("enqform-overlay").style.display = "none";
        }
    })
});



document.getElementById("EnquiryNowpopForm").addEventListener("submit", function(e) {
        e.preventDefault(); 
        document.getElementById('enqcxfrdsurl_source').value = window.location.href;
        
        const formUrl = baseurly + 'LiveLead/iitgsubmitmform';
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