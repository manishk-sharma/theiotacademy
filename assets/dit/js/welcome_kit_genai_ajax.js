document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('Welcome_Kit_Submit');
    if (!form) return;

    // set url_source
    document.getElementById('enqurl_source').value = window.location.href;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('/LiveLead/welcomekitgenai', {
            method: 'POST',
            body: formData
        })
        .then(res => res.text())
        .then(text => {
            let response;
            try {
                response = JSON.parse(text);
            } catch (e) {
                console.error(text);
                alert('Server error');
                return;
            }

            if (response.message === 'success') {

                document.getElementById('SuccessAlert').innerText =
                    response.response || 'Welcome Kit request submitted successfully!';
                document.getElementById('Successdvpp').classList.remove('d-none');

                form.reset();

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
