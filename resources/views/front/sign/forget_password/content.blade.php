    <div class="content d-flex align-items-center pt-5 pb-5" id="phoneDiv">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12"></div>
                <div class="col-lg-6 col-12">
                    <h5 class="fw-bold text-center mb-2">{{ __('site.forgot_your_password') }} !</h5>
                    <p class="text-center mb-4">{{ __('site.please_enter_your') }}</p>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" id="number" class="w-100 mb-4 p-4"
                                placeholder="{{ __('site.phone') }}" required>
                            <div id="recaptcha-container"></div>
                        </div>
                        <div class="col-12 d-flex justify-content-center mb-2 mt-4">
                            <button class="btn-submit" type="button" onclick="sendOTP();">{{ __('site.send') }}</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12"></div>
            </div>
        </div>
    </div>



<div class="content d-flex align-items-center pt-5 pb-5 d-none" id="verifyDiv">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12"></div>
            <div class="col-lg-6 col-12 justify-content-center d-flex flex-column align-items-center">
                <h5 class="fw-bold mb-2">ادخل الكود التأكيدى.</h5>
                <p>سيتم ارسال كود تأكيدى على رقم الموبيل الخاص بك</p>
                <div class="mt-2">
                    <input type="text" maxlength="1" id="verification1" oninput="moveToNextInput(event)" style="text-align: center;" class="input-verificat">
                    <input type="text" maxlength="1" id="verification2" oninput="moveToNextInput(event)" style="text-align: center;" class="input-verificat">
                    <input type="text" maxlength="1" id="verification3" oninput="moveToNextInput(event)" style="text-align: center;" class="input-verificat">
                    <input type="text" maxlength="1" id="verification4" oninput="moveToNextInput(event)" style="text-align: center;" class="input-verificat">
                    <input type="text" maxlength="1" id="verification5" oninput="moveToNextInput(event)" style="text-align: center;" class="input-verificat">
                    <input type="text" maxlength="1" id="verification6" oninput="moveToNextInput(event)" style="text-align: center;" class="input-verificat">
                </div>
                    <button class="btn-submit btn-accept ms-3 mt-5" onclick="verify()" type="button">تأكيد</button>
            </div>
            <div class="col-lg-3 col-12"></div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>

<script>

    $('.btn-submit').on('click', function(){
        $('#verifyDiv').removeClass('d-none');
        $('#phoneDiv').addClass('d-none');
    })

    function moveToNextInput(event) {
        const input = event.target;
        const maxLength = parseInt(input.getAttribute('maxlength'));

        if (input.value.length >= maxLength) {
            const nextInput = input.nextElementSibling;
            if (nextInput && nextInput.tagName === 'INPUT') {
                nextInput.focus();
            }
        }
    }


    const firebaseConfig = {
        apiKey: "AIzaSyAuaYWB-m9mC2qb51shgieMTt-ZgNbWA-s",
        authDomain: "daawat-deac0.firebaseapp.com",
        projectId: "daawat-deac0",
        storageBucket: "daawat-deac0.appspot.com",
        messagingSenderId: "950480129606",
        appId: "1:950480129606:web:9342ea911426efa32dc447",
        measurementId: "G-898VMQN8EX"
    };
    firebase.initializeApp(firebaseConfig);
</script>
<script type="text/javascript">
    window.onload = function () {
        render();
    };
    function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();
    }
    function sendOTP() {
        var number = $("#number").val();
        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            console.log(coderesult.verificationId);
            localStorage.setItem('coderesult',coderesult)
            $("#successAuth").text("Message sent");
            $("#successAuth").show();
        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
        });
    }
    function verify() {
        var num1 = $("#verification1").val();
        var num2 = $("#verification2").val();
        var num3 = $("#verification3").val();
        var num4 = $("#verification4").val();
        var num5 = $("#verification5").val();
        var num6 = $("#verification6").val();
        var code = (num1 +''+ num2 +''+ num3 +''+ num4 +''+ num5 +''+ num6);
        coderesult.confirm(code).then(function (result) {
            var user = result.user;
            var phoneNumber = result.user.phoneNumber;
            var refreshToken = result.user.refreshToken;
            console.log(user);
            console.log(phoneNumber);
            console.log(refreshToken);
            console.log(code);
            // Generate the URL with replacements using Blade syntax
            var url = "{{ route('newPassword', [':code', ':phone',':token']) }}";
            url = url.replace(':code', code);
            url = url.replace(':phone', phoneNumber);
            url = url.replace(':token', refreshToken);

            // console.log(url);
           window.location.href = url;

        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
        });
    }
</script>
