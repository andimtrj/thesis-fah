<x-master>
  <x-sidebar.sidebar>
    <div class="px-10 py-5 bg-primary text-white rounded-t-xl">
      <h1 class="text-3xl font-medium">Edit Branch</h1>
    </div>
    <div class="px-10 py-7 rounded-xl bg-white">
      <h2 class="text-xl font-medium mb-5 border-b-2 border-abu">Branch Details</h2>
      <form action="" method="">
        <div class="mb-5">
          <label for="branch_name" class="block mb-1 text-sm font-medium text-gray-900">Branch
            Name</label>
          <input type="text" name="branch_name" id="branch_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
            placeholder="Current branch name" required="">
        </div>
        <div class="grid md:grid-cols-2 md:gap-6 mb-5">
          <div>
            <label for="branch_name" class="block mb-1 text-sm font-medium text-gray-900">Branch
              Address</label>
            <input type="text" name="branch_name" id="branch_name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Current branch address" required="">
          </div>
          <div>
            <label for="branch_name" class="block mb-1 text-sm font-medium text-gray-900">Branch
              City</label>
            <input type="text" name="branch_name" id="branch_name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Current branch city" required="">
          </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6 mb-5">
          <div>
            <label for="branch_name" class="block mb-1 text-sm font-medium text-gray-900">Branch
              Province</label>
            <input type="text" name="branch_name" id="branch_name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Current branch province" required="">
          </div>
          <div>
            <label for="branch_name" class="block mb-1 text-sm font-medium text-gray-900">Branch
              Zip Code</label>
            <input type="text" name="branch_name" id="branch_name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Current branch zip code" required="">
          </div>
        </div>
        <div class="flex justify-end gap-5">
          <a href="{{ route('branch') }}"
            class="flex items-center text-white bg-danger hover:shadow-container lg:px-10 md:px-1 py-2 font-medium rounded-lg gap-1 flex-shrink-0 w-fit md:text-xs lg:text-base">
            <span>Cancel</span>
          </a>
          <button type="submit"
            class="flex items-center text-white bg-secondary hover:shadow-container lg:px-10 md:px-1 py-2 font-medium rounded-lg gap-1 flex-shrink-0 w-fit md:text-xs lg:text-base">
            <span>Submit</span>
          </button>
        </div>
      </form>

    </div>
  </x-sidebar.sidebar>
</x-master>
