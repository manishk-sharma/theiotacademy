    // signin
    function formHandler(event) {
        event.preventDefault();
        const form = document.getElementById('myForm');
        const formData = new FormData(form);
        const email = formData.get('email'); 
        const password = formData.get('password'); 
        console.log('Email:', email);
        console.log('Password:', password);

        const formObject = Object.fromEntries(formData.entries());
        console.log('Form Data Object:', formObject);
        alert('Sign in successful!');
        form.reset();
    }

    // signup
    function signupformHandler(event) {
        event.preventDefault(); 
        const form = document.getElementById('signupForm');
        const formData = new FormData(form);
    
        const formObject = {};
        formData.forEach((value, key) => {
            if (key === "profileImage") {
                formObject[key] = value.name; 
            } else {
                formObject[key] = value;
            }
        });
    
        console.log("Form Data Object:", formObject);
        console.log("Image File:", formData.get("profileImage"));
        alert('successful!');

        form.reset();
    }
    