<x-master>
  <x-sidebar.sidebar>
    @if (session('error'))
      {{ dd(session('error')) }}
    @endif
    <div class="shadow-xl rounded-xl">
      <div class="px-10 py-5 bg-primary text-white rounded-t-xl">
        <h1 class="text-3xl font-medium">Add Ingredient</h1>
      </div>
      <div class="px-10 py-7 rounded-xl bg-white">
        <h2 class="text-xl font-medium mb-5 border-b-abu border-b-2">Ingredient Details</h2>
        <form action="" method="">
          @csrf
          <div class="mb-5">
            <label for="branchName" class="block mb-1 text-sm font-medium text-gray-900">Ingredient Name</label>
            <input type="text" name="branchName" id="branchName"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type ingredient name" required="">
          </div>
          <div class="grid md:grid-cols-3 md:gap-6 mb-5">
            <div>
              <label for="metricGroups" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metric
                Groups</label>
              <select id="metricGroups"
                class="bg-gray-50 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-primary block w-full p-2.5">
                <option value="" selected>Select metric group</option>
                <option value="weight">Weight</option>
                <option value="volume">Volume</option>
                <option value="pieces">Pieces</option>
              </select>
            </div>
            <div>
              <label for="metrics" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metrics</label>
              <select id="metrics"
                class="bg-gray-50 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-primary block w-full p-2.5">
                <option selected>Select matric</option>
              </select>
            </div>
            <div>
              <label for="number-input"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
              <input type="number" id="number-input" aria-describedby="helper-text-explanation"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
                placeholder="Type a number" required />
            </div>
          </div>
          <div class="flex justify-end gap-5">
            <a href="{{ route('ingredient') }}"
              class="flex items-center text-white bg-danger hover:shadow-container lg:px-10 md:px-1 py-2 font-medium rounded-lg gap-1 flex-shrink-0 w-fit md:text-xs lg:text-base">
              <span>Cancel</span>
            </a>
            <button type="submit"
              class="flex items-center text-white bg-secondary hover:shadow-container lg:px-10 md:px-1 py-2 font-medium rounded-lg gap-1 flex-shrink-0 w-fit md:text-xs lg:text-base">
              <span>Submit</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </x-sidebar.sidebar>
  <script>
    const metricGroups = document.getElementById('metricGroups');
    const metrics = document.getElementById('metrics');

    const options = {
      weight: ['kg', 'grams', 'tons'],
      volume: ['liters', 'ml', 'gallons'],
      pieces: ['Pcs']
    };

    metricGroups.addEventListener('change', function() {
      const selectedGroup = this.value;
      metrics.innerHTML = ''; // Clear previous options

      if (selectedGroup && options[selectedGroup]) {
        options[selectedGroup].forEach(function(metric) {
          const option = document.createElement('option');
          option.value = metric;
          option.textContent = metric;
          metrics.appendChild(option);
        });
      }
    });

    // If "pieces" is selected, automatically select Pcs
    metricGroups.addEventListener('change', function() {
      if (this.value === 'pieces') {
        metrics.value = 'Pcs';
        metrics.setAttribute('disabled', true);
      } else {
        metrics.removeAttribute('disabled');
      }
    });
  </script>
</x-master>
