<x-master>
  <x-sidebar.sidebar>
    <div class="flex justify-between gap-3 items-center px-10 py-5 bg-primary rounded-t-xl">
      <div class="flex items-center">
        <h1 class="text-3xl font-medium text-white">Roji Ramen</h1>
      </div>

      <div class="flex gap-3">
        <a href="{{ route('add-branch') }}" data-modal-target="addModal" data-modal-toggle="addModal"
          class="flex items-center text-white bg-accent lg:px-3 md:px-1 py-2 rounded-lg gap-1 flex-shrink-0 shadow-container w-fit md:text-xs lg:text-base">
          <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 12h14m-7 7V5" />
          </svg>
          <span>Add Branch</span>
        </a>
      </div>
    </div>

    <div class="flex items-end gap-5 px-10 bg-white mt-5">
      <div class="flex gap-5">
        <div class="w-[15vw]">
          <label for="small-input" class="block mb-1 text-sm font-medium text-gray-900">Branch code</label>
          <input type="text" id="small-input"
            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary focus:border-primary"
            placeholder="Search by branch code">
        </div>
        <div class="w-[15vw]">
          <label for="small-input" class="block mb-1 text-sm font-medium text-gray-900">Branch name</label>
          <input type="text" id="small-input"
            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary focus:border-primary"
            placeholder="Search by branch name">
        </div>
      </div>
      <div class="flex gap-2">
        <button class="bg-secondary bg-opacity-10 rounded-lg px-7 py-2 text-secondary flex items-center gap-1">
          <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
            fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
              d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
          </svg>
          <span>Search</span>
        </button>
        <button class="bg-danger bg-opacity-10 rounded-lg px-5 py-2 text-danger flex items-center gap-1">
          <span>Clear Search</span>
        </button>
      </div>
    </div>

    <div class="px-10 mt-5">
      <x-branch.table />
    </div>
    {{-- Pagination --}}
    <x-pagination />
  </x-sidebar.sidebar>


  <script>
    // JavaScript to handle dropdown selection
    document.addEventListener('DOMContentLoaded', function() {
      const dropdownButton = document.getElementById('dropdown-button');
      const dropdownLabel = document.getElementById('dropdown-label');
      const dropdownItems = document.querySelectorAll('.dropdown-item');

      dropdownItems.forEach(item => {
        item.addEventListener('click', function() {
          const selectedText = this.getAttribute('data-value');
          dropdownLabel.textContent = selectedText;

          // Close dropdown after selection (if required)
          document.getElementById('dropdown').classList.add('hidden');
        });
      });

      // Optional: Toggle dropdown visibility
      dropdownButton.addEventListener('click', function() {
        document.getElementById('dropdown').classList.toggle('hidden');
      });
    });
  </script>
</x-master>
