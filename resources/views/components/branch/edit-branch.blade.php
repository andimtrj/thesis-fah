<x-master>
  <x-sidebar.sidebar>
    <h1 class="text-3xl font-medium mb-5">Edit Branch</h1>
    <div class="bg-cream px-10 py-7 rounded-xl">
      <h2 class="text-xl font-medium mb-5 border-b-abu border-b-2">Branch Details</h2>
      <form action="{{ route('update-branch', ['id' => $branch->id]) }}" method="POST">
        @csrf
        <div class="mb-5">
          <label for="branch_name" class="block mb-1 text-sm font-medium text-gray-900">Branch
            Name</label>
          <input type="text" name="branch_name" id="branch_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
            placeholder="Current branch name" required=""
            value="{{ $branch->branch_name }}">
        </div>
        <div class="grid md:grid-cols-2 md:gap-6 mb-5">
          <div>
            <label for="address" class="block mb-1 text-sm font-medium text-gray-900">Branch
              Address</label>
            <input type="text" name="address" id="address"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Current branch address" required=""
              value="{{ $branch->address }}">
          </div>
          <div>
            <label for="city" class="block mb-1 text-sm font-medium text-gray-900">Branch
              City</label>
            <input type="text" name="city" id="city"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Current branch city" required=""
              value="{{ $branch->city }}">
          </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6 mb-5">
          <div>
            <label for="province" class="block mb-1 text-sm font-medium text-gray-900">Branch
              Province</label>
            <input type="text" name="province" id="province"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Current branch province" required=""
              value="{{ $branch->province }}">
          </div>
          <div>
            <label for="zip_code" class="block mb-1 text-sm font-medium text-gray-900">Branch
              Zip Code</label>
            <input type="text" name="zip_code" id="zip_code"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Current branch zip code" required=""
              value="{{ $branch->zip_code }}">
          </div>
        </div>
        <div class="flex justify-end">
          <button type="submit"
            class="flex items-center text-white bg-accent lg:px-3 md:px-1 py-2 rounded-lg gap-1 flex-shrink-0 shadow-sm w-fit md:text-xs lg:text-base">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
            <span>Edit Branch</span>
          </button>
        </div>
      </form>

    </div>
  </x-sidebar.sidebar>
</x-master>
