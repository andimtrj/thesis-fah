<x-master>
  <x-sidebar.sidebar>
    <div class="shadow-xl rounded-xl">
      <div class="flex justify-between gap-3 items-center px-10 py-5 bg-primary rounded-t-xl">
        <div class="flex items-center">
          <h1 class="text-3xl font-medium text-white">Branch Admin</h1>
        </div>
        <div class="flex gap-3">
          <a href="{{ route('add-branch') }}"
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
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <path fill="none" stroke="#6b7280" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                d="M3 10a7 7 0 1 0 14 0a7 7 0 1 0-14 0m18 11l-6-6" />
            </svg>
          </div>
          <input type="text" id="branchCode" name="branchCode"
            class="block w-full p-3 ps-10 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-primary focus:border-primary"
            placeholder="Search by branch admin name" value="{{ request('branchCode') }}">
        </div>
      </div>
    </form>

    <div class="mt-5">
      <x-branch-admin.table />
    </div>
  </x-sidebar.sidebar>
</x-master>
