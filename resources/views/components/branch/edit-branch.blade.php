<div class="flex items-center">
  <a data-modal-target="editModal" data-modal-toggle="editModal" class="border-2 w-fit p-1 rounded-lg cursor-pointer">
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
      viewBox="0 0 24 24">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
    </svg>
  </a>

  <div id="editModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-xl shadow">
        <!-- Modal header -->
        <div
          class="flex items-center justify-between px-4 py-3 md:px-4 md:py-3 border-b rounded-t-xl bg-primary text-white">
          <h3 class="text-lg font-semibold">
            Edit Branch
          </h3>
          <button type="button"
            class="text-gray-300 bg-transparent hover:bg-secondary rounded-xl text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
            data-modal-toggle="editModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <form action="" class="p-4 md:p-5">
          <div class="grid gap-4 grid-cols-2">
            <div class="col-span-2">
              @csrf
              <div class="grid gap-4 mb-6 grid-cols-2">
                <div class="col-span-2">
                  <label for="branch_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch
                    Name</label>
                  <input type="text" name="branch_name" id="branch_name"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Current branch name" required="">
                </div>
                <div class="col-span-2">
                  <label for="branch_location"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch
                    Location</label>
                  <input type="text" branch_location="branch_location" id="branch_location"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                    placeholder="Current branch location" required="">
                </div>
              </div>
            </div>
          </div>
          <button type="submit"
            class="text-white flex items-center w-fit gap-1 bg-primary hover:bg-secondary font-medium rounded-lg text-sm px-5 py-2.5">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
              fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
            </svg>
            <span>Edit Branch</span>
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
