<form id="password-reset-form">
    @csrf
    <div class="content d-flex align-items-center pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12"></div>
                <div class="col-lg-6 col-12">
                    <h5 class="fw-bold text-center mb-2">{{ __('site.forgot_your_password') }} !</h5>
                    <p class="text-center mb-4">{{ __('site.please_enter_your') }}</p>
                    <div class="row">
                        <div class="col-12">
                            <input type="text" class="w-100 mb-4 p-4" id="phone"
                                placeholder="{{ __('site.phone') }}" required>
                        </div>
                        <div class="col-12 d-flex justify-content-center mb-2 mt-4">
                            {{-- <a href="verification.html" class="text-decoration-none"> --}}
                            <button class="btn-submit" type="submit">{{ __('site.send') }}</button>
                            {{-- </a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12"></div>
            </div>
        </div>
    </div>
</form>
<script src="https://www.gstatic.com/firebasejs/9.6.3/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/9.6.3/firebase-auth.js"></script>
<script>
    // Replace with your Firebase project's configuration
    const firebaseConfig = {
        apiKey: "YOUR_API_KEY",
        authDomain: "YOUR_AUTH_DOMAIN",
        projectId: "YOUR_PROJECT_ID",
        storageBucket: "YOUR_STORAGE_BUCKET",
        messagingSenderId: "YOUR_MESSAGING_SENDER_ID",
        appId: "YOUR_APP_ID",
        measurementId: "YOUR_MEASUREMENT_ID"
    };

    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    // Password reset form
    const passwordResetForm = document.getElementById('password-reset-form');
    passwordResetForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const phone = document.getElementById('phone').value;
        const phoneNumber = `+${phone}`; // Ensure phone number is in E.164 format
        const auth = firebase.auth();

        // Send password reset code via phone
        auth.verifyPhoneNumber(phoneNumber, new firebase.auth.RecaptchaVerifier('password-reset-form'))
            .then((verificationId) => {
                const code = prompt('Please enter the verification code sent to your phone:');
                const credential = firebase.auth.PhoneAuthProvider.credential(verificationId, code);
                return auth.signInWithCredential(credential);
            })
            .then(() => {
                // User successfully verified with the code
                // You can redirect to the password reset page or perform any other action here.
                alert('Phone number verified successfully!');
            })
            .catch((error) => {
                console.error(error);
                alert('Failed to verify phone number. Please try again.');
            });
    });
</script>
