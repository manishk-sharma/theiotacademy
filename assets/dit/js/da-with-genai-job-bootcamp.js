document.getElementById("heroEnquiryForm").addEventListener("submit", handleHeroFormSubmit);

function handleHeroFormSubmit(e) {
    e.preventDefault();

    const form = e.target;

    const firstName = form.querySelector('[name="firstName"]').value.trim();
    const lastName = form.querySelector('[name="lastName"]').value.trim();
    const mobile = form.querySelector('[name="mobileno"]').value.trim();
    const email = form.querySelector('[name="email"]').value.trim();
    const workExp = form.querySelector('[name="work_experience"]').value;
    const callTime = form.querySelector('[name="best_time_call"]').value;

    // ===== Validation =====
    if (!firstName || !mobile || !email || !workExp || !callTime) {
        alert("Please fill all required fields");
        return;
    }

    if (!/^[0-9]{10}$/.test(mobile)) {
        alert("Please enter a valid 10 digit mobile number");
        return;
    }

    // ===== FormData =====
    const formData = new FormData();

    formData.append("firstname", firstName);
    formData.append("lastname", lastName);
    formData.append("mobileno", mobile);
    formData.append("email", email);
    formData.append("work_experience", workExp);
    formData.append("best_time_call", callTime);

    // Optional/backend required fields
    formData.append("forwho", "");
    formData.append("coursename", " DA-GenAI-job-bootcamp");
    formData.append("form_name", "Hero Enquiry Form");
    formData.append("url_source", window.location.href);

    const submitBtn = form.querySelector(".btn-submit");
    const originalText = submitBtn.innerHTML;

    submitBtn.disabled = true;
    submitBtn.innerHTML = "Submitting...";

    fetch("https://www.theiotacademy.co/LiveLead/iitroorkeedsaiprogramSubmit", {
        method: "POST",
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Network response was not ok");
        }

        return response.json();
    })
    .then(res => {

        if (res.message === "success") {

            alert("Form submitted successfully");

            form.reset();

        } else {

            alert(res.response || "Something went wrong");

        }

    })
    .catch(error => {

        console.error("Form Submit Error:", error);

        alert("Server error. Please try again.");

    })
    .finally(() => {

        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;

    });
}



document.getElementById("curriculumBrochureForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const form = e.target;

    const fullName = form.querySelector('[name="fullName"]').value.trim();
    const mobile = form.querySelector('[name="mobileno"]').value.trim();
    const email = form.querySelector('[name="email"]').value.trim();

    if (!fullName || !mobile || !email) {
        alert("Please fill all required fields");
        return;
    }

    if (!/^[0-9]{10}$/.test(mobile)) {
        alert("Please enter a valid 10 digit mobile number");
        return;
    }

    const formData = new FormData();

    formData.append("firstname", fullName);
    formData.append("mobileno", mobile);
    formData.append("email", email);

    formData.append("coursename", "DA-GenAI-job-bootcamp");
    formData.append("form_name", "SIDE FORM");
    formData.append("url_source", window.location.href);

    const submitBtn = form.querySelector(".btn-submit");
    const originalHTML = submitBtn.innerHTML;

    submitBtn.disabled = true;
    submitBtn.innerHTML = "<span>Submitting...</span>";

    fetch("https://www.theiotacademy.co/LiveLead/iitroorkeedsaiprogramSubmit", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(res => {

        if (res.message === "success") {

            alert("Form submitted successfully");

            form.reset();

            // Brochure download/open
            window.open(
                "https://www.theiotacademy.co/assets/pdf/job-bootcamp-brochure.pdf",
                "_blank"
            );

        } else {
            alert(res.response || "Something went wrong");
        }

    })
    .catch(error => {
        console.error("Form Submit Error:", error);
        alert("Server error. Please try again.");
    })
    .finally(() => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalHTML;
    });
});

document.getElementById("downloadFormWithGenaiJobBootcamp")
    .addEventListener("submit", function (e) {

        e.preventDefault();

        const form = e.target;

        const firstName = form.querySelector('[name="firstname"]').value.trim();
        const email = form.querySelector('[name="email"]').value.trim();
        const mobile = form.querySelector('[name="mobileno"]').value.trim();
        const workExp = form.querySelector('[name="work_experience"]').value;
        const callTime = form.querySelector('[name="best_time_call"]').value;

        if (!firstName || !email || !mobile || !workExp || !callTime) {
            alert("Please fill all required fields");
            return;
        }

        if (!/^[0-9]{10}$/.test(mobile)) {
            alert("Please enter a valid 10 digit mobile number");
            return;
        }

        const formData = new FormData();

        formData.append("firstname", firstName);
        formData.append("lastname", "");
        formData.append("mobileno", mobile);
        formData.append("email", email);
        formData.append("work_experience", workExp);
        formData.append("best_time_call", callTime);
        formData.append("forwho", "");

        formData.append("coursename", "Job Bootcamp popup modal form ");
        formData.append("form_name", "Download popup Modal");
        formData.append("url_source", window.location.href);

        const submitBtn = form.querySelector('button[type="submit"]');
        const originalHTML = submitBtn.innerHTML;

        submitBtn.disabled = true;
        submitBtn.innerHTML = "<span>Submitting...</span>";

        fetch("https://www.theiotacademy.co/LiveLead/iitroorkeedsaiprogramSubmit", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(res => {

            if (res.message === "success") {

                form.reset();

                // Close Bootstrap modal
                const modalElement = document.getElementById("DownloadBrochureModal");

                if (modalElement && typeof bootstrap !== "undefined") {
                    const modalInstance =
                        bootstrap.Modal.getInstance(modalElement) ||
                        new bootstrap.Modal(modalElement);

                    modalInstance.hide();
                }

                // Open brochure PDF
                window.open(
                "https://www.theiotacademy.co/assets/pdf/job-bootcamp-brochure.pdf",
                "_blank"
            );

            } else {
                alert(res.response || "Something went wrong");
            }

        })
        .catch(error => {

            console.error("Download Brochure Form Error:", error);

            alert("Server error. Please try again.");

        })
        .finally(() => {

            submitBtn.disabled = false;
            submitBtn.innerHTML = originalHTML;

        });

    });