document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('Welcome_Kit_Submit');
    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // url source set
        const urlInput = document.getElementById('enqurl_source');
        if (urlInput) {
            urlInput.value = window.location.href;
        }

        const formData = new FormData(form);

        const formUrl = baseurly + 'LiveLead/welcomekitdsml';

        fetch(formUrl, {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(data => {

            if (data.message === 'success') {

                // success message show
                document.getElementById('SuccessAlert').innerText =
                    'Your Welcome Kit request has been submitted successfully.';
                document.getElementById('Successdvpp').classList.remove('d-none');

                form.reset();

                setTimeout(() => {
                    window.location.href = baseurly + 'thank-you';
                }, 2000);

            } else {
                alert(data.response || 'Something went wrong');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Server error, please try again');
        });
    });
});