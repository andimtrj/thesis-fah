<x-master>
  <x-sidebar.sidebar>
    {{-- SubTitle, Add, Search --}}
    <div class="shadow-md rounded-xl mt-3">
      <div class="flex justify-between gap-3 items-center px-10 py-5 bg-primary rounded-t-xl">
        <div class="flex items-center">
          <h1 class="text-3xl font-medium text-white">{{ $tenant->tenant_name }}</h1>
        </div>
        <div class="flex gap-3">
          <a href="{{ route('add-branch') }}"
            class="flex items-center text-white bg-accent lg:px-3 md:px-1 py-2 rounded-lg gap-1 flex-shrink-0 shadow-container w-fit md:text-xs lg:text-base hover:shadow-button hover:shadow-accent">
            <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 12h14m-7 7V5" />
            </svg>
            <span>Add Branch</span>
          </a>
        </div>
      </div>

      <div class="flex items-end gap-5 px-10 bg-white pt-5 rounded-b-xl">
        <form action="{{ route('branch') }}" method="GET" class="flex gap-5 mb-5">
          <div class="w-[15vw]">
            <label for="branchCode" class="block mb-1 text-sm font-medium text-gray-900">Branch code</label>
            <input type="text" id="branchCode" name="branchCode"
              class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary focus:border-primary"
              placeholder="Search by branch code" value="{{ request('branchCode') }}">
          </div>
          <div class="w-[15vw]">
            <label for="branchName" class="block mb-1 text-sm font-medium text-gray-900">Branch name</label>
            <input type="text" id="branchName" name="branchName"
              class="block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-primary focus:border-primary"
              placeholder="Search by branch name" value="{{ request('branchName') }}">
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
            <a href="{{ route('branch') }}"
              class="bg-danger bg-opacity-10 rounded-lg px-5 py-2 text-danger flex items-center gap-1 hover:shadow-button hover:shadow-danger">
              <span>Clear Search</span>
            </a>
          </div>
        </form>
      </div>
    </div>

    @if (isset($formSubmitted) && $formSubmitted)
      <div class="mt-4">
        <x-branch.table :branches="$branches" />
      </div>
    @endif

  </x-sidebar.sidebar>
</x-master>
