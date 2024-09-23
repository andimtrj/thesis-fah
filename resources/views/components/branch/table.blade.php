    {{-- Table --}}
    <div class="relative overflow-x-auto rounded-t-xl">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        {{-- Table Head --}}
        <thead class="text-sm text-gray-700 uppercase bg-cream">
          <tr>
            <th scope="col" class="px-4 py-4 text-center">
              Branch Code
            </th>
            <th scope="col" class="px-4 py-4 lg:w-[45vw] md:w-[18vw]">
              Branch Name
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Total Branch Admin
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Action
            </th>
          </tr>
        </thead>

        {{-- Table Body --}}
        <tbody>
          {{-- Table Body --}}
          <tr class="bg-white border-y dark:bg-gray-800 dark:border-gray-700 text-base">
            <th scope="row"
              class="px-4 py-3 font-medium text-center">
              RR0001
            </th>
            <td class="px-4 py-3">
              Roji Ramen Alam Sutera
            </td>
            <td class="px-4 py-3 text-center">
              5
            </td>
            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <a href="{{ route('edit-branch') }}" class="border-2 w-fit p-1 rounded-lg cursor-pointer">
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                  viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                </svg>
              </a>
              <x-branch.delete-branch/>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
