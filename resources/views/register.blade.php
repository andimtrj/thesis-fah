<x-master>
  <div class="flex w-full h-screen bg-custom-gradient font-body">
    <div class="half-background w-full flex justify-center items-center">
      <div class="text-center max-w-xl flex flex-col justify-center items-center">
        <h1 class="lg:text-5xl md:text-4xl font-bold text-abu mb-3">Hello World!</h1>
        <p class="text-xl md:text-lg text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit.
          Dolore, a
          exercitationem.
        </p>
      </div>
    </div>

    <div class="w-full bg-abu shadow-2xl flex flex-col justify-center items-center">
      <form class="w-[32vw]">

        {{-- First Form --}}
        <div id="formStep1">
          <h1 class="text-3xl font-semibold mb-6">Register your restaurant</h1>
          <x-input type="email" name="email" id="email" label="Email" />
          <x-input type="password" name="password" id="password" label="Password" />
          <x-input type="password" name="password" id="password" label="Confirm password" />
          <div class="grid md:grid-cols-2 md:gap-6">
            <x-input type="text" name="first_name" id="first_name" label="First name" />
            <x-input type="text" name="last_name" id="last_name" label="Last name" />
          </div>
          <div class="grid md:grid-cols-2 md:gap-6">
            <x-input type="tel" name="phone_number" id="phone_number" label="Phone number" />
            <x-input type="text" name="company" id="company" label="Company" />
          </div>
          <div class="w-full flex justify-end">
            <button id="nextButton"
              class="text-white bg-primary hover:bg-opacity-70 font-medium rounded-2xl w-full text-md px-5 py-2.5 text-center mb-5">Next</button>
          </div>
          <p class="text-center text-gray-500">Already have an account? <a href="/login"
              class="underline text-primary">Login here</a></p>
        </div>
        {{-- First Form --}}

        {{-- Second Form --}}
        <div id="formStep2" class="hidden">
          <div class="relative z-0 w-full mb-5 group">
            <input type="address" name="address" id="address"
              class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
              placeholder=" " required />
            <label for="address"
              class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Street
              Address</label>
          </div>

          <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
              <input type="text" name="province" id="province"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
              <label for="province"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Province</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
              <input type="text" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="city" id="city"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
              <label for="city"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">City</label>
            </div>
          </div>

          <div class="grid md:grid-cols-2 md:gap-6">
            <div class="relative z-0 w-full mb-5 group">
              <input type="text" name="district" id="district"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
              <label for="district"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">District</label>
            </div>
            <div class="relative z-0 w-full mb-5 group">
              <input type="text" name="postal_code" id="postal_code"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
              <label for="postal_code"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Postal/Zip
                Code</label>
            </div>
          </div>
          <div class="w-full flex justify-between">
            <button id="backButton"
              class="text-white bg-primary hover:bg-opacity-70 font-medium rounded-2xl w-28 text-md px-5 py-2.5 text-center mb-5">Back</button>
            <button type="submit"
              class="text-white bg-primary hover:bg-opacity-70 font-medium rounded-2xl w-28 text-md px-5 py-2.5 text-center mb-5">Submit</button>
          </div>
        </div>
        {{-- Second Form --}}
      </form>

    </div>
  </div>

  <script>
    // JavaScript to toggle between forms
    document.getElementById('nextButton').addEventListener('click', function() {
      document.getElementById('formStep1').classList.add('hidden');
      document.getElementById('formStep2').classList.remove('hidden');
    });

    document.getElementById('backButton').addEventListener('click', function() {
      document.getElementById('formStep1').classList.remove('hidden');
      document.getElementById('formStep2').classList.add('hidden');
    });
  </script>
</x-master>
