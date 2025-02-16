    {{-- Table --}}
    <div class="relative overflow-x-auto bg-white rounded-xl shadow-container">
      <table class="min-w-full leading-normal">
        {{-- Table Head --}}
        <thead class="bg-cream">
          <tr>
            <th scope="col" class="px-4 py-4 text-center">
              Admin Name
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Admin Username
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Email
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Action
            </th>
          </tr>
        </thead>

        {{-- Table Body --}}
        <tbody>
          @if (isset($branchAdmins) && $branchAdmins->isNotEmpty())
            @foreach ($branchAdmins as $branchAdmin)
              {{-- Table Body --}}
              <tr class="bg-white border-y text-base text-abu">
                <th scope="row" class="px-4 py-3 font-medium text-center">{{ $branchAdmin->name }}</th>
                <td class="px-4 py-3 text-center">{{ $branchAdmin->username }}</td>
                <td class="px-4 py-3 text-center">{{ $branchAdmin->email }}</td>
                <td class="px-4 py-3 text-center flex items-center justify-center gap-4">
                  <a href="{{ route('edit-branch-admin', ['branchAdminId' => $branchAdmin->id]) }}"
                    class="border-2 w-fit p-1 rounded-lg cursor-pointer hover:shadow-button hover:shadow-gray-400">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                      height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                    </svg>
                  </a>
                  <x-branch-admin.delete-branch-admin :branchAdmin="$branchAdmin" />
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
    </div>
