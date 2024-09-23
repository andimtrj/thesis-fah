<x-master>
  <x-sidebar.sidebar>
    {{-- Above Table --}}
    <div class="flex mb-5 justify-between gap-3 items-center">
      <div class="flex items-center">
        <h1 class="text-3xl font-medium">Roji Ramen</h1>
      </div>

      <div class="flex gap-3">
        <x-search-input />
        {{-- <x-branch.add-branch /> --}}
        <a href="{{ route('add-branch') }}" data-modal-target="addModal" data-modal-toggle="addModal"
          class="flex items-center text-white bg-accent lg:px-3 md:px-1 py-2 rounded-lg gap-1 flex-shrink-0 shadow-md w-fit md:text-xs lg:text-base">
          <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M5 12h14m-7 7V5" />
          </svg>
          <span>Add Branch</span>
        </a>
      </div>
    </div>

    <x-branch.table />

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
