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
          <x-branchadmin.add-admin/>
        </div>
      </div>

      {{-- Table Admin --}}
      <div id="admin-table">
        <x-branchadmin.table/>
        <x-pagination />
      </div>


      {{-- Table Ingredients --}}
      <div id="ingredients-table" class="hidden">
        
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
