<x-master>
  <x-sidebar.sidebar>
    <div class="shadow-xl rounded-xl">
      <div class="px-10 py-5 bg-primary text-white rounded-t-xl">
        <h1 class="text-3xl font-medium">Add Purchase</h1>
      </div>
      <div class="px-10 py-7 rounded-xl bg-white">
        <h2 class="text-xl font-medium mb-5 border-b-abu border-b-2">Purchase Details</h2>
        <form action="{{ route('insert-purchase') }}" method="POST">
          @csrf
          <div class="grid md:grid-cols-2 md:gap-6 mb-5 items-center">
            <input type="hidden" name="tenantCode" id="tenantCode" value="{{ session('tenant_code') }}">
            @if(Auth::user()->role->role_code === "BA")
                <input id="branches" type="hidden" name="branchCode" id="branchCode" value="{{ Auth::user()->branch->branch_code }}">
                <p class="text-red-500 text-sm" id="required-text" hidden>Branch Is Required</p>
            @else
            <div>
              <select id="branches" name="branchCode"
                class="bg-gray-50 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-primary block w-full p-2.5"
                required>
                <option value="" disabled selected>Select Branch</option>
                @foreach ($branches as $branch)
                  <option value="{{ $branch->branch_code }}">{{ $branch->branch_name }}</option>
                @endforeach
              </select>
              <p class="text-red-500 text-sm" id="required-text" hidden>Branch Is Required</p>
            </div>
            @endif

            <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
              </div>
              <input datepicker id="default-datepicker" type="text" name="trxDate"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date" required value="{{ date('d-m-Y') }}">
            </div>
          </div>


          {{-- Table --}}
          <div class="relative overflow-x-auto bg-white rounded-t-xl mb-5">
            <table class="table-fixed w-full">
              {{-- Table Head --}}
              <thead class="bg-cream">
                <tr>
                  <th scope="col" class="px-4 py-4 text-center">Ingredient Name</th>
                  <th scope="col" class="px-4 py-4 text-center">Ingredient Amount</th>
                  <th scope="col" class="px-4 py-4 text-center">Notes</th>
                  <th scope="col" class="px-4 py-4 text-center">Metrics</th>
                  <th scope="col" class="px-4 py-4 text-center">Actions</th>
                </tr>
              </thead>

              {{-- Table Body --}}
              <tbody id="table-body-addrow">
                {{-- <tr class="bg-white border-y text-base text-abu">
                    <td class="px-2 py-3">
          <select name="products[${rowCount}][product_name]"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary focus:border-primary block w-full p-2"
            required>
            <option selected>Select a product</option>
          </select>
        </td>
        <td class="px-2 w-full">
          <div class="flex items-center justify-center">
            <button onclick="decreaseValue(event)"
              class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
              type="button">
              <span class="sr-only">Quantity button</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
              </svg>
            </button>
            <input type="number" name="products[${rowCount}][amount]"
              class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block px-2.5 py-1"
              value="0" required />
            <button onclick="increaseValue(event)"
              class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
              type="button">
              <span class="sr-only">Quantity button</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
              </svg>
            </button>
          </div>
        </td>
        <td class="px-2">
          <input type="text" name="products[${rowCount}][notes]"
            class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary"
            placeholder="Type ingredient name">
        </td>
        <td class="px-2 py-3">
            <select id="countries" name="products[${rowCount}][metric]"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary focus:border-primaring-primary block w-full p-2">
                <option selected>Select a metric</option>
            </select>
        </td>
        <td class="px-2 text-center">
          <button type="button" class="text-sm delete-row bg-danger bg-opacity-10 text-danger hover:underline underline-offset-2 px-4 py-2 rounded-lg">Remove</button>
        </td>
                  </tr> --}}
              </tbody>
            </table>
            <div class="flex justify-end mt-2">
              <button type="button" id="add-row"
                class="text-green-500 bg-green-500 bg-opacity-10 hover:underline underline-offset-2 px-4 py-2 rounded-lg">
                Add Row</button>
            </div>
          </div>

          <div class="flex justify-end gap-5">
            <a href="{{ route('purchase') }}"
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
    let rowCount = 0; // Initialize row count to 0
    let branchCodeInput = document.getElementById('branches');
    let branchRequiredText = document.getElementById('required-text');
    const allIngredients = @json($ingredients ?? []);

    document.getElementById("add-row").addEventListener("click", function() {
    console.log("BranchCodeInput : ", branchCodeInput);
        if (!branchCodeInput.value) {
            branchRequiredText.hidden = false; // Show the required text if branchCode is empty
        }else{
            branchRequiredText.hidden = true; // Hide the required text if branchCode has a value
            const selectedBranchCode = branchCodeInput.value;
            const filteredIngredients = allIngredients.filter(ingredient => ingredient.branch.branch_code == selectedBranchCode);

            // Get the table body element
            const tableBody = document.getElementById("table-body-addrow");

            // Create a new table row
            const newRow = document.createElement("tr");
            newRow.classList.add("bg-white", "border-y", "text-base", "text-abu");

            // Set the inner HTML of the new row with dynamic rowCount
            newRow.innerHTML = `
                <td class="px-2 py-3">
                <select name="ingredients[${rowCount}][ingredientCode]"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary focus:border-primary block w-full p-2"
                    required>
                    <option selected>Select an ingredient</option>
                    ${filteredIngredients.map(ingredient =>
                        `<option value="${ingredient.ingredient_code}">${ingredient.ingredient_name}</option>`
                    ).join('')}
                </select>
                </td>
                <td class="px-2 w-full">
                <div class="flex items-center justify-center">
                    <button onclick="decreaseValue(event)"
                    class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                    type="button">
                    <span class="sr-only">Quantity button</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                    </svg>
                    </button>
                    <input type="number" name="ingredients[${rowCount}][ingredientAmt]"
                    class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block px-2.5 py-1"
                    value="0" required />
                    <button onclick="increaseValue(event)"
                    class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200"
                    type="button">
                    <span class="sr-only">Quantity button</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                    </svg>
                    </button>
                </div>
                </td>
                <td class="px-2">
                <input type="text" name="ingredients[${rowCount}][notes]"
                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary"
                    placeholder="Type ingredient name">
                </td>
                <td class="px-2 py-3">
                    <select id="countries" name="ingredients[${rowCount}][metricCode]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-xs rounded-lg focus:ring-primary focus:border-primaring-primary block w-full p-2">
                        <option selected>Select a metric</option>
                    </select>
                </td>
                <td class="px-2 text-center">
                <button type="button" class="text-sm delete-row bg-danger bg-opacity-10 text-danger hover:underline underline-offset-2 px-4 py-2 rounded-lg">Remove</button>
                </td>
            `;

            // Append the new row to the table body
            tableBody.appendChild(newRow);

            // Add event listener to the new delete button
            newRow.querySelector(".delete-row").addEventListener("click", function() {
                newRow.remove();
            });

            // Increment row count for the next row
            rowCount++;
        }
    });

    function increaseValue(event) {
      // Get the input element for the amount
      const inputElement = event.target.closest('div').querySelector('input[type="number"]');
      let currentValue = parseInt(inputElement.value);

      // Increase the value by 1
      inputElement.value = currentValue + 1;
    }

    function decreaseValue(event) {
      // Get the input element for the amount
      const inputElement = event.target.closest('div').querySelector('input[type="number"]');
      let currentValue = parseInt(inputElement.value);

      // Decrease the value by 1 but not less than 0
      inputElement.value = currentValue > 0 ? currentValue - 1 : 0;
    }

    document.getElementById('branches').addEventListener('change', function(event){
        let tableBody = document.getElementById('table-body-addrow');
        tableBody.innerHTML = '';
        const selectedBranchCode = this.value;
    })

    document.getElementById('table-body-addrow').addEventListener('change', function(event) {
        if (event.target && event.target.matches('select[name^="ingredients"][name$="[ingredientCode]"]')) {
            let row = event.target.closest('tr'); // Get the row where the select changed
            let ingredientCode = event.target.value; // Get selected ingredient code
            console.log('Ingredient Code', ingredientCode);
            if (ingredientCode) {
                fetchMetricsForIngredient(ingredientCode, row);
            }
        }
    });


    function fetchMetricsForIngredient(ingredientCode, row) {

        const allMetrics = @json($metrics ?? []);
        const ingredient = allIngredients.find(ingredient => ingredient.ingredient_code == ingredientCode);
        console.log('Ingredient', ingredient);
        const filteredMetrics = allMetrics.filter(metric => metric.metric_group_id == ingredient.metric.metric_group_id);

        let metricsSelect = row.querySelector('select[name^="ingredients"][name$="[metricCode]"]');
        metricsSelect.innerHTML = ''; // Clear previous options

        filteredMetrics.forEach(function (metric){
            let option = document.createElement('option');
            option.value = metric.metric_code;
            option.textContent = metric.metric_unit;
            metricsSelect.appendChild(option);

            if(metric.id == ingredient.metric_id){
                option.selected = true;
            }
        })
    }



  </script>
</x-master>
