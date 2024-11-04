<x-master>
  <x-sidebar.sidebar>
    <div class="shadow-xl rounded-xl">
      <div class="px-10 py-5 bg-primary text-white rounded-t-xl">
        <h1 class="text-3xl font-medium">Add Product</h1>
      </div>
      <div class="px-10 py-7 rounded-xl bg-white">
        <h2 class="text-xl font-medium mb-5 border-b-abu border-b-2">Product Details</h2>
        <form action="{{ route('insert-product') }}" method="POST">
          @csrf
          <div class="mb-5">
            <label for="productName" class="flex mb-1 text-sm font-medium text-gray-900 justify-between items-center">
              <span>Product
                Name</span>
              <label class="inline-flex items-center cursor-pointer">
                <span class="text-sm font-medium text-gray-900 mr-2">Is Active</span>
                <!-- Hidden input with value "false" -->
                <input type="hidden" name="isActive" value="0">
                <!-- Checkbox, submitting "true" when checked -->
                <input type="checkbox" value="1" class="sr-only peer" id="isActive" name="isActive">
                @if ($errors->has('isActive'))
                    <p class="text-red-500 text-sm">{{ $errors->first('isActive') }}</p>
                @endif

                <div
                class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                </div>
              </label>
            </label>
            <input type="text" name="productName" id="productName"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type Product name" required="">
            @if ($errors->has('productName'))
                <p class="text-red-500 text-sm">{{ $errors->first('productName') }}</p>
            @endif

          </div>
          <input type="hidden" name="tenantCode" id="tenantCode" value="{{ session('tenant_code') }}">
            @if(session('branch_code'))
                <input type="hidden" name="branchCode" id="branches" value="{{ session('branch_code') }}">
            @else
            <div class="mb-5">
                <label for="branches" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Branch</label>
                <select id="branches" name="branchCode"
                class="bg-gray-50 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-primary block w-full p-2.5"
                required>
                <option value="" disabled selected>Select Branch</option>
                @foreach ($branches as $branch)
                    <option value="{{ $branch->branch_code }}">{{ $branch->branch_name }}</option>
                @endforeach
                </select>
                @if ($errors->has('branchCode'))
                    <p class="text-red-500 text-sm">{{ $errors->first('branchCode') }}</p>
                @endif
                <p class="text-red-500 text-sm" id="required-text" hidden>Branch Is Required</p>
            </div>
            @endif
          <div class="grid md:grid-cols-2 md:gap-6 mb-5 items-center">
            <div>
              <label for="productCategoryCode" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                Category</label>
              <select id="productCategoryCode" name="productCategoryCode"
                class="bg-gray-50 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-primary block w-full p-2.5">
                <option value="" disabled selected>Select product category</option>
            </select>
            @if ($errors->has('branchCode'))
                <p class="text-red-500 text-sm">{{ $errors->first('branchCode') }}</p>
            @endif

            </div>
            <div>
              <label for="productPrice" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                Price</label>
              <input type="number" id="productPrice" name="productPrice" aria-describedby="helper-text-explanation"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
                placeholder="Type a number" step="1000" required />
                @if ($errors->has('branchCode'))
                    <p class="text-red-500 text-sm">{{ $errors->first('branchCode') }}</p>
                @endif
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
                  <th scope="col" class="px-4 py-4 text-center">Metrics</th>
                  <th scope="col" class="px-4 py-4 text-center">Actions</th>
                </tr>
              </thead>

              {{-- Table Body --}}
              <tbody id="ingredient-table-body">
                {{-- <tr class="bg-white border-y text-base text-abu">
                  <td class="px-2 py-3">
                    <input type="text" id="small-input" name="ingredients[0][name]"
                      class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary"
                      placeholder="Type ingredient name">
                  </td>
                  <td class="px-2 w-full">
                    <div class="flex items-center justify-center">
                      <button onclick="decreaseValue()"
                        class="inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button">
                        <span class="sr-only">Quantity button</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 18 2">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h16" />
                        </svg>
                      </button>
                      <div>
                        <input type="number" id="first_product" name="ingredients[0][amount]"
                          class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          value="0" required />
                      </div>
                      <button onclick="increaseValue()"
                        class="inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                        type="button">
                        <span class="sr-only">Quantity button</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 18 18">
                          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 1v16M1 9h16" />
                        </svg>
                      </button>
                    </div>
                  </td>
                  <td class="px-2">
                    <input type="text" id="small-input" name="ingredients[0][metrics]"
                      class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary"
                      placeholder="Type ingredient name">
                  </td>
                  <td class="px-2 text-center">
                    <button type="button"
                      class="delete-row text-danger hover:underline underline-offset-2 px-2 py-1 rounded">Remove</button>
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
            <a href="{{ route('product') }}"
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
    let branchDropdown = document.getElementById('branches');
    let addRowButton = document.getElementById('add-row');
    let branchRequiredText = document.getElementById('required-text');

    let branchCodeInput = document.getElementById('branches');

    const productCategory = document.getElementById('productCategoryCode');
    const allIngredients = @json($ingredients ?? []);
    console.log('Ingredients', allIngredients);

    document.getElementById('add-row').addEventListener('click', function() {
        console.log("BranchCodeInput : ", branchCodeInput);
        if (!branchCodeInput.value) {
            branchRequiredText.hidden = false; // Show the required text if branchCode is empty
        }else{
            branchRequiredText.hidden = true; // Hide the required text if branchCode has a value
            let tableBody = document.getElementById('ingredient-table-body');
            let rowCount = tableBody.rows.length;
            const selectedBranchCode = branchCodeInput.value;
            const filteredIngredients = allIngredients.filter(ingredient => ingredient.branch.branch_code == selectedBranchCode);
            console.log('filtered Ingredients', filteredIngredients);
            let newRow = document.createElement('tr');
            newRow.classList.add('bg-white', 'border-y', 'text-base', 'text-abu');

            newRow.innerHTML = `
                <td class="px-2 py-3">
                <select id="ingredients" name="ingredients[${rowCount}][ingredient_code]"
                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary">
                    <option value="" disabled selected>Select Ingredient</option>
                    ${filteredIngredients.map(ingredient =>
                        `<option value="${ingredient.ingredient_code}">${ingredient.ingredient_name}</option>`
                    ).join('')}
                </select>
                </td>
                <td class="px-2 w-full">
                <div class="flex items-center justify-center">
                    <button type="button" class="decrease-value inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200">
                    <span class="sr-only">Quantity button</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                    </svg>
                    </button>
                    <div>
                    <input type="number" name="ingredients[${rowCount}][amount]"
                        class="ingredient-amount bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1"
                        value="0" step="0.01" required />
                    </div>
                    <button type="button" class="increase-value inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200">
                    <span class="sr-only">Quantity button</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                    </svg>
                    </button>
                </div>
                </td>
                <td class="px-2">
                <select id="metrics" name="ingredients[${rowCount}][metric_code]"
                    class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary">
                    <option value="" disabled selected>Select ingredient metrics</option>
                </select>
                </td>
                <td class="px-2 text-center">
                <button type="button" class="text-sm delete-row bg-danger bg-opacity-10 text-danger hover:underline underline-offset-2 px-4 py-2 rounded-lg">Remove</button>
                </td>
                `;

            tableBody.appendChild(newRow);
            bindRowButtons(newRow);

        }
    });

    function bindRowButtons(row) {
      // Bind the increase and decrease buttons for each row
      row.querySelector('.increase-value').addEventListener('click', function() {
        const input = row.querySelector('.ingredient-amount');
        input.value = parseInt(input.value) + 1;
      });

      row.querySelector('.decrease-value').addEventListener('click', function() {
        const input = row.querySelector('.ingredient-amount');
        if (input.value > 0) {
          input.value = parseInt(input.value) - 1;
        }
      });

      // Bind the delete button for each row
      row.querySelector('.delete-row').addEventListener('click', function() {
        row.remove();
      });
    }

    // Bind buttons for the initial row if any
    document.querySelectorAll('#ingredient-table-body tr').forEach(bindRowButtons);

    const allProductCategories = @json($productCategories ?? []); // Provide a default empty array if $metrics is not available

    document.getElementById('branches').addEventListener('change', function(event){
        let tableBody = document.getElementById('ingredient-table-body');
        tableBody.innerHTML = '';
        productCategory.innerHTML = ''; // Clear previous options
        const selectedBranchCode = this.value
        localStorage.setItem('selectedBranchCode', selectedBranchCode);

        console.log(allProductCategories);
        const branches = @json($branches ?? []);
        const selectedBranch = branches.filter(branch => branch.branch_code == selectedBranchCode);
        console.log('selected branch', selectedBranch);
        const filteredProductCategories = allProductCategories.filter(productCategory => productCategory.branch_id == selectedBranch[0].id);
        console.log('Filtered Product Categories', filteredProductCategories);
        if(filteredProductCategories.length > 0){
            filteredProductCategories.forEach(function (product_category) {
                const option = document.createElement('option');
                option.value = product_category.prod_category_code;
                option.textContent = product_category.prod_category_name;
                productCategory.appendChild(option);
                console.log('Product Category Change : ', productCategory);
                localStorage.setItem('selectedProductCategoryValue', option.value);
            });

        } else {
            const option = document.createElement('option');
            option.value = '';
            option.textContent = 'No Product Category available';
            productCategory.appendChild(option);
        }
    })


    document.getElementById('ingredient-table-body').addEventListener('change', function(event) {
        if (event.target && event.target.matches('select[name^="ingredients"][name$="[ingredient_code]"]')) {
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

        let metricsSelect = row.querySelector('select[name^="ingredients"][name$="[metric_code]"]');
        metricsSelect.innerHTML = ''; // Clear previous options

        filteredMetrics.forEach(function (metric){
            let option = document.createElement('option');
            option.value = metric.metric_code;
            option.textContent = metric.metric_unit;
            metricsSelect.appendChild(option);

        })

        console.log(ingredientCode);
        // Make an AJAX call to get metrics for the selected ingredient
    //     fetch(`/get-metrics/${ingredientCode}`) // You can create this route in Laravel
    //         .then(response => response.json())
    //         .then(data => {
    //             let metricsSelect = row.querySelector('select[name^="ingredients"][name$="[metric_code]"]');
    //             metricsSelect.innerHTML = ''; // Clear previous options

    //             console.log('data : ', data);
    //             if (data.metrics.length > 0) {
    //                 data.metrics.forEach(metric => {
    //                     let option = document.createElement('option');
    //                     option.value = metric.metric_code;
    //                     option.textContent = metric.metric_unit;
    //                     metricsSelect.appendChild(option);
    //                 });
    //             } else {
    //                 let option = document.createElement('option');
    //                 option.value = '';
    //                 option.textContent = 'No metrics available';
    //                 metricsSelect.appendChild(option);
    //             }
    //         })
    //         .catch(error => console.error('Error fetching metrics:', error));
    }

  </script>
</x-master>
