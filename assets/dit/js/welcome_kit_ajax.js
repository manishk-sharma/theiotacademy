
document.getElementById("Welcome_Kit_Submit").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('enqurl_source').value = window.location.href;
    const formUrl = baseurly + 'LiveLead/welcome_kit_eict_submit';
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
            document.getElementById("Welcome_Kit_Submit").reset();
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