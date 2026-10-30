function removeTags(str) {
    if ((str === null) || (str === ''))
        return false;
    else
        str = str.toString();
    return str.replace(/(<([^>]+)>)/ig, '');
}
const baseurly="https://www.theiotacademy.co/";


document.getElementById("Payment_Details_Submit").addEventListener("submit", function(e) {
    e.preventDefault(); 
     document.getElementById('enqurl_source').value = window.location.href;
     const formUrl = baseurly + 'Payment_Training_Controller/send_details_of_payment_form';

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
            document.getElementById("Payment_Details_Submit").reset();
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