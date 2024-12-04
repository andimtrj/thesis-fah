<x-master>
  <x-sidebar.sidebar>
    <div>
      <h1 class="text-3xl font-bold mb-2 text-secondary">Product Page</h1>
    </div>
    <div class="shadow-md">
      <div class="flex justify-between gap-3 items-center px-10 py-5 bg-primary rounded-t-xl">
        {{-- Header --}}
        <div class="flex items-center">
          <h1 class="text-3xl font-medium text-white">{{ $tenant->tenant_name }}</h1>
        </div>
        <div class="flex gap-3">
          <a href="{{ route('add-product') }}"
            class="flex items-center text-white bg-accent lg:px-3 md:px-1 py-2 rounded-lg gap-1 flex-shrink-0 shadow-container w-fit md:text-xs lg:text-base hover:shadow-button hover:shadow-accent">
            <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 12h14m-7 7V5" />
            </svg>
            <span>Add Product</span>
          </a>
        </div>
      </div>
      {{-- Search Filter --}}
      <div class="flex items-end gap-5 px-10 bg-white pt-5">
        <form action="" method="GET" class="flex gap-5 mb-5">
            @if(Auth::user()->role->role_code === "BA")
                <input type="hidden" name="branchCode" id="branchCode" value="{{ Auth::user()->branch->branch_code }}">
            @else
                <div class="w-[15vw]">
                    <label for="branchCode" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Select a branch</label>
                    <select id="branchCode" name="branchCode" required
                        class="block w-full p-2 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary">
                        <option value="" disabled {{ !request('branchCode') ? 'selected' : '' }}>Choose a branch</option>
                        @foreach ($branches as $branch)
                            <option value="{{ $branch->branch_code }}"
                                {{ request('branchCode') == $branch->branch_code ? 'selected' : '' }}>
                                {{ $branch->branch_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
          <div class="w-[15vw]">
            <label for="productCode" class="block mb-1 text-sm font-medium text-gray-900">Product code</label>
            <input type="text" id="productCode" name="productCode"
              class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary focus:border-primary"
              placeholder="Search by product code" value="{{ request('productCode') }}">
          </div>
          <div class="w-[15vw]">
            <label for="productName" class="block mb-1 text-sm font-medium text-gray-900">Product name</label>
            <input type="text" id="productName" name="productName"
              class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary focus:border-primary"
              placeholder="Search by product name" value="{{ request('productName') }}">
          </div>
          <div class="flex gap-2 items-end">
            <button type="submit"
              class="bg-secondary bg-opacity-10 rounded-lg px-5 py-2 text-secondary flex items-center gap-1 hover:shadow-button hover:shadow-secondary">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                  d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
              </svg>
              <span>Search</span>
            </button>
            <a href="{{ route('product') }}" class="bg-danger bg-opacity-10 rounded-lg px-5 py-2 text-danger flex items-center gap-1 hover:shadow-button hover:shadow-danger">
              <span>Clear Search</span>
            </a>
          </div>
        </form>
      </div>
    </div>

    @if (isset($formSubmitted) && $formSubmitted)
    <div class="mt-4">
      <x-product.table :products="$products" />
    </div>
    @endif

  </x-sidebar.sidebar>
</x-master>

<script>
    document.getElementById('ingredientForm').addEventListener('submit', function(event) {
      var branchCode = document.getElementById('branchCode');

      // Check if the value is empty (i.e., the placeholder is selected)
      if (branchCode.value === "") {
        event.preventDefault(); // Prevent form submission
        alert('Please select a valid branch from the dropdown.'); // Show an alert or handle notice
      }
    });
  </script>
