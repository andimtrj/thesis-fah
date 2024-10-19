<x-master>
  <x-sidebar.sidebar>
    <div class="shadow-xl rounded-xl">
      <div class="px-10 py-5 bg-primary text-white rounded-t-xl">
        <h1 class="text-3xl font-medium">Add Product</h1>
      </div>
      <div class="px-10 py-7 rounded-xl bg-white">
        <h2 class="text-xl font-medium mb-5 border-b-abu border-b-2">Product Details</h2>
        <form action="" method="POST">
          @csrf
          <div class="mb-5">
            <label for="productName" class="flex mb-1 text-sm font-medium text-gray-900 justify-between items-center">
              <span>Product
                Name</span>
              <label class="inline-flex items-center cursor-pointer">
                <span class="text-sm font-medium text-gray-900 mr-2">Is Active</span>
                <input type="checkbox" value="" class="sr-only peer">
                <div
                  class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                </div>
              </label>
            </label>
            <input type="text" name="productName" id="productName"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type ingredient name" required="">
          </div>
          <div class="grid md:grid-cols-2 md:gap-6 mb-5 items-center">
            <div>
              <label for="metricGroups" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                Category</label>
              <select id="metricGroups" name="metricGroups"
                class="bg-gray-50 border border-gray-300 text-sm text-gray-900 rounded-lg focus:ring-primary block w-full p-2.5">
                <option value="" disabled selected>Select product category</option>
              </select>
            </div>
            <div>
              <label for="number-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                Price</label>
              <input type="number" id="number-input" name="ingredientAmt" aria-describedby="helper-text-explanation"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
                placeholder="Type a number" step="1000" required />
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
                class="text-green-500 bg-green-500 bg-opacity-10 hover:underline underline-offset-2 px-4 py-2 rounded-lg">Add
                Row</button>
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
    document.getElementById('add-row').addEventListener('click', function() {
      let tableBody = document.getElementById('ingredient-table-body');
      let rowCount = tableBody.rows.length;

      let newRow = document.createElement('tr');
      newRow.classList.add('bg-white', 'border-y', 'text-base', 'text-abu');

      newRow.innerHTML = `
    <td class="px-2 py-3">
      <input type="text" name="ingredients[${rowCount}][name]"
        class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary"
        placeholder="Type ingredient name">
    </td>
    <td class="px-2 w-full">
      <div class="flex items-center justify-center">
        <button class="decrease-value inline-flex items-center justify-center p-1 me-3 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200">
          <span class="sr-only">Quantity button</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
          </svg>
        </button>
        <div>
          <input type="number" name="ingredients[${rowCount}][amount]"
            class="ingredient-amount bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1"
            value="0" required />
        </div>
        <button class="increase-value inline-flex items-center justify-center h-6 w-6 p-1 ms-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-full focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200">
          <span class="sr-only">Quantity button</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
          </svg>
        </button>
      </div>
    </td>
    <td class="px-2">
      <select id="metricGroups" name="ingredients[${rowCount}][metrics]"
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
  </script>

</x-master>
