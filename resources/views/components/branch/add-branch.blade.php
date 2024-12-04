<x-master>
  <x-sidebar.sidebar>
    @if(session('error'))
        {{ dd(session('error')) }}
    @endif
    <div class="shadow-xl rounded-xl">
      <div class="px-10 py-5 bg-primary text-white rounded-t-xl">
        <h1 class="text-3xl font-medium">Add Branch</h1>
      </div>
      <div class="px-10 py-7 rounded-xl bg-white">
        <h2 class="text-xl font-medium mb-5 border-b-abu border-b-2">Branch Details</h2>
        <form action="{{ route('create-branch') }}" method="POST">
          @csrf
          <div class="mb-5">
            <label for="branchName" class="block mb-1 text-sm font-medium text-gray-900">Branch
              Name</label>
            <input type="text" name="branchName" id="branchName"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type branch name" required="">
          </div>
          <div class="grid md:grid-cols-2 md:gap-6 mb-5">
            <div>
              <label for="branchAddress" class="block mb-1 text-sm font-medium text-gray-900">Branch
                Address</label>
              <input type="text" name="branchAddress" id="branchAddress"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
                placeholder="Type branch address" required="">
            </div>
            <div>
              <label for="branchCity" class="block mb-1 text-sm font-medium text-gray-900">Branch
                City</label>
              <input type="text" name="branchCity" id="branchCity"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
                placeholder="Type branch city" required="">
            </div>
          </div>
          <div class="grid md:grid-cols-2 md:gap-6 mb-5">
            <div>
              <label for="branchProvince" class="block mb-1 text-sm font-medium text-gray-900">Branch
                Province</label>
              <input type="text" name="branchProvince" id="branchProvince"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
                placeholder="Type branch province" required="">
            </div>
            <div>
              <label for="branchZipCode" class="block mb-1 text-sm font-medium text-gray-900">Branch
                Zip Code</label>
              <input type="text" name="branchZipCode" id="branchZipCode"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
                placeholder="Type branch zip code" required="">
            </div>
            <input type="hidden" name="tenantCode" id="tenantCode" value="{{ session('tenant_code') }}">
  
          </div>
          <div class="flex justify-end gap-5">
            <a href="{{ route('branch') }}"
              class="flex items-center text-white bg-danger hover:shadow-button hover:shadow-danger lg:px-10 md:px-1 py-2 font-medium rounded-lg gap-1 flex-shrink-0 w-fit md:text-xs lg:text-base">
              <span>Cancel</span>
            </a>
            <button type="submit"
              class="flex items-center text-white bg-secondary hover:shadow-button hover:shadow-secondary lg:px-10 md:px-1 py-2 font-medium rounded-lg gap-1 flex-shrink-0 w-fit md:text-xs lg:text-base">
              <span>Submit</span>
            </button>
          </div>
        </form>
      </div>
    </div>

  </x-sidebar.sidebar>
</x-master>