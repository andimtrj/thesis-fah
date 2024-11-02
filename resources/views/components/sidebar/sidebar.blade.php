<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button"
  class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
  <span class="sr-only">Open sidebar</span>
  <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path clip-rule="evenodd" fill-rule="evenodd"
      d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
    </path>
  </svg>
</button>

<aside id="logo-sidebar"
  class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
  aria-label="Sidebar">
  <div class="h-full px-3 py-4 overflow-y-auto flex flex-col justify-between bg-primary shadow-xl text-cream">
    <!-- Logo Section -->
    <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
      <span class="self-center text-xl font-semibold whitespace-nowrap">Restaurant</span>
    </a>

    <!-- Sidebar Links Section -->
    <div class="flex-1">
      <ul class="space-y-2 font-normal">
        <x-sidebar.sidebar-link href="{{ route('branch') }}" linkName="Branches">
          <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd"
              d="M5.535 7.677c.313-.98.687-2.023.926-2.677H17.46c.253.63.646 1.64.977 2.61.166.487.312.953.416 1.347.11.42.148.675.148.779 0 .18-.032.355-.09.515-.06.161-.144.3-.243.412-.1.111-.21.192-.324.245a.809.809 0 0 1-.686 0 1.004 1.004 0 0 1-.324-.245c-.1-.112-.183-.25-.242-.412a1.473 1.473 0 0 1-.091-.515 1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.401 1.401 0 0 1 13 9.736a1 1 0 1 0-2 0 1.4 1.4 0 0 1-.333.927.896.896 0 0 1-.667.323.896.896 0 0 1-.667-.323A1.4 1.4 0 0 1 9 9.74v-.008a1 1 0 0 0-2 .003v.008a1.504 1.504 0 0 1-.18.712 1.22 1.22 0 0 1-.146.209l-.007.007a1.01 1.01 0 0 1-.325.248.82.82 0 0 1-.316.08.973.973 0 0 1-.563-.256 1.224 1.224 0 0 1-.102-.103A1.518 1.518 0 0 1 5 9.724v-.006a2.543 2.543 0 0 1 .029-.207c.024-.132.06-.296.11-.49.098-.385.237-.85.395-1.344ZM4 12.112a3.521 3.521 0 0 1-1-2.376c0-.349.098-.8.202-1.208.112-.441.264-.95.428-1.46.327-1.024.715-2.104.958-2.767A1.985 1.985 0 0 1 6.456 3h11.01c.803 0 1.539.481 1.844 1.243.258.641.67 1.697 1.019 2.72a22.3 22.3 0 0 1 .457 1.487c.114.433.214.903.214 1.286 0 .412-.072.821-.214 1.207A3.288 3.288 0 0 1 20 12.16V19a2 2 0 0 1-2 2h-6a1 1 0 0 1-1-1v-4H8v4a1 1 0 0 1-1 1H6a2 2 0 0 1-2-2v-6.888ZM13 15a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-2Z"
              clip-rule="evenodd" />
          </svg>
        </x-sidebar.sidebar-link>
        <x-sidebar.sidebar-link href="{{ route('ingredient') }}" linkName="Ingredients">
          <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M10.357 4.103c-1.001 1.001-1.58 2.335-1.912 3.673c-.333 1.344-.431 2.747-.43 3.95a.327.327 0 0 1-.322.323c-1.771.007-4.016.22-5.832 1.087c-.682.326-.967.998-.826 1.635c.133.596.615 1.085 1.267 1.244c.795.194 1.717.445 2.519.73c.401.142.76.288 1.052.434c.302.152.487.28.578.372c.091.09.22.275.371.577c.146.292.292.65.434 1.051c.284.801.534 1.723.728 2.517c.159.652.648 1.135 1.245 1.267c.637.142 1.309-.143 1.635-.825c.867-1.813 1.08-4.054 1.09-5.823c0-.174.147-.321.323-.321c1.202 0 2.606-.098 3.95-.431c1.34-.333 2.674-.912 3.676-1.914c1.12-1.12 1.668-2.609 1.917-4.056c.25-1.451.209-2.926.095-4.092a3.77 3.77 0 0 0-3.41-3.41c-1.166-.113-2.64-.154-4.092.095c-1.447.25-2.936.798-4.056 1.917M16 5a1 1 0 1 1 0 2a1 1 0 0 1 0-2" />
          </svg>
        </x-sidebar.sidebar-link>
        <x-sidebar.sidebar-link href="{{ route('product') }}" linkName="Products">
          <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" width="24" height="24"
            viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M3.743 2.816A.88.88 0 0 1 5.5 2.88v4.494a.625.625 0 1 0 1.25 0V2.75a.75.75 0 0 1 1.5 0v4.624a.625.625 0 1 0 1.25 0V2.88a.88.88 0 0 1 1.757-.064C11.3 3.428 11.5 6.37 11.5 8c0 1.35-.67 2.544-1.692 3.267c-.216.153-.268.315-.263.397c.123 1.878.455 7.018.455 7.833a2.5 2.5 0 0 1-5 0c0-.816.332-5.955.455-7.833c.005-.082-.047-.244-.263-.397A4 4 0 0 1 3.5 8c0-1.63.2-4.572.243-5.184M13 7.75A5.75 5.75 0 0 1 18.75 2a.75.75 0 0 1 .75.75v8.5c0 .318.106 1.895.225 3.642l.005.083c.13 1.908.27 3.983.27 4.522a2.5 2.5 0 0 1-5 0c0-.514.128-2.611.252-4.534c.062-.971.125-1.912.172-2.61l.023-.353h-.697A1.75 1.75 0 0 1 13 10.25z" />
          </svg>
        </x-sidebar.sidebar-link>

        <li>
          <button type="button" id="transaction-btn"
            class="flex items-center w-full p-2 text-baseflex group hover:bg-secondary transition duration-75 rounded-lg group {{ Request::routeIs('summary', 'adjustment', 'usage', 'purchase') ? 'bg-secondary text-white' : 'bg-primary text-white' }}">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
              <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                color="currentColor">
                <path stroke-width="2"
                  d="M4.58 8.607L2 8.454C3.849 3.704 9.158 1 14.333 2.344c5.513 1.433 8.788 6.918 7.314 12.25c-1.219 4.411-5.304 7.337-9.8 7.406" />
                <path stroke-width="2"
                  d="M12 22C6.5 22 2 17 2 11m11.604-1.278c-.352-.37-1.213-1.237-2.575-.62c-1.361.615-1.577 2.596.482 2.807c.93.095 1.537-.11 2.093.47c.556.582.659 2.198-.761 2.634s-2.341-.284-2.588-.509m1.653-6.484v.79m0 6.337v.873" />
              </g>
            </svg>
            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Transaction</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 4 4 4-4" />
            </svg>
          </button>
          <ul id="dropdown-example" class="hidden py-2 space-y-2">
            <li>
              <a href="{{ route('usage') }}"
                class="flex items-center w-full p-2 hover:bg-secondary transition duration-75 rounded-lg pl-11 group {{ request()->routeIs('usage') ? 'bg-secondary text-white' : 'bg-primary text-white' }}">Usage</a>
            </li>
            <li>
              <a href="{{ route('purchase') }}"
                class="flex items-center w-full p-2 hover:bg-secondary transition duration-75 rounded-lg pl-11 group {{ request()->routeIs('purchase') ? 'bg-secondary text-white' : 'bg-primary text-white' }}">Purchase</a>
            </li>
            <li>
              <a href="{{ route('adjustment') }}"
                class="flex items-center w-full p-2 hover:bg-secondary transition duration-75 rounded-lg pl-11 group {{ request()->routeIs('adjustment') ? 'bg-secondary text-white' : 'bg-primary text-white' }}">Adjustment</a>
            </li>
            <li>
              <a href="{{ route('summary') }}"
                class="flex items-center w-full p-2 hover:bg-secondary transition duration-75 rounded-lg pl-11 group {{ request()->routeIs('summary') ? 'bg-secondary text-white' : 'bg-primary text-white' }}">Summary</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>

    <!-- Logout Section -->
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button href="" class="flex items-center p-2 rounded-lg group hover:bg-secondary w-full">
        <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
          height="24" fill="none" viewBox="0 0 24 24">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
          <span class="ms-3">Log Out</span>
        </svg>
      </button>
    </form>
  </div>
</aside>

<div class="p-5 sm:ml-64">
  {{ $slot }}
</div>

<script>
  const transactionBtn = document.getElementById('transaction-btn');
  const dropdown = document.getElementById('dropdown-example');

  // Cek di localStorage apakah dropdown harus dibuka
  if (localStorage.getItem('transactionDropdownOpen') === 'true') {
    dropdown.classList.remove('hidden');
  }

  // Event listener untuk toggle dropdown dan menyimpan status ke localStorage
  transactionBtn.addEventListener('click', function() {
    dropdown.classList.toggle('hidden');
    const isOpen = !dropdown.classList.contains('hidden');
    localStorage.setItem('transactionDropdownOpen', isOpen);
  });
</script>
