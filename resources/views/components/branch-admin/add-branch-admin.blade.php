<x-master>
  <x-sidebar.sidebar>
    <div class="shadow-xl rounded-xl">
      <div class="px-10 py-5 bg-primary text-white rounded-t-xl">
        <h1 class="text-3xl font-medium">Add Branch Admin</h1>
      </div>
      <div class="px-10 py-7 rounded-xl bg-white">
        <h2 class="text-xl font-medium mb-5 border-b-abu border-b-2">Admin Details</h2>
        <form action="{{ route('insert-branch-admin') }}" method="POST">
          @csrf
          <div class="mb-5">
            <label for="username" class="block mb-1 text-sm font-medium text-gray-900">Username</label>
            <input type="text" name="username" id="username"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type admin username" required="">
          </div>
          <div class="mb-5">
            <label for="email" class="block mb-1 text-sm font-medium text-gray-900">Email</label>
            <input type="email" name="email" id="email"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type admin email" required="">
          </div>
          <div class="grid md:grid-cols-2 md:gap-6 mb-5">
            <div>
              <label for="firstName" class="block mb-1 text-sm font-medium text-gray-900">First Name</label>
              <input type="text" name="firstName" id="firstName"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
                placeholder="Type admin first name" required="">
            </div>
            <div>
              <label for="lastName" class="block mb-1 text-sm font-medium text-gray-900">Last Name</label>
              <input type="text" name="lastName" id="lastName"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
                placeholder="Type admin last name" required="">
            </div>
          </div>
          <div class="mb-5">
            <label for="phoneNumber" class="block mb-1 text-sm font-medium text-gray-900">Phone Number</label>
            <input type="tel" name="phoneNumber" id="phoneNumber"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type admin phone number" required="">
          </div>
          <div class="mb-5">
            <label for="password" class="block mb-1 text-sm font-medium text-gray-900">Password</label>
            <input type="password" name="password" id="password"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary block w-full p-2.5"
              placeholder="Type Password" required="">
          </div>

          {{-- Hidden Item --}}
          <input type="hidden" name="roleCode" value="BA">
          <input type="hidden" name="tenantId" value="{{ $authTenantId }}">
          <input type="hidden" name="branchId" value="{{ $branch->id }}">

          <div class="flex justify-end gap-5">
            <a href="{{ route('branch-admin', ['branchId' => $branch->id]) }}"
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
</x-master>
