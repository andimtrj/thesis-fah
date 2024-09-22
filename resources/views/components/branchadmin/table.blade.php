    {{-- Table --}}
    <div class="relative overflow-x-auto rounded-t-xl">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        {{-- Table Head --}}
        <thead class="text-sm text-gray-700 uppercase bg-gray-200">
          <tr>
            <th scope="col" class="px-4 py-4 w-12 text-center">
              ID
            </th>
            <th scope="col" class="px-4 py-4 w-[30vw]">
              Admin Name
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Email
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Phone Number
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Action
            </th>
            <th scope="col" class="px-4 py-4"></th>
          </tr>
        </thead>

        {{-- Table Body --}}
        <tbody>
          {{-- Table Body --}}
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-base">
            <th scope="row"
              class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
              1
            </th>
            <td class="px-4 py-3">
              Andi Mataraja
            </td>
            <td class="px-4 py-3 text-center">
              andi.mataraja@binus.ac.id
            </td>
            <td class="px-4 py-3 text-center">
              081287708023
            </td>
            <td class="px-4 py-3 flex gap-4 items-center justify-center">
              <x-branchadmin.edit-admin/>
              <x-branchadmin.delete-admin/>
            </td>
            <td class="px-4 py-3 text-center"></td>
          </tr>
        </tbody>
      </table>
    </div>
