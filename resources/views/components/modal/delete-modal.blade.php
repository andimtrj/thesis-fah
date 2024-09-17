{{-- @props(['modalTitle', 'for', 'name', 'id', 'placeholder']) --}}

<div class="flex items-center">
  <a data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="border-2 w-fit p-1 rounded-lg cursor-pointer">
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
      viewBox="0 0 24 24">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
    </svg>
  </a>

  <div id="deleteModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-xl shadow">
        <!-- Modal header -->
        <div
          class="flex items-center justify-between px-4 py-3 md:px-4 md:py-3 border-b rounded-t-xl bg-primary text-white">
          <h3 class="text-lg font-semibold">
            {{ $modalTitle }}
          </h3>
          <button type="button"
            class="text-gray-300 bg-transparent hover:bg-secondary rounded-xl text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
            data-modal-toggle="deleteModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="flex flex-col items-center justify-center p-4 ">
          <h1 class="text-lg font-medium text-black mb-3"> Are you sure want to delete this branch?</h1>
          <div class="flex gap-4">
            <button type="submit"
              class="text-white flex items-center w-fit gap-1 bg-danger font-medium rounded-lg text-sm px-5 py-2.5">
              <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
              </svg>
              <span>Yes</span>
            </button>
            <button type="submit"
              class="text-white flex items-center w-fit gap-1 bg-primary hover:bg-secondary font-medium rounded-lg text-sm px-5 py-2.5">
              <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
              </svg>
              <span>No</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
