
document.addEventListener("DOMContentLoaded", function () {

    const genAiForm = document.getElementById("sideLeadFormGenAi");
    if (!genAiForm) return;

    genAiForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(genAiForm);

     
        formData.append("coursename", " Data-analytics GenAI");
        formData.append("form_name", "Data-analytics Book Slot");
        formData.append("url_source", window.location.href);

     
        console.log([...formData.entries()]);

        fetch("https://www.theiotacademy.co/LiveLead/genaiallform", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.message === "success") {
                alert("Thank you! Our team will contact you soon.");
                genAiForm.reset();
            } else {
                alert(res.response || "Something went wrong");
            }
        })
        .catch(err => {
            console.error("AJAX ERROR:", err);
            alert("Server error");
        });
    });

});

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("downloadBrochureForm");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        formData.append("lastname", "");
        formData.append("mobileno", formData.get("mobileno") || "");
        formData.append("forwho", "for myself");
        formData.append("coursename", "Data-analytics GenAI");
        formData.append("form_name", "Data-analytics Download Brochure");
        formData.append("url_source", window.location.href);

        fetch("https://www.theiotacademy.co/LiveLead/genaiallform", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(res => {

            if (res.message === "success") {

                alert("Brochure request submitted");
                form.reset();

                window.location.href =
                    "https://www.theiotacademy.co/assets/pdf/genai-6months/Data_Analytics_Generative_AI_Brochure.pdf";

            } else {
                alert(res.response || "Error");
            }
        })
        .catch(() => alert("erver error"));
    });

});


document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("downloadJobRoleForm");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        // 🔹 Backend-required extra fields
        formData.append("lastname", "");
        formData.append("forwho", "Self");
        formData.append("coursename", "DS ML AI GenAI by E&ICT IIT Roorkee");
        formData.append("form_name", "download_job_roles_dsml");
        formData.append("url_source", window.location.href);

        // DEBUG (optional)
        console.log([...formData.entries()]);

        fetch("https://www.theiotacademy.co/LiveLead/genaiallform", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.message === "success") {
                alert("Job roles downloaded successfully");
                form.reset();


            } else {
                alert(res.response || "Something went wrong");
            }
        })
        .catch(err => {
            console.error("AJAX ERROR:", err);
            alert("Server error");
        });
    });

});


document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("downloadProjectsForm");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(form);

       
        formData.append("lastname", "");
        formData.append("forwho", "Self");
        formData.append("coursename", "data-analytics-and-gen-ai-by-eict-iit-roorkee");
        formData.append("form_name", "download_projects_genai");
        formData.append("url_source", window.location.href);

        // DEBUG (optional)
        console.log([...formData.entries()]);

        fetch("https://www.theiotacademy.co/LiveLead/genaiallform", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.message === "success") {
                alert("Projects downloaded successfully");
                form.reset();
                  window.location.href =
                    "https://www.theiotacademy.co/assets/pdf/genai-6months/Data_Analytics_Generative_AI_projects.pdf";

                

            } else {
                alert(res.response || "❌ Something went wrong");
            }
        })
        .catch(err => {
            console.error("AJAX ERROR:", err);
            alert("Server error");
        });
    });

});

document.addEventListener("DOMContentLoaded", function () {

    const curriculumForm = document.getElementById("CurriculumModal");
    if (!curriculumForm) return;

    curriculumForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(curriculumForm);

        formData.append("lastname", "");
        formData.append("forwho", "Self");
        formData.append("coursename", "Data Analytics & GenAI");
        formData.append("form_name", "Curriculum Download");
        formData.append("url_source", window.location.href);

        console.log("Curriculum Form Data:");
        console.log([...formData.entries()]);

        fetch("https://www.theiotacademy.co/LiveLead/genaiallform", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.message === "success") {

                alert("Curriculum request submitted successfully");
                curriculumForm.reset();

                window.location.href =
                    "https://www.theiotacademy.co/assets/pdf/genai-6months/Data_Analytics_Generative_AI_Curriculum.pdf";

            } else {
                alert(res.response || "❌ Something went wrong");
            }
        })
        .catch(err => {
            console.error("AJAX ERROR:", err);
            alert("❌ Server error. Please try again.");
        });
    });

});