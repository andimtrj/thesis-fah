<x-master>
  <x-sidebar.sidebar>
    {{-- Page Title --}}
    <div>
      <h1 class="text-3xl font-bold mb-2 text-secondary">Usage Page</h1>
    </div>

    {{-- SubTitle, Search --}}
    <div class="shadow-md rounded-t-xl">
      <div class="flex justify-between gap-3 items-center px-10 py-5 bg-primary rounded-t-xl">
        <div class="flex items-center">
          <h1 class="text-3xl font-medium text-white">{{ $tenant->tenant_name }}</h1>
        </div>
        <div class="flex gap-3">
          <a href="{{ route('add-usage') }}"
            class="flex items-center text-white bg-accent lg:px-3 md:px-1 py-2 rounded-lg gap-1 flex-shrink-0 shadow-container w-fit md:text-xs lg:text-base hover:shadow-button hover:shadow-accent">
            <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 12h14m-7 7V5" />
            </svg>
            <span>Add Usage</span>
          </a>
        </div>
      </div>

      <div class="flex items-end gap-5 px-10 bg-white pt-5">
        <form action="{{ route('usage') }}" method="GET" class="flex flex-col gap-5 mb-5 w-full">
          <div>
            <div class="flex gap-2">
                @if(Auth::user()->role->role_code === "BA")
                    <input id="branchCode" type="hidden" name="branchCode" id="branchCode" value="{{ Auth::user()->branch->branch_code }}">
                @else
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
                @endif
              <input type="text" id="trxNo" name="trxNo"
                class="block w-full p-2.5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-sm focus:ring-primary focus:border-primary"
                placeholder="Search by transaction number" value="{{ request('trxNo') }}">
            </div>
          </div>
          {{-- Date Picker --}}
          <div id="date-range-picker" date-rangepicker class="flex items-center justify-between">
            <div class="flex items-center">
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
              <a href="{{ route('usage') }}"
                class="bg-danger bg-opacity-10 rounded-lg px-5 py-2 text-danger flex items-center gap-1 hover:shadow-button hover:shadow-danger">
                <span>Clear Search</span>
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>

    @if (isset($formSubmitted) && $formSubmitted)
    <div class="mt-4">
        <x-usage.table :usages="$usages"/>
    </div>
    @endif
  </x-sidebar.sidebar>
</x-master>
