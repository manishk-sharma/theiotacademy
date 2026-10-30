
document.getElementById("EnquiryNowmlForm").addEventListener("submit", function(e) {
        e.preventDefault(); 
        document.getElementById('enqurl_source').value = window.location.href;
        const formUrl = baseurly + 'Mlwithiotregistration/special_corporate_registration_form';
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
                document.getElementById("EnquiryNowmlForm").reset();
                const successMsg=document.getElementById("ensuccess-msg");
                successMsg.style.display = 'block';
                successMsg.innerHTML = data.response;
                setTimeout(() => { successMsg.style.display = 'none'; }, 15000);
            } else {
                const errorMsg = document.getElementById('enqsror-msg');
                errorMsg.style.display = 'block';
                errorMsg.innerHTML = data.response;
                setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
            }
        })
    });
    
    /*==========End corporate Form ==========*/
    
      /*==========Start download brochure from ==========*/
      document.getElementById("DownloadbrochForm").addEventListener("submit", function(e) {
        e.preventDefault(); 
        document.getElementById('dwnbrosurl_source').value = window.location.href;
        
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
                document.getElementById("DownloadbrochForm").reset();
                window.location.href=baseurly +"assets/coursesyllabus/ds-ml-and-edge-ai-by-eict-guwahati/brochure-of-ds-ml-edge-ai-by-eict-academy-iit-guwahati.pdf";
            } else {
                const errorMsg = document.getElementById('dwnbrerror-msg');
                errorMsg.style.display = 'block';
                errorMsg.innerHTML = data.response;
                setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
            }
        })
    });
    
    /*==========Start download project from ==========*/
    document.getElementById("DownloadProjectmb").addEventListener("submit", function(e) {
        e.preventDefault(); 
        document.getElementById('dwprojecturl_source').value = window.location.href;
        
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
                document.getElementById("DownloadProjectmb").reset();
                window.location.href=baseurly +"assets/coursesyllabus/ds-ml-and-edge-ai-by-eict-guwahati/projects-of-ds-ml-edge-ai-by-eict-academy-iit-guwahati.pdf";
            } else {
                const errorMsg = document.getElementById('projecterror-msg');
                errorMsg.style.display = 'block';
                errorMsg.innerHTML = data.response;
                setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
            }
        })
    });
    
    /*==========Start download curricullum from ==========*/
    document.getElementById("DownloadCurriculummb").addEventListener("submit", function(e) {
        e.preventDefault(); 
        document.getElementById('dwcurrisurl_source').value = window.location.href;
        
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
                document.getElementById("DownloadCurriculummb").reset();
                window.location.href=baseurly +"assets/coursesyllabus/ds-ml-and-edge-ai-by-eict-guwahati/curriculum-of-ds-ml-edge-ai-by-eict-academy-iit-guwahati.pdf";
        } else {
                const errorMsg = document.getElementById('curricterror-msg');
                errorMsg.style.display = 'block';
                errorMsg.innerHTML = data.response;
                setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
            }
        })
    });
    
        /*==========Start new enquiry form ==========*/
     document.getElementById("NewNEnquiryformid").addEventListener("submit", function(e) {
            e.preventDefault(); 
            document.getElementById('enfenqurl_source').value = window.location.href;
            
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
                    document.getElementById("NewNEnquiryformid").reset();
                    const successMsg=document.getElementById("enqccess-msg");
                    successMsg.style.display = 'block';
                    successMsg.innerHTML = data.response;
                    setTimeout(() => { successMsg.style.display = 'none'; }, 15000);
                } else {
                    const errorMsg = document.getElementById('enqenerror-msg');
                    errorMsg.style.display = 'block';
                    errorMsg.innerHTML = data.response;
                    setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
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