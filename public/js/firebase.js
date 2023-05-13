$(document).ready(function() {
    const firebaseConfig = {
        apiKey: "AIzaSyAq_fZ0yPVt6sWEqxtPxDITJYQ49rz4GT0",
        authDomain: "phone-otp-8e486.firebaseapp.com",
        projectId: "phone-otp-8e486",
        storageBucket: "phone-otp-8e486.appspot.com",
        messagingSenderId: "344385864111",
        appId: "1:344385864111:web:5d27f661a03d1e73cc6f5a",
        measurementId: "G-N88YYK2DJQ"
      };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'invisible',
            'callback': function (response) {
                // reCAPTCHA solved, allow signInWithPhoneNumber.
                console.log('recaptcha resolved');
            }
        });
        onSignInSubmit();
    
});


function onSignInSubmit() {
    $('#verifPhNum').on('click', function() {
        let isAuth = false;
        let phoneNo = '';
        var code = $('#codeToVerify').val();
        console.log(code);
        $(this).attr('disabled', 'disabled');
        $(this).text('Processing..');
        confirmationResult.confirm(code).then(function (result) {
                    // alert('Succecss');
                    isAuth = true;
                    phoneNo = result.user.phoneNumber;
                    console.log(phoneNo);
                    console.log(isAuth);
                    var user = result.user;
            console.log(user);
    
    
            // ...
        }.bind($(this))).catch(function (error) {
        
            // User couldn't sign in (bad verification code?)
            // ...
            $(this).removeAttr('disabled');
            $(this).text('Invalid Code');
            setTimeout(() => {
                $(this).text('Verify Phone No');
            }, 2000);
        }.bind($(this)));

    
    });
    
    
    $('#SendCode').on('submit', function (e) {
        $("#register-btn").html('Please Wait').prop('disabled', true);

        e.preventDefault()
        var phoneNo = $('#phone').val();
        console.log(phoneNo);


        // getCode(phoneNo);
        var appVerifier = window.recaptchaVerifier;
        firebase.auth().signInWithPhoneNumber(phoneNo, appVerifier)
        .then(function (confirmationResult) {
    
            window.confirmationResult=confirmationResult;
            coderesult=confirmationResult;
            console.log(coderesult);
        }).catch(function (error) {
            console.log(error.message);
    
        });


        $.ajax({
            url:"/register",
            header:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            type:'POST',
            data: new FormData(this),
            processData:false,
            contentType:false,
            success:function(data){
                // console.log(data.error);
                // window.location.replace("/verifiy")
                $("#register-btn").html('Sign UP').prop('disabled', false);
                // url = `/verifiy?phone=${phoneNo}`
                // window.location.href(url)

            },
            error:function(data)
            {
                $("#register-btn").html('Sign UP').prop('disabled', false);
                
                if(data.status == 422){
                    // printErrorMsg(data.responseJSON.errors)
                    msg = data.responseJSON.errors
                    $.each(msg,function(key,value){
                        $(`.${key}_err`).text(value)
                        notyf.open({
                                type: 'error',
                                message: value
                        
                            });
                    })
                }

                
            }

        });
    });
}

