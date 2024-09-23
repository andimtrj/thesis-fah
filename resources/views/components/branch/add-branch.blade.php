<x-master>
  <x-sidebar.sidebar>
    <h1 class="text-3xl font-medium mb-5">Add Branch</h1>
    <div class="bg-cream px-10 py-7 rounded-xl shadow-md">
      <h2 class="text-xl font-medium mb-5 border-b-abu border-b-2">Branch Details</h2>
      <form action="" method="">
        <div class="mb-5">
          <label for="branch_name" class="block mb-1 text-sm font-medium text-gray-900">Branch
            Name</label>
          <input type="text" name="branch_name" id="branch_name"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
            placeholder="Type branch name" required="">
        </div>
        <div class="grid md:grid-cols-2 md:gap-6 mb-5">
          <div>
            <label for="branch_name" class="block mb-1 text-sm font-medium text-gray-900">Branch
              Address</label>
            <input type="text" name="branch_name" id="branch_name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type branch address" required="">
          </div>
          <div>
            <label for="branch_name" class="block mb-1 text-sm font-medium text-gray-900">Branch
              City</label>
            <input type="text" name="branch_name" id="branch_name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type branch city" required="">
          </div>
        </div>
        <div class="grid md:grid-cols-2 md:gap-6 mb-5">
          <div>
            <label for="branch_name" class="block mb-1 text-sm font-medium text-gray-900">Branch
              Province</label>
            <input type="text" name="branch_name" id="branch_name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type branch province" required="">
          </div>
          <div>
            <label for="branch_name" class="block mb-1 text-sm font-medium text-gray-900">Branch
              Zip Code</label>
            <input type="text" name="branch_name" id="branch_name"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type branch zip code" required="">
          </div>
        </div>
        <div class="flex justify-end">
          <button type="submit"
            class="flex items-center text-white bg-accent lg:px-3 md:px-1 py-2 rounded-lg gap-1 flex-shrink-0 shadow-sm w-fit md:text-xs lg:text-base">
            <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 12h14m-7 7V5" />
            </svg>
            <span>Add Branch</span>
          </button>
        </div>
      </form>

    </div>
  </x-sidebar.sidebar>
</x-master>
