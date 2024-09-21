    {{-- Table --}}
    <div class="relative overflow-x-auto rounded-t-xl">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        {{-- Table Head --}}
        <thead class="text-sm text-gray-700 uppercase bg-gray-200">
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
          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-base">
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
              <x-branch.edit-branch/>
              <x-branch.delete-branch/>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
