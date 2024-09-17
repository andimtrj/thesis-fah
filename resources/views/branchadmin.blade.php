<x-master>
  <x-sidebar.sidebar>
    <div class="flex mb-5 justify-between gap-3 items-center">
      <div class="flex items-center">
        <h1 class="text-3xl font-medium">Roji Ramen Alam Sutera</h1>
      </div>
    </div>

    <div>
      <div class="flex gap-5 mb-2 border-opacity-15 justify-between">
        <div class="flex gap-5 items-center">
          <a href="" id="admin-tab" class="text-lg border-b-2 border-accent" aria-selected="true">Admin</a>
          <a href="" id="ingredients-tab" class="text-lg">Ingredients</a>
        </div>
        <div class="flex gap-3">
          <x-search-input />
          <x-modal.add-modal for="name" name="name" id="nameInput" placeholder="Input Name">
            @slot('textButton')
              Add Admin
            @endslot
            @slot('modalTitle')
              Add new branch admin
            @endslot
            @slot('labelName')
              Name
            @endslot
          </x-modal.add-modal>
        </div>
      </div>

      {{-- Table Admin --}}
      <div id="admin-table">
        <x-table.table>
          @slot('head')
            <th scope="col" class="px-4 py-4 w-12 text-center">
              ID
            </th>
            <th scope="col" class="px-4 py-4 w-[30vw]">
              Admin Name
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Email
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Phone Number
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Action
            </th>
            <th scope="col" class="px-4 py-4"></th>
          @endslot

          {{-- Table Body --}}
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-base">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Andi Mataraja
            </td>
            <td class="px-4 py-3 text-center">
              andi.mataraja@binus.ac.id
            </td>
            <td class="px-4 py-3 text-center">
              081287708023
            </td>
            <x-table.action addUrl="{{ route('branch') }}" editUrl=" {{ route('branch') }}"
              deleteUrl="{{ route('branch') }}" detailUrl="{{ route('branchadmin') }}"
              hideActions="{{ true }}" />
          </tr>
        </x-table.table>
        <x-pagination />
      </div>


      {{-- Table Ingredients --}}
      <div id="ingredients-table" class="hidden">
        <x-table.table>
          @slot('head')
            <th scope="col" class="px-4 py-4 w-12 text-center">
              ID
            </th>
            <th scope="col" class="px-4 py-4 w-[30vw]">
              Name
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Quantity
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Last Added
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Action
            </th>
            <th scope="col" class="px-4 py-4"></th>
          @endslot

          {{-- Table Body --}}
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-base">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Ayam
            </td>
            <td class="px-4 py-3 text-center">
              20
            </td>
            <td class="px-4 py-3 text-center">
              6-Sep-2024
            </td>
            <x-table.action addUrl="{{ route('branch') }}" editUrl=" {{ route('branch') }}"
              deleteUrl="{{ route('branch') }}" detailUrl="{{ route('branchadmin') }}"
              hideActions="{{ true }}" />
          </tr>
        </x-table.table>
        <x-pagination />
      </div>


    </div>
  </x-sidebar.sidebar>
  <script>
    // Get the elements
    const adminTab = document.getElementById('admin-tab');
    const ingredientsTab = document.getElementById('ingredients-tab');
    const adminTable = document.getElementById('admin-table');
    const ingredientsTable = document.getElementById('ingredients-table');

    // Add click event listeners
    adminTab.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default link behavior

      // Show Admin table and hide Ingredients table
      adminTable.classList.remove('hidden');
      adminTable.classList.add('block');
      ingredientsTable.classList.add('hidden');

      // Update tab styles
      adminTab.classList.add('border-b-2', 'border-accent'); // Add border to Admin tab
      ingredientsTab.classList.remove('border-b-2', 'border-accent'); // Remove border from Ingredients tab
    });

    ingredientsTab.addEventListener('click', function(event) {
      event.preventDefault(); // Prevent default link behavior

      // Show Ingredients table and hide Admin table
      ingredientsTable.classList.remove('hidden');
      ingredientsTable.classList.add('block');
      adminTable.classList.add('hidden');

      // Update tab styles
      ingredientsTab.classList.add('border-b-2', 'border-accent'); // Add border to Ingredients tab
      adminTab.classList.remove('border-b-2', 'border-accent'); // Remove border from Admin tab
    });

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
