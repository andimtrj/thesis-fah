@props(['textButton', 'modalTitle', 'for', 'name', 'id', 'placeholder'])

<div class="flex items-center">
  {{-- Button Add Branch --}}
  <button data-modal-target="addModal" data-modal-toggle="addModal"
    class="flex items-center text-white bg-accent px-3 py-2 rounded-lg gap-1 flex-shrink-0 shadow-md">
    <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
      fill="none" viewBox="0 0 24 24">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
    </svg>
    <span>{{ $textButton }}</span>
  </button>

  <!-- Main modal -->
  <div id="addModal" tabindex="-1" aria-hidden="true"
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
            data-modal-toggle="addModal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <form class="p-4 md:p-5">
          @csrf
          <div class="grid gap-4 mb-6 grid-cols-2">
            <div class="col-span-2">
              <label for="{{ $for }}"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">{{ $labelName }}</label>
              <input type="text" name="{{ $name }}" id="{{ $id }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                placeholder="{{ $placeholder }}" required="">
            </div>
            <div class="col-span-2">
              <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch
                Location</label>
              <input type="text" name="name" id="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                placeholder="Type branch location" required="">
            </div>
          </div>
          <button type="submit"
            class="text-white inline-flex items-center bg-primary hover:bg-secondary focus:ring-4 focus:outline-none focus:ring-abu font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
              <path fill-rule="evenodd"
                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                clip-rule="evenodd"></path>
            </svg>
            Add new branch
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
