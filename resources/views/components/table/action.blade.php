@props(['addUrl', 'editUrl', 'deleteUrl', 'detailUrl', 'hideActions'=>false])

<td class="px-4 py-3 flex gap-4 items-center justify-center">
  @if (!isset($hideActions) || !$hideActions)
    <a href=" {{ $addUrl }}" class="border-2 w-fit p-1 rounded-lg">
      <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
        height="24" fill="none" viewBox="0 0 24 24">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M5 12h14m-7 7V5" />
      </svg>
    </a>
  @endif
  <a href=" {{ $editUrl }}" class="border-2 w-fit p-1 rounded-lg">
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
      fill="none" viewBox="0 0 24 24">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
    </svg>
  </a>
  <a href=" {{ $deleteUrl }}" class="border-2 w-fit p-1 rounded-lg">
    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
      fill="none" viewBox="0 0 24 24">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
    </svg>
  </a>
</td>
<td class="px-4 py-3 text-center">
  @if (!isset($hideActions) || !$hideActions)
    <a href=" {{ $detailUrl }}" class="bg-secondary px-5 py-2 text-white rounded-lg">View Details</a>
  @endif
</td>
