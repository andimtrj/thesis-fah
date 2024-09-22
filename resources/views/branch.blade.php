<x-master>
  <x-sidebar.sidebar>
    {{-- Above Table --}}
    <div class="flex mb-5 justify-between gap-3 items-center">
      <div class="flex items-center">
        <h1 class="text-3xl font-medium">Roji Ramen</h1>
      </div>

      <div class="flex gap-3">
        <x-search-input/>
        <x-add-modal/>
      </div>
    </div>

    <x-table.table>
      @slot('head')
        <th scope="col" class="px-4 py-4 w-12 text-center">
          BRANCH CODE
        </th>
        <th scope="col" class="px-4 py-4 w-[45vw]">
          BRANCH NAME
        </th>
        <th scope="col" class="px-4 py-4 text-center">
          TOTAL BRANCH ADMIN
        </th>
        <th scope="col" class="px-4 py-4 text-center">
          Action
        </th>
        <th scope="col" class="px-4 py-4"></th>
      @endslot

      {{-- Table Body --}}
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-base">
        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
          1
        </th>
        <td class="px-4 py-3">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. In at non tempora.
        </td>
        <td class="px-4 py-3 text-center">
          5
        </td>
        <x-table.action addUrl="{{ route('branch') }}" editUrl=" {{ route('branch') }}"
          deleteUrl="{{ route('branch') }}" detailUrl="{{ route('branch') }}" />
      </tr>
    </x-table.table>

    {{-- Pagination --}}
    <div class="bg-white px-5 py-2 flex items-center justify-between rounded-b-xl shadow-md">
      <div class="text-xs">
        <span>Showing 1 to 10 of 100 Entries</span>
      </div>

      <div class="text-xs">
        <div class="flex items-center">
          <a href="" class="flex items-center mr-2">
            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m15 19-7-7 7-7" />
            </svg>
            <span>Previous</span>
          </a>

          <div class="flex gap-1 text-cream">
            <a href=""
              class="border-2 border-primary bg-primary p-1 rounded-md w-8 h-8 flex justify-center items-center"> 1
            </a>
            <a href=""
              class="border-2 border-primary text-abu p-1 rounded-md w-8 h-8 flex justify-center items-center"> 2
            </a>
            <a href=""
              class="border-2 border-primary text-abu p-1 rounded-md w-8 h-8 flex justify-center items-center"> 3
            </a>
            <a href=""
              class="border-2 border-primary text-abu p-1 rounded-md w-8 h-8 flex justify-center items-center"> ..
            </a>
            <a href=""
              class="border-2 border-primary text-abu p-1 rounded-md w-8 h-8 flex justify-center items-center"> 32
            </a>
          </div>

          <a href="" class="flex items-center ml-2"><span>Next</span>
            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              width="24" height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m9 5 7 7-7 7" />
            </svg>
          </a>
        </div>
      </div>
    </div>
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
