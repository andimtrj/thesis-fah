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
        <form action="{{ route('insert-ingredient') }}" method="POST">
          @csrf
          <div class="mb-5">
            <label for="ingredientName" class="block mb-1 text-sm font-medium text-gray-900">Ingredient Name</label>
            <input type="text" name="ingredientName" id="ingredientName"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type ingredient name" required="">
          </div>
            @if(session('branch_code'))
                <input type="hidden" name="branchCode" id="branchCode" value="{{ session('branch_code') }}">
            @else
            <div class="mb-5">
              <label for="branches" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
              <select id="branches" name="branchCode"
                class="bg-gray-50 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-primary block w-full p-2.5">
                <option value="" disabled selected>Select Branch</option>
                @foreach ($branches as $branch)
                  <option value="{{ $branch->branch_code }}">{{ $branch->branch_name }}</option>
                @endforeach
              </select>
            </div>
            @endif
          <div class="grid md:grid-cols-3 md:gap-6 mb-5">
            <div>
              <label for="metricGroups" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metric
                Groups</label>
              <select id="metricGroups" name="metricGroups"
                class="bg-gray-50 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-primary block w-full p-2.5">
                <option value="" disabled selected>Select metric group</option>
                @foreach ($metricGroups as $metricGroup)
                  <option value="{{ $metricGroup->id }}">{{ $metricGroup->metric_grp_name }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label for="metricCode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Metrics</label>
              <select id="metrics" name="metricCode"
                class="bg-gray-50 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-primary block w-full p-2.5">
                <option value="" selected>Select metric</option>
              </select>
            </div>
            <input type="hidden" name="tenantCode" id="tenantCode" value="{{ session('tenant_code') }}">
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

    // Pass the $metrics collection as a JSON array to JavaScript
    const allMetrics = @json($metrics ?? []); // Provide a default empty array if $metrics is not available

    metricGroups.addEventListener('change', function () {
        const selectedGroupId = this.value;
        metrics.innerHTML = ''; // Clear previous options

        // Filter the metrics that belong to the selected metric group
        const filteredMetrics = allMetrics.filter(metric => metric.metric_group_id == selectedGroupId);

        // Log filtered metrics to the console
        console.log("AllMetrics : ", allMetrics);
        console.log("FilteredMetrics : ", filteredMetrics);

        // Populate the metrics dropdown based on the filtered results
        if (filteredMetrics.length > 0) {
            filteredMetrics.forEach(function (metric) {
                const option = document.createElement('option');
                option.value = metric.metric_code;
                option.textContent = metric.metric_unit;
                metrics.appendChild(option);
            });
        } else {
            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'No metrics available';
            metrics.appendChild(option);
        }
    });
</script>


</x-master>
