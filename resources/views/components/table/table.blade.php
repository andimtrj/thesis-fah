    {{-- Table --}}
    <div class="relative overflow-x-auto rounded-t-xl">
      <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        {{-- Table Head --}}
        <thead class="text-sm text-gray-700 uppercase bg-gray-200">
          <tr>
            {{ $head }}
          </tr>
        </thead>

        {{-- Table Body --}}
        <tbody>
          {{ $slot }}
        </tbody>
      </table>
    </div>
