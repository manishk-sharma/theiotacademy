document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("DownloadbrochForm");

    if (!form) {
        console.log("DownloadbrochForm not found");
        return;
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        formData.append("form_name", "Download Brochure Form");
        formData.append("url_source", window.location.href);

        const btn = form.querySelector("button[type='submit']");
        const originalText = btn.innerText;

        btn.disabled = true;
      

        fetch(window.location.origin + "/LiveLead/downloadbrochurepopup", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            btn.disabled = false;
            btn.innerText = originalText;

            if (data.trim() === "success") {
               
                form.reset();

                window.open(
                    "https://www.theiotacademy.co/assets/pdf/embedded-17may/embedded-systems-with-AI-6-months.pdf",
                    "_blank"
                );
            } else {
                alert("Error: " + data);
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerText = originalText;

            console.error("AJAX ERROR:", err);
            alert("Server error. Try again.");
        });
    });

});
document.addEventListener("DOMContentLoaded", function () {

    const genAiForm = document.getElementById("sideLeadFormDaAi");
    if (!genAiForm) return;

    genAiForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(genAiForm);

        
       
        formData.append("form_name", "Data-analytics DA-AI Book Slot");
        formData.append("url_source", window.location.href);

       
        const submitBtn = genAiForm.querySelector("button[type='submit']");
        submitBtn.disabled = true;
        submitBtn.innerText = "Submitting...";

        fetch("/LiveLead/saveDsAiSample", { 
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {

            submitBtn.disabled = false;
            submitBtn.innerText = "Submit";

            if (data.trim() === "success") {
                alert("Thank you! Our team will contact you soon.");
                genAiForm.reset();
            } else {
                alert("Error: " + data);
            }

        })
        .catch(error => {

            submitBtn.disabled = false;
            submitBtn.innerText = "Submit";

            console.error("AJAX ERROR:", error);
            alert(" Server error. Try again.");
        });

    });

});
document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("submitDaAI");

    if (!form) {
        console.log("Form not found");
        return;
    }

    form.addEventListener("submit", function(e){
        e.preventDefault();

        const formData = new FormData(form);

        formData.append("form_name", "Admission Form");
        formData.append("url_source", window.location.href);

        const btn = form.querySelector(".submit-btn");
        btn.disabled = true;
        btn.innerText = "Submitting...";

        fetch("/LiveLead/saveAdmissionForm", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            btn.disabled = false;
            btn.innerText = "Submit Form";

            if(data.trim() === "success"){
                alert("Form submitted successfully!");
                form.reset();
            } else {
                alert("Error: " + data);
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerText = "Submit Form";
            alert("Server error");
            console.error(err);
        });
    });

});
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("aijourneyform");

    if (!form) {
        console.log("aijourneyform not found");
        return;
    }

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        const formData = new FormData(form);

        formData.set("form_name", "AI-Powered Embedded & IoT Journey");
        formData.set("url_source", window.location.href);

        const btn = form.querySelector("button[type='submit']");
        const btnHTML = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = "Submitting...";

        fetch(window.location.origin + "/LiveLead/aijourneyFormSubmit", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {
            btn.disabled = false;
            btn.innerHTML = btnHTML;

            const response = data.trim();
            console.log("Response:", response);

            if (response === "success") {
                alert("Thank you! We will contact you soon.");
                form.reset();
            } else {
                alert("Error: " + response);
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = btnHTML;

            console.error("AJAX ERROR:", err);
            alert("Server error. Try again.");
        });
    });
});