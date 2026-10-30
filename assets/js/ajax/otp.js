function sendOTP(otpUrl, formName) {
  var baseurl = document.getElementById('baseurl').value;

  baseurl = baseurl + otpUrl;

  //getting email id from  email field where id must be = #email

  var email = $('#email' + formName).val();

  data = email;

  $.ajax({
    type: 'post',
    url: baseurl,
    data: {
      email: email
    },
    //async:false,
    cache: false,
    success: function (response) {
      var data = JSON.parse(response);
      //console.log(data);
      storedata(response, formName);
    }
  });
}
function storedata(data, formName) {
  /*create <input type="hidden" name="otpdata" id="otpdata">
    to store otp value in view page*/
  $('#otpdata' + formName).val(data);
}
