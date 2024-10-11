<x-master>
  @if (session('error'))
    <div
      class="fixed top-4 right-4 w-11/12 sm:w-1/2 md:w-2/5 lg:w-2/5 bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-md mb-4 z-50"
      role="alert">
      <strong class="font-bold">Registration Failed!</strong>
      <span class="block sm:inline">{{ session('error') }}</span>
      <button type="button" class="absolute top-2 right-2 p-1.5 text-yellow-500 hover:text-yellow-700" aria-label="Close"
        onclick="this.parentElement.style.display='none';">
        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
          <path
            d="M14.707 15.293a1 1 0 0 0 0-1.414L10.414 10l4.293-4.293a1 1 0 0 0-1.414-1.414L9 8.586 4.707 4.293A1 1 0 0 0 3.293 5.707L7.586 10l-4.293 4.293a1 1 0 0 0 1.414 1.414L9 11.414l4.293 4.293a1 1 0 0 0 1.414 0z" />
        </svg>
      </button>
    </div>
  @endif



  <div class="flex w-full h-screen bg-custom-gradient font-body">
    <x-decor.sidelog />

    <div class="w-full bg-white shadow-2xl flex flex-col justify-center items-center">
      <form class="w-[32vw]" action="/registration" method="POST">
        @csrf

        {{-- First Form --}}
        <div id="formStep1">
          <h1 class="text-3xl font-semibold mb-6">Register your restaurant</h1>

          {{-- Email --}}
          <x-input type="email" name="email" id="email" label="Email" value="{{ old('email') }}">
            @if ($errors->has('email'))
              <p class="text-red-500 text-sm">{{ $errors->first('email') }}</p>
            @endif
          </x-input>

          {{-- Password --}}
          <x-input type="password" name="password" id="password" label="Password">
            @if ($errors->has('password'))
              <p class="text-red-500 text-sm">{{ $errors->first('password') }}</p>
            @endif
          </x-input>

          {{-- First Name and Last Name --}}
          <div class="grid md:grid-cols-2 md:gap-6">
            <x-input type="text" name="firstName" id="firstName" label="First name" value="{{ old('firstName') }}">
              @if ($errors->has('firstName'))
                <p class="text-red-500 text-sm">{{ $errors->first('firstName') }}</p>
              @endif
            </x-input>


            <x-input type="text" name="lastName" id="lastName" label="Last name" value="{{ old('lastName') }}">
              @if ($errors->has('lastName'))
                <p class="text-red-500 text-sm">{{ $errors->first('lastName') }}</p>
              @endif
            </x-input>

          </div>

          {{-- Phone Number and Tenant Name --}}
          <div class="grid md:grid-cols-2 md:gap-6">
            <x-input type="tel" name="phoneNumber" id="phoneNumber" label="Phone number"
              value="{{ old('phoneNumber') }}">
              @if ($errors->has('phoneNumber'))
                <p class="text-red-500 text-sm">{{ $errors->first('phoneNumber') }}</p>
              @endif
            </x-input>

            <x-input type="text" name="tenantName" id="tenantName" label="Company" value="{{ old('tenantName') }}">
              @if ($errors->has('tenantName'))
                <p class="text-red-500 text-sm">{{ $errors->first('tenantName') }}</p>
              @endif
            </x-input>

          </div>

          <div class="w-full flex justify-end">
            <button id="nextButton"
              class="text-white bg-primary hover:bg-secondary font-medium rounded-2xl w-full text-md px-5 py-2.5 text-center mb-5">Next</button>
          </div>

          <p class="text-center text-gray-500">Already have an account? <a href="/login"
              class="underline text-blue-500">Login here</a></p>
        </div>
        {{-- End of First Form --}}

        {{-- Second Form --}}
        <div id="formStep2" class="hidden">
          <x-input type="text" name="address" id="address" label="Address" value="{{ old('address') }}">
            @if ($errors->has('address'))
              <p class="text-red-500 text-sm">{{ $errors->first('address') }}</p>
            @endif
          </x-input>


          <div class="grid md:grid-cols-2 md:gap-6">
            <x-input type="text" name="province" id="province" label="Province" value="{{ old('province') }}">
              @if ($errors->has('province'))
                <p class="text-red-500 text-sm">{{ $errors->first('province') }}</p>
              @endif
            </x-input>

            <x-input type="text" name="city" id="city" label="City" value="{{ old('city') }}">
              @if ($errors->has('city'))
                <p class="text-red-500 text-sm">{{ $errors->first('city') }}</p>
              @endif
            </x-input>

          </div>

          <div class="grid md:grid-cols-2 md:gap-6">
            <x-input type="text" name="zipCode" id="zipCode" label="Postal/Zip Code" value="{{ old('zipCode') }}">
              @if ($errors->has('zipCode'))
                <p class="text-red-500 text-sm">{{ $errors->first('zipCode') }}</p>
              @endif
            </x-input>

          </div>

          <div class="w-full flex justify-between">
            <button id="backButton"
              class="text-white bg-primary hover:bg-secondary font-medium rounded-2xl w-28 text-md px-5 py-2.5 text-center mb-5">Back</button>
            <button type="submit"
              class="text-white bg-primary hover:bg-secondary font-medium rounded-2xl w-28 text-md px-5 py-2.5 text-center mb-5">Submit</button>
          </div>
        </div>
        {{-- End of Second Form --}}

        <input type="hidden" name="roleCode" id="roleCode" value="TO">
      </form>
    </div>
  </div>


  <script>
    // JavaScript to toggle between forms
    document.getElementById('nextButton').addEventListener('click', function(event) {
      event.preventDefault(); // Prevent form submission when navigating
      document.getElementById('formStep1').classList.add('hidden');
      document.getElementById('formStep2').classList.remove('hidden');
    });

    document.getElementById('backButton').addEventListener('click', function(event) {
      event.preventDefault(); // Prevent form submission when navigating
      document.getElementById('formStep1').classList.remove('hidden');
      document.getElementById('formStep2').classList.add('hidden');
    });

    document.querySelector('form').addEventListener('submit', function(event) {
      form.submit();
    });
  </script>
</x-master>
