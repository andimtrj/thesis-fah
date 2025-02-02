@props(['deleteTitle' => 'Delete Modal', 'deleteDesc' => 'Delete Desc Modal', 'ingredient'])

<div class="flex items-center">
  <!-- Delete Button -->
  <div data-modal-target="deleteModal-{{ $ingredient->id }}" data-modal-toggle="deleteModal-{{ $ingredient->id }}"
    class="border-2 w-fit p-1 rounded-lg cursor-pointer hover:shadow-button hover:shadow-gray-400" href=""
    onclick="confirmation(event)">
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
      viewBox="0 0 24 24">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
    </svg>
  </div>

  <!-- Modal -->
  <div id="deleteModal-{{ $ingredient->id }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-xl shadow">
        <!-- Modal header -->
        <div
          class="flex items-center justify-between px-4 py-3 md:px-4 md:py-3 border-b rounded-t-xl bg-primary text-white">
          <h3 class="text-lg font-semibold">
            Confirm Delete
          </h3>
          <button type="button"
            class="text-gray-300 bg-transparent hover:bg-secondary rounded-xl text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
            data-modal-toggle="deleteModal-{{ $ingredient->id }}"> 
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="flex flex-col p-4 ">
          <h1 class="text-lg text-black mb-4 text-center"> Are you sure want to delete this ingredient? <br> This
            action cannot be undone.</h1>
          <form method="POST" action="{{ route('delete-ingredient', ['id' => $ingredient->id]) }}"
            class="flex gap-4 w-full">
            @csrf
            <a data-modal-toggle="deleteModal-{{ $ingredient->id }}" 
              class="flex items-center w-full bg-none border border-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 justify-center cursor-pointer ">
              <span>Cancel</span>
            </a>
            <button type="submit"
              class="text-white flex items-center w-full bg-danger font-medium rounded-lg text-sm px-5 py-2.5 justify-center cursor-pointer">
              <span>Delete</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
