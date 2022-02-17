<div>
  <x-jet-authentication-card>
      <x-slot name="logo">
          <x-jet-authentication-card-logo />
      </x-slot>
      @if ($status)
          <div class="mb-4 font-medium text-sm text-red-600">
              {{ __($status) }}
          </div>
      @endif
      <x-jet-validation-errors/>
      <div x-data="{phone:@entangle('show_phone'),code:@entangle('code'),show_profile:@entangle('show_profile')}">
        <div x-show="phone" x-init="{phone:@entangle('show_phone')}">
          <div>
              <x-jet-label for="phone_number" value="{{ __('ui.contact_number') }}" />
              <div class="flex items-center">
                <span class="text-lg mr-2">+91</span>
                <x-jet-input id="phone_number" class="block mt-1 w-full" wire:model="phone_number" type="text" name="phone_number" maxlength="10" required autofocus />
              </div>
          </div>
          <div class="mt-4">
              <x-jet-input id="expert" class="" type="checkbox" name="expert" wire:model="is_expert" autofocus/>{{ __('ui.expert.form.onboarding') }}
          </div>
          <div wire:ignore class="flex justify-center pb-2 mt-4">
              <x-jet-button id="sign-in-button">
                  {{ __('Log in') }}
              </x-jet-button>
          </div>
        </div>
        <div style="display: none;" x-show="show_profile"  x-init="{show_profile:@entangle('show_profile')}">
          <h1>{{__('ui.welcome')}}</h1>
          <div class="mt-4">
              <x-jet-label for="name" value="{{ __('ui.name') }}" />
              <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" wire:model="profile.name" autofocus/>
          </div>
          <div class="mt-4">
              <x-jet-label for="address" value="{{ __('ui.address') }}" />
              <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" wire:model="profile.address" autofocus/>
          </div>
          <div class="mt-4">
              <x-jet-label for="pincode" value="{{ __('ui.pincode') }}" />
              <x-jet-input id="pincode" class="block mt-1 w-full" type="text" name="pincode" wire:model="profile.pincode" autofocus/>
          </div>
          <div class="mt-4">
              <x-jet-input id="expert" class="" type="checkbox" name="expert" wire:model="is_expert" autofocus/>{{ __('ui.expert.form.onboarding') }}
          </div>
          <div class="flex justify-center pb-2 mt-4">
              <x-jet-button wire:click="profile_submit" x-on:click="mixpanel.track('Profile Submitted',{'Phone Number':'{{'+91'.$phone_number}}'})">
                {{ __('ui.onboarding_submit') }}
              </x-jet-button>
          </div>
        </div>
        <div style="display: none;" x-show="code"  x-init="{code:@entangle('code')}">
          <span>{{__('ui.verification_code')}}</span>
          <div>
              <x-jet-label for="code" value="{{ __('Verification code') }}" />
              <x-jet-input id="code" class="block mt-1 w-full" type="text" name="code" required autofocus />
          </div>
          <div class="flex items-center justify-between pb-2 mt-4">
            <div x-data="{countdown:false}" x-init="$watch('code',value=>{if(value){countdown=60,window.setInterval(()=>{if(countdown>0){countdown=countdown-1;}},1000);}})">
              <template x-if="countdown > 0">
                <div>
                  <span>00:</span><span x-text="countdown"></span>
                </div>
              </template>
              <template x-if="countdown==0"><div x-init="countdown=false"></div></template>
                <span class="underline cursor-pointer" x-show="!countdown" id='resend-code' x-on:click="countdown=60,window.setInterval(()=>{if(countdown>0){countdown=countdown-1;}},1000)">{{__('Resend code')}}</span>
            </div>
            <x-jet-button id="verify-code" type="submit">
                  {{ __('Verify code') }}
              </x-jet-button>
          </div>
        </div>
      </div>
  </x-jet-authentication-card>
  <script
    src="https://code.jquery.com/jquery-3.6.0.slim.min.js"
    integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI="
    crossorigin="anonymous"></script>
  <script type="module">
    // Import the functions you need from the SDKs you need
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.3/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.6.3/firebase-analytics.js";
    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
      apiKey: "AIzaSyAizXyqkBjohG5kKf1bSYEPcV4FdB7kFV4",
      authDomain: "seed-savers-club.firebaseapp.com",
      databaseURL: "https://seed-savers-club-default-rtdb.asia-southeast1.firebasedatabase.app",
      projectId: "seed-savers-club",
      storageBucket: "seed-savers-club.appspot.com",
      messagingSenderId: "268816215370",
      appId: "1:268816215370:web:3aa00a0d0a85de514aa5b3",
      measurementId: "G-VG6KQCPDB3"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
    import { getAuth, RecaptchaVerifier, signInWithPhoneNumber } from "https://www.gstatic.com/firebasejs/9.6.3/firebase-auth.js";

    const auth = getAuth();
    auth.languageCode = 'hi';
    $( document ).ready(function(){
      captcha();
    });
    function captcha(){
      window.recaptchaVerifier = new RecaptchaVerifier('sign-in-button', {
        'size': 'invisible',
        'callback': (response) => {
          // reCAPTCHA solved, allow signInWithPhoneNumber.
          console.log('captcha_success');
          onSignInSubmit();
        }
      }, auth);
      recaptchaVerifier.render().then(function(widgetId) {
         window.recaptchaWidgetId = widgetId;
       });
    }
    function onSignInSubmit() {
      const phoneNumber="+91"+$("#phone_number").val();
      const appVerifier = window.recaptchaVerifier;
      signInWithPhoneNumber(auth, phoneNumber, appVerifier)
          .then((confirmationResult) => {
            // SMS sent. Prompt user to type the code from the message, then sign the
            // user in with confirmationResult.confirm(code).
            window.confirmationResult = confirmationResult;
            console.log("SMS sent");
            @this.show_phone=false;
            @this.code=true;
            mixpanel.track('OTP Sent',{'Phone Number':phoneNumber});
            // ...
          }).catch((error) => {
            // Error; SMS not sent
            // ...
            grecaptcha.reset(window.recaptchaWidgetId);
            window.alert("Something went wrong");
            mixpanel.track('OTP Failed',{'Phone Number':phoneNumber});
          });
    }
    $("#verify-code").click(function(){
      verifyCode();
    });
    $("#resend-code").click(function(){
      grecaptcha.reset(window.recaptchaWidgetId);
      $("#sign-in-button").trigger("click");
    });
    function verifyCode(){
      const code = $("#code").val().replace(/\D/g, '');
      confirmationResult.confirm(code).then((result) => {
        // User signed in successfully.
        const user = result.user;
        console.log(user);
        mixpanel.track('OTP Verified',{'Phone Number':user.phoneNumber});
        mixpanel.register({'Phone Number': user.phoneNumber});
        @this.sign_in();
        // ...
      }).catch((error) => {
        // User couldn't sign in (bad verification code?)
        // ...
        @this.sign_in();
        const phoneNumber='+91'+@this.phone_number;
        mixpanel.track('OTP verification failed');
        mixpanel.register({'Phone Number': phoneNumber});
      });
    }
  </script>
</div>