document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("downloadFormDsml");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const formData = new FormData(form);

        formData.append("form_name", "industrial-summer-training-programs Enroll Form");
        formData.append("url_source", window.location.href);

        // button select
        const btn = form.querySelector("button");

        btn.disabled = true;
        // btn.innerText = "Submitting...";

        fetch(window.location.origin + "/LiveLead/industrialtrainingprogramform", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {

            btn.disabled = false;
            // btn.innerText = "Enroll Now";

            if (data.trim() === "success") {

                alert("Thank you! Our team will contact you.");

                form.reset();

            } else {

                alert("Error: " + data);
            }

        })
        .catch(err => {

            btn.disabled = false;
            // btn.innerText = "Enroll Now";

            console.error(err);

            alert("Server Error");

        });

    });

});

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("aijourneyform");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const formData = new FormData(form);

        formData.append("form_name", "Upcoming Application Deadline Form");
        formData.append("url_source", window.location.href);

       
        const btn = form.querySelector("button");

        btn.disabled = true;
        // btn.innerText = "Submitting...";

        fetch(window.location.origin + "/LiveLead/upcomingapplicationform", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {

            btn.disabled = false;
            // btn.innerText = "Enroll Now";

            if (data.trim() === "success") {

                alert("Thank you! Our team will contact you.");

                form.reset();

            } else {

                alert("Error: " + data);
            }

        })
        .catch(err => {

            btn.disabled = false;
            // btn.innerText = "Enroll Now";

            console.error(err);

            alert("Server Error");

        });

    });

});

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("programModalForm1");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const formData = new FormData(form);

        formData.append("form_name", "industrial-summer-training-programs Apply Form");
        formData.append("url_source", window.location.href);

        // button select
        const btn = form.querySelector("button");

        btn.disabled = true;

        fetch(window.location.origin + "/LiveLead/applyform1", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {

            btn.disabled = false;

            if (data.trim() === "success") {

                alert("Thank you! Our team will contact you.");

                form.reset();

                // PDF open after successful submit
                window.open(
                    "https://www.theiotacademy.co/assets/pdf/industrial_training_4formpdf/4-Machine-Learning-%26-Artificial-Intelligence.pdf",
                    "_blank"
                );

            } else {

                alert("Error: " + data);
            }

        })
        .catch(err => {

            btn.disabled = false;

            console.error(err);

            alert("Server Error");

        });

    });

});

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("programModalForm2");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const formData = new FormData(form);

        formData.append("form_name", "industrial-summer-training-programs Apply Form");
        formData.append("url_source", window.location.href);

        // button select
        const btn = form.querySelector("button");

        btn.disabled = true;

        fetch(window.location.origin + "/LiveLead/applyform2", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {

            btn.disabled = false;

            if (data.trim() === "success") {

                alert("Thank you! Our team will contact you.");

                form.reset();

                // PDF open after successful submit
                window.open(
                    "https://www.theiotacademy.co/assets/pdf/industrial_training_4formpdf/3-Data-Science-And-Analytics.pdf",
                    "_blank"
                );

            } else {

                alert("Error: " + data);
            }

        })
        .catch(err => {

            btn.disabled = false;

            console.error(err);

            alert("Server Error");

        });

    });

});

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("programModalForm3");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const formData = new FormData(form);

        formData.append("form_name", "industrial-summer-training-programs Apply Form");
        formData.append("url_source", window.location.href);

        // button select
        const btn = form.querySelector("button");

        btn.disabled = true;

        fetch(window.location.origin + "/LiveLead/applyform3", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {

            btn.disabled = false;

            if (data.trim() === "success") {

                alert("Thank you! Our team will contact you.");

                form.reset();

                // PDF open after successful submit
                window.open(
                    "https://www.theiotacademy.co/assets/pdf/industrial_training_4formpdf/5-Prompt-Egineering-And-Generative-AI.pdf",
                    "_blank"
                );

            } else {

                alert("Error: " + data);
            }

        })
        .catch(err => {

            btn.disabled = false;

            console.error(err);

            alert("Server Error");

        });

    });

});

document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("programModalForm4");

    if (!form) return;

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const formData = new FormData(form);

        formData.append("form_name", "industrial-summer-training-programs Apply Form");
        formData.append("url_source", window.location.href);

        // button select
        const btn = form.querySelector("button");

        btn.disabled = true;

        fetch(window.location.origin + "/LiveLead/applyform4", {
            method: "POST",
            body: formData
        })
        .then(res => res.text())
        .then(data => {

            btn.disabled = false;

            if (data.trim() === "success") {

                alert("Thank you! Our team will contact you.");

                form.reset();

                // PDF open after successful submit
                window.open(
                    "https://www.theiotacademy.co/assets/pdf/industrial_training_4formpdf/6-Embedded-Systems-and-Internet-of-Things.pdf",
                    "_blank"
                );

            } else {

                alert("Error: " + data);
            }

        })
        .catch(err => {

            btn.disabled = false;

            console.error(err);

            alert("Server Error");

        });

    });

});






