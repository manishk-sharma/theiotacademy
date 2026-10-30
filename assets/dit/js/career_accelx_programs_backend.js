document.getElementById("Enquiry_Now_Form").addEventListener("submit", function(e) {
    e.preventDefault(); 
    document.getElementById('enqurl_source').value = window.location.href;
    
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
            document.getElementById("Enquiry_Now_Form").reset();
            const successMsg=document.getElementById("ensuccess-msg");
            successMsg.style.display = 'block';
            successMsg.innerHTML = data.response;
            setTimeout(() => { successMsg.style.display = 'none'; }, 15000);
        } else {
            const errorMsg = document.getElementById('ensuccess-msg');
            errorMsg.style.display = 'block';
            errorMsg.innerHTML = data.response;
            setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
    })
});

/*==========End corporate Form ==========*/




//  function
function handleBrochureFormSubmit(formId, pdfPath) {
    document.getElementById(formId).addEventListener("submit", function (e) {
      e.preventDefault();
  
      // current URL
      document.querySelectorAll(`#${formId} .brochure_source_url`).forEach(el => {
        el.value = window.location.href;
      });
  
      const formUrl = baseurly + 'LiveLead/liveleadsubmit';
      const formData = new FormData(this);
      document.getElementById("enqform-overlay").style.display = "block";
  
      fetch(formUrl, {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        document.getElementById("enqform-overlay").style.display = "none";
        if (data.message === "error") {
          alert(removeTags(data.response));
        } else if (data.message === "success") {
          this.reset();
          window.location.href = baseurly + pdfPath;
        } else {
          const errorMsg = document.getElementById('dwnbrerror-msg');
          errorMsg.style.display = 'block';
          errorMsg.innerHTML = data.response;
          setTimeout(() => { errorMsg.style.display = 'none'; }, 15000);
        }
      });
    });
  }
  

  const brochureForms = [
    ["Prompt_Download_brochForm", "assets/coursesyllabus/career-accelx-programs/prompt_engineering.pdf"],
    ["Prompt_brochForm_Working_Professionals", "assets/coursesyllabus/career-accelx-programs/prompt_engineering.pdf"],
    ["Download_brochForm_Second", "assets/coursesyllabus/career-accelx-programs/data_analytics_essentials.pdf"],
    ["Download_brochForm_Third", "assets/coursesyllabus/career-accelx-programs/tableau_power_bi.pdf"],
    ["Download_brochForm_Fourth", "assets/coursesyllabus/career-accelx-programs/data_science.pdf"],
    ["Download_brochForm_Fifth", "assets/coursesyllabus/career-accelx-programs/python_programming.pdf"],
    ["Download_brochForm_Sixth", "assets/coursesyllabus/career-accelx-programs/advanced_mlops_engineering.pdf"],
    ["Download_brochForm_Seventh", "assets/coursesyllabus/career-accelx-programs/excel_for_working_professionals.pdf"],
    ["Download_brochForm_Eight", "assets/coursesyllabus/career-accelx-programs/nlp_and_llm.pdf"],
    ["Download_brochForm_Nineth", "assets/coursesyllabus/career-accelx-programs/ai_for_business_automation_managers.pdf"],
    ["Download_brochForm_Eleventh", "assets/coursesyllabus/career-accelx-programs/iot_and_embedded_system.pdf"],
    ["Download_brochForm_Twelth", "assets/coursesyllabus/career-accelx-programs/ai_and_machine_learning.pdf"],
    ["Download_brochForm_Thirteen", "assets/coursesyllabus/career-accelx-programs/data_analysis_for_working_professionals.pdf"],
  ];

  brochureForms.forEach(([formId, pdfPath]) => {
    handleBrochureFormSubmit(formId, pdfPath);
  });
  