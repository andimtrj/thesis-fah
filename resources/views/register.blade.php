<x-master>
  <div class="flex w-full h-screen bg-custom-gradient font-body">
    <x-decor.sidelog/>

    <div class="w-full bg-white shadow-2xl flex flex-col justify-center items-center">
      <form class="w-[32vw]" action="/api/register" method="POST">
        @csrf
        {{-- First Form --}}
        <div id="formStep1">
          <h1 class="text-3xl font-semibold mb-6">Register your restaurant</h1>
          <x-input type="email" name="email" id="email" label="Email" />
          <x-input type="password" name="password" id="password" label="Password" />
          {{-- <x-input type="password" name="password" id="password" label="Confirm password" /> --}}
          <div class="grid md:grid-cols-2 md:gap-6">
            <x-input type="text" name="firstName" id="firstName" label="First name" />
            <x-input type="text" name="lastName" id="lastName" label="Last name" />
          </div>
          <div class="grid md:grid-cols-2 md:gap-6">
            <x-input type="tel" name="phoneNumber" id="phoneNumber" label="Phone number" />
            <x-input type="text" name="tenantName" id="tenantName" label="Company" />
          </div>
          <div class="w-full flex justify-end">
            <button id="nextButton"
              class="text-white bg-primary hover:bg-secondary font-medium rounded-2xl w-full text-md px-5 py-2.5 text-center mb-5">Next</button>
          </div>
          <p class="text-center text-gray-500">Already have an account? <a href="/login"
              class="underline text-blue-500">Login here</a></p>
        </div>
        {{-- First Form --}}

        {{-- Second Form --}}
        <div id="formStep2" class="hidden">
          <x-input type="address" name="address" id="address" label="Address" />

          <div class="grid md:grid-cols-2 md:gap-6">
            <x-input type="text" name="province" id="province" label="Province" />
            <x-input type="text" name="city" id="city" label="City" />
          </div>

          <div class="grid md:grid-cols-2 md:gap-6">
            <x-input type="text" name="zipCode" id="zipCode" label="Postal/Zip Code" />
          </div>
          <div class="w-full flex justify-between">
            <button id="backButton"
              class="text-white bg-primary hover:bg-secondary font-medium rounded-2xl w-28 text-md px-5 py-2.5 text-center mb-5">Back</button>
            <button type="submit"
              class="text-white bg-primary hover:bg-secondary font-medium rounded-2xl w-28 text-md px-5 py-2.5 text-center mb-5">Submit</button>
          </div>
        </div>
        <input type="hidden" class="hidden" name="roleCode" id="roleCode" value="TO">
        {{-- Second Form --}}
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
