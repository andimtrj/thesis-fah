<x-master>
  <x-sidebar.sidebar>
    <div class="shadow-xl rounded-xl">
      <div class="flex justify-between gap-3 items-center px-10 py-5 bg-primary rounded-t-xl">
        <div class="flex items-center">
          <h1 class="text-3xl font-medium text-white">Branch Admin</h1>
        </div>
        <div class="flex gap-3">
          <a href="{{ route('add-branchAdmin') }}"
            class="flex items-center text-white bg-accent lg:px-3 md:px-1 py-2 rounded-lg gap-1 flex-shrink-0 shadow-container w-fit md:text-xs lg:text-base">
            <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 12h14m-7 7V5" />
            </svg>
            <span>Add Admin</span>
          </a>
        </div>
      </div>
      <div class="px-10 py-7 rounded-xl bg-white">
        <div class="flex gap-5 w-full">
          <div class="relative z-0 w-full">
            <input type="text" id="floating_standard" value="B00001"
              class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
              placeholder=" " disabled />
            <label for="floating_standard"
              class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Branch
              Code</label>
          </div>
          <div class="relative z-0 w-full">
            <input type="text" id="floating_standard" value="This is Resaturant Jakarta Selatan"
              class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
              placeholder=" " disabled />
            <label for="floating_standard"
              class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Branch
              Name</label>
          </div>
        </div>
      </div>
    </div>

    <form action="" class="mt-5">
      <div class="flex gap-3">
        <div class="w-[18vw] flex items-center relative">
          <input type="text" id="branchCode" name="branchCode"
            class="block w-full p-2 ps-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-primary focus:border-primary"
            placeholder="Search by admin name" value="{{ request('branchCode') }}">
        </div>
        <div class="w-[18vw] flex items-center relative">
          <input type="text" id="branchCode" name="branchCode"
            class="block w-full p-2 ps-3 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-primary focus:border-primary"
            placeholder="Search by admin username" value="{{ request('branchCode') }}">
        </div>
        <div class="flex gap-2 items-end">
          <button type="submit"
            class="bg-secondary bg-opacity-10 rounded-lg px-5 py-2 text-secondary flex items-center gap-1">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
            </svg>
            <span>Search</span>
          </button>
          <a href="{{ route('branch') }}"
            class="bg-danger bg-opacity-10 rounded-lg px-5 py-2 text-danger flex items-center gap-1">
            <span>Clear Search</span>
          </a>
        </div>
      </div>
    </form>

    <div class="mt-5">
      <x-branch-admin.table />
    </div>
  </x-sidebar.sidebar>
</x-master>
