<x-master>
  <x-sidebar.sidebar>


    {{-- Above Table --}}
    <div class="flex mb-5 justify-between gap-3 items-center">
      <div class="flex items-center">
        <h1 class="text-3xl font-medium">Roji Ramen</h1>
      </div>

      <div class="flex gap-3">
        {{-- Filter --}}

        <form class="max-w-lg mx-auto w-96">
          <div class="flex">
            <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Your
              Email</label>

            <!-- Search By Button -->
            <button id="dropdown-button" data-dropdown-toggle="dropdown"
              class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700 dark:text-white dark:border-gray-600"
              type="button">
              <span id="dropdown-label">Search By</span> <!-- Span to update text -->
              <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 4 4 4-4" />
              </svg>
            </button>

            <!-- Dropdown Menu -->
            <div id="dropdown"
              class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdown-button">
                <li>
                  <button type="button"
                    class="dropdown-item inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-value="Branch ID">Branch ID</button>
                </li>
                <li>
                  <button type="button"
                    class="dropdown-item inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-value="Branch Name">Branch Name</button>
                </li>
                <li>
                  <button type="button"
                    class="dropdown-item inline-flex w-full px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-value="Branch Location">Branch Location</button>
                </li>
              </ul>
            </div>

            <!-- Search Input -->
            <div class="relative w-full">
              <input type="search" id="search-dropdown"
                class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-s-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                placeholder="Type here ..." required />
              <button type="submit"
                class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-secondary rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
              </button>
            </div>
          </div>
        </form>


        <div class="flex items-center">
          {{-- Button Add Branch --}}
          <button class="flex items-center text-white bg-[#F65A11] px-3 py-2 rounded-lg gap-1 flex-shrink-0 shadow-md">
            <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
              height="24" fill="none" viewBox="0 0 24 24">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M5 12h14m-7 7V5" />
            </svg>
            <span>Add Branch</span>
          </button>
        </div>
      </div>

    </div>

    {{-- Table --}}
    <div class="relative overflow-x-auto rounded-xl shadow-md">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        {{-- Table Head --}}
        <thead class="text-sm text-gray-700 uppercase bg-gray-200">
          <tr>
            <th scope="col" class="px-4 py-4 w-12 text-center">
              ID
            </th>
            <th scope="col" class="px-4 py-4 w-[45vw]">
              Location
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Total Branch Admin
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Action
            </th>
            <th scope="col" class="px-4 py-4"></th>
          </tr>
        </thead>

        {{-- Table Body --}}
        <tbody>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. In at non tempora.
            </td>
            <td class="px-4 py-3 text-center">
              5
            </td>

            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
              </a>
            </td>
            <td class="px-4 py-3 text-center">
              <a href="" class="bg-secondary px-5 py-2 text-white rounded-lg">View Details</a>
            </td>
          </tr>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. In at non tempora.
            </td>
            <td class="px-4 py-3 text-center">
              5
            </td>

            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
              </a>
            </td>
            <td class="px-4 py-3 text-center">
              <a href="" class="bg-secondary px-5 py-2 text-white rounded-lg">View Details</a>
            </td>
          </tr>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. In at non tempora.
            </td>
            <td class="px-4 py-3 text-center">
              5
            </td>

            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
              </a>
            </td>
            <td class="px-4 py-3 text-center">
              <a href="" class="bg-secondary px-5 py-2 text-white rounded-lg">View Details</a>
            </td>
          </tr>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. In at non tempora.
            </td>
            <td class="px-4 py-3 text-center">
              5
            </td>

            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
              </a>
            </td>
            <td class="px-4 py-3 text-center">
              <a href="" class="bg-secondary px-5 py-2 text-white rounded-lg">View Details</a>
            </td>
          </tr>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. In at non tempora.
            </td>
            <td class="px-4 py-3 text-center">
              5
            </td>

            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
              </a>
            </td>
            <td class="px-4 py-3 text-center">
              <a href="" class="bg-secondary px-5 py-2 text-white rounded-lg">View Details</a>
            </td>
          </tr>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. In at non tempora.
            </td>
            <td class="px-4 py-3 text-center">
              5
            </td>

            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
              </a>
            </td>
            <td class="px-4 py-3 text-center">
              <a href="" class="bg-secondary px-5 py-2 text-white rounded-lg">View Details</a>
            </td>
          </tr>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. In at non tempora.
            </td>
            <td class="px-4 py-3 text-center">
              5
            </td>

            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
              </a>
            </td>
            <td class="px-4 py-3 text-center">
              <a href="" class="bg-secondary px-5 py-2 text-white rounded-lg">View Details</a>
            </td>
          </tr>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. In at non tempora.
            </td>
            <td class="px-4 py-3 text-center">
              5
            </td>

            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
              </a>
            </td>
            <td class="px-4 py-3 text-center">
              <a href="" class="bg-secondary px-5 py-2 text-white rounded-lg">View Details</a>
            </td>
          </tr>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. In at non tempora.
            </td>
            <td class="px-4 py-3 text-center">
              5
            </td>

            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
              </a>
            </td>
            <td class="px-4 py-3 text-center">
              <a href="" class="bg-secondary px-5 py-2 text-white rounded-lg">View Details</a>
            </td>
          </tr>
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. In at non tempora.
            </td>
            <td class="px-4 py-3 text-center">
              5
            </td>

            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                  width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 12h14m-7 7V5" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
              </a>
              <a href="" class="border-2 w-fit p-1 rounded-lg">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                </svg>
              </a>
            </td>
            <td class="px-4 py-3 text-center">
              <a href="" class="bg-secondary px-5 py-2 text-white rounded-lg">View Details</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </x-sidebar.sidebar>


  <script>
    // JavaScript to handle dropdown selection
    document.addEventListener('DOMContentLoaded', function() {
      const dropdownButton = document.getElementById('dropdown-button');
      const dropdownLabel = document.getElementById('dropdown-label');
      const dropdownItems = document.querySelectorAll('.dropdown-item');

      dropdownItems.forEach(item => {
        item.addEventListener('click', function() {
          const selectedText = this.getAttribute('data-value');
          dropdownLabel.textContent = selectedText;

          // Close dropdown after selection (if required)
          document.getElementById('dropdown').classList.add('hidden');
        });
      });

      // Optional: Toggle dropdown visibility
      dropdownButton.addEventListener('click', function() {
        document.getElementById('dropdown').classList.toggle('hidden');
      });
    });
  </script>
</x-master>
