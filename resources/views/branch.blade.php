<x-master>
  <x-sidebar.sidebar>
    {{-- Above Table --}}
    <div class="flex mb-5 justify-between gap-3 items-center">
      <div class="flex items-center">
        <h1 class="text-3xl font-medium">Roji Ramen</h1>
      </div>

      <div class="flex gap-3">
        <x-search-input />
        <x-modal.add-modal for="name" name="name" id="nameInput" placeholder="Input Name">
          @slot('textButton')
            Add Branch
          @endslot
          @slot('modalTitle')
            Add new branch
          @endslot
          @slot('labelName')
            Branch Name
          @endslot
        </x-modal.add-modal>
      </div>
    </div>

    <x-table.table>
      @slot('head')
        <th scope="col" class="px-4 py-4 w-12 text-center">
          ID
        </th>
        <th scope="col" class="px-4 py-4 lg:w-[45vw] md:w-[18vw]">
          Location
        </th>
        <th scope="col" class="px-4 py-4 text-center">
          Total Branch Admin
        </th>
        <th scope="col" class="px-4 py-4 text-center">
          Action
        </th>
        <th scope="col"></th>
      @endslot

      {{-- Table Body --}}
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-base">
        <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
          1
        </th>
        <td class="px-4 py-3">
          Roji Ramen Alam Sutera
        </td>
        <td class="px-4 py-3 text-center">
          5
        </td>
        <x-table.action addUrl="{{ route('branchadmin') }}" detailUrl="{{ route('branchadmin') }}"
          deleteTitle="Delete Branch" deleteDesc="branch" editTitle="Edit Branch" :inputs="[
              [
                  'name' => 'branch_name',
                  'label' => 'Branch Name',
                  'type' => 'text',
                  'placeholder' => 'Current Branch Name',
              ],
              [
                  'name' => 'branch_location',
                  'label' => 'Branch Location',
                  'type' => 'text',
                  'placeholder' => 'Current Branch Location',
              ],
          ]" />
      </tr>
    </x-table.table>

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