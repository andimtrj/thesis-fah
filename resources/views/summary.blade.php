<x-master>
  <x-sidebar.sidebar>
    {{-- SubTitle, Search --}}
    <div class="shadow-md rounded-xl mt-3">
      <div class="flex justify-between gap-3 items-center px-10 py-5 bg-primary rounded-t-xl">
        <div class="flex items-center">
          <h1 class="text-3xl font-medium text-white">{{ $tenant->tenant_name }}</h1>
        </div>
      </div>
      <div class="flex items-end gap-5 px-10 bg-white pt-5 rounded-b-xl">
        <form action="{{ route('summary') }}" method="GET" class="flex gap-5 mb-5">
          {{-- Date Picker --}}
          <div id="date-range-picker" date-rangepicker class="flex items-center">
            <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
              </div>
              <input id="datepicker-range-start" name="startDate" type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date start" value="{{ request('startDate') }}">
            </div>
            <span class="mx-4 text-gray-500">to</span>
            <div class="relative">
              <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path
                    d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
              </div>
              <input id="datepicker-range-end" name="endDate" type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date end" value="{{ request('endDate') }}">
            </div>
          </div>
          <div class="flex gap-2">
            @if(Auth::user()->role->role_code === "BA")
                <input type="hidden" name="branchCode" id="branchCode" value="{{ Auth::user()->branch->branch_code }}">
            @else
                <div class="w-[15vw]">
                    {{-- <label for="branchCode" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Select a branch</label> --}}
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
            <a href="{{ route('summary') }}"
                class="bg-danger bg-opacity-10 rounded-lg px-5 py-2 text-danger flex items-center gap-1 hover:shadow-button hover:shadow-danger">
                <span>Clear Search</span>
            </a>
            <button id="export-button"
                {{ isset($formSubmitted) && $formSubmitted ? '' : 'disabled' }}
                onclick="preventExportIfNotSearched(event)"
                class="bg-secondary bg-opacity-10 rounded-lg px-5 py-2 text-secondary flex items-center gap-1 hover:shadow-button hover:shadow-secondary disabled:opacity-50 disabled:cursor-not-allowed">
                Export
            </button>
          </div>
        </form>
      </div>
    </div>

    {{-- Table --}}
    @if (isset($formSubmitted) && $formSubmitted)
    <div class="mt-4">
        <x-summary.table :summary="$summary"/>
      </div>
    @endif

  </x-sidebar.sidebar>
</x-master>

<script>
    function preventExportIfNotSearched(event) {
        console.log("{{ Auth::user()->role->role_code  }}");
        const formSubmitted = {{ isset($formSubmitted) && $formSubmitted ? 'true' : 'false' }};
        if (!formSubmitted) {
            event.preventDefault();
            alert('Data is not Searched!');
        } else {
            if("{{ Auth::user()->role->role_code }}" === "BA"){

                const branchCodeSelect = document.getElementById('branchCode');
                const branches = @json($branches ?? []);
                const filteredBranch = branches.filter(branch => branch.branch_code ===  branchCodeSelect.value);
                const branch = filteredBranch[0];
                console.log(branch);
                event.preventDefault();
                const exportUrl = "{{ route('export-summary') }}";
                const queryParams = new URLSearchParams({
                    summary: JSON.stringify( @json($summary ?? [])),
                    tenant: "{{ $tenant->tenant_name }}",
                    branch: branch.branch_name,
                    date: "{{ now()->format('Ymd') }}"
                }).toString();
                window.location.href = `${exportUrl}?${queryParams}`;
            }else{
                // Get the selected option
                const branchCodeSelect = document.getElementById('branchCode');
                const selectedOption = branchCodeSelect.options[branchCodeSelect.selectedIndex];

                // Extract the branch_name from the selected option
                const branchName = selectedOption.textContent; // or selectedOption.innerText

                // const summary = @json($summary ?? []);
                // Redirect to the export route with necessary data
                event.preventDefault();
                const exportUrl = "{{ route('export-summary') }}";
                const queryParams = new URLSearchParams({
                    summary: JSON.stringify( @json($summary ?? [])),
                    tenant: "{{ $tenant->tenant_name }}",
                    branch: branchName,
                    date: "{{ now()->format('Ymd') }}"
                }).toString();
                window.location.href = `${exportUrl}?${queryParams}`;

            }
        }
    }
</script>
