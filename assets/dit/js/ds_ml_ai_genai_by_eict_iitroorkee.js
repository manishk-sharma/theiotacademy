function handleFormSubmit(e) {
  e.preventDefault();

  const firstNameEl = document.getElementById("firstName");
  const lastNameEl  = document.getElementById("secondName");
  const mobileEl    = document.getElementById("mobileno");
  const emailEl     = document.getElementById("email");
  const workExpEl   = document.getElementById("work_experience");
  const callTimeEl  = document.getElementById("best_time_call");
  const forWhoEl    = document.getElementById("forwho");

  const firstName = firstNameEl.value.trim();
  const lastName  = lastNameEl.value.trim(); 
  const mobile    = mobileEl.value.trim();
  const email     = emailEl.value.trim();
  const workExp   = workExpEl.value;
  const callTime  = callTimeEl.value; 
  const forWho    = forWhoEl.value;   

  if (!firstName || !mobile || !email || !workExp) {
    alert("Please fill all required fields");
    return;
  }

  if (mobile.length < 9 || mobile.length > 10) {
    alert("Enter valid mobile number");
    return;
  }

  // ===== formdata =====
  const formData = new FormData();
  formData.append("firstname", firstName);
  formData.append("lastname", lastName);
  formData.append("mobileno", mobile);
  formData.append("email", email);
  formData.append("work_experience", workExp);
  formData.append("best_time_call", callTime);
  formData.append("forwho", forWho);
  formData.append("coursename", "DS ML AI GenAI");
  formData.append("form_name", "Book Your Slot");
  formData.append("url_source", window.location.href);

  fetch("https://www.theiotacademy.co/LiveLead/bookSlotSubmit", {
    method: "POST",
    body: formData
  })
    .then(res => res.json())
    .then(res => {
      if (res.message === "success") {
        e.target.reset();
        window.location.href = "./thank-you-10m-main";
      } else {
        alert(res.response || "Something went wrong ");
      }
    })
    .catch(err => {
      console.error(err);
      alert("Server error ");
    });
}



document.addEventListener("DOMContentLoaded", function () {

    const sideForm = document.getElementById("sideLeadForm");
    if (!sideForm) return;

    sideForm.addEventListener("submit", function (e) {
        e.preventDefault();

        document.getElementById("side_url_source").value = window.location.href;

        const formData = new FormData(sideForm);

        formData.append("form_name", "Side Lead Form"); 

        console.log([...formData.entries()]);

        fetch(baseurly + "LiveLead/bookSlotSubmit", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.message === "error") {
                alert(data.response);
            } else {
                sideForm.reset();
                window.location.href = "./thank-you-10m-main";
            }
        })
        .catch(err => {
            console.error("AJAX ERROR:", err);
            alert(" Something went wrong");
        });
    });

});


document.addEventListener('DOMContentLoaded', function () {

    const forms = document.querySelectorAll('.download-brochure-form');
    if (!forms.length) return;

    forms.forEach(function (form) {

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            //  CLEAR FORM NAME (IMPORTANT)
            let formName = '';
            if (form.id === 'downloadFormDsml') {
                formName = 'DSML Download Brochure';
            }
            if (form.id === 'downloadCurriculumFormDsml') {
                formName = 'DSML Download Curriculum';
            }

            formData.append('form_name', formName);
            formData.append('coursename', 'DS ML AI GenAI by E&ICT IIT Roorkee');
            formData.append('url_source', window.location.href);
            formData.append('lastname', '');
            formData.append('forwho', 'for myself');

            fetch(baseurly + 'LiveLead/bookSlotSubmit', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(response => {

                if (response.message === 'success') {
                    form.reset();
                    if (form.id === 'downloadCurriculumFormDsml') {
                        window.location.href = './thank-you-10m-curriculum';
                    } else {
                        window.location.href = './thank-you-10m-brochure';
                    }
                } else {
                    alert(response.response || 'Something went wrong');
                }
            })
            .catch(() => alert('Network error'));

        });

    });

});

document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('downloadProjectsFormDsml');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);
        formData.append('form_name', 'DSML Download Projects');
        formData.append('coursename', 'DS ML AI GenAI by E&ICT IIT Roorkee');
        formData.append('url_source', window.location.href);

        fetch(baseurly + "LiveLead/bookSlotSubmit", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(response => {

            if (response.message === 'success') {
                form.reset();
                window.location.href = './thank-you-10m-projects';
            } else {
                alert(response.response || 'Something went wrong');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Network error');
        });
    });

});


