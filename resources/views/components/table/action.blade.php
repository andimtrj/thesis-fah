@props(['addUrl', 'detailUrl', 'hideActions'=>false, 'modalTitle'=>'Delete Modal', 'modalDesc'=>'Delete Desc Modal'])

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
  <x-modal.edit-modal>
    @slot('modalTitle')
      Edit Branch
    @endslot
    @slot('label1')
      Branch Name
    @endslot
    @slot('label2')
      Branch Location
    @endslot
  </x-modal.edit-modal>
  <x-modal.delete-modal :modalTitle="$modalTitle" :modalDesc="$modalDesc"/>

</td>
<td class="px-4 py-3 text-center">
  @if (!isset($hideActions) || !$hideActions)
    <a href=" {{ $detailUrl }}" class="bg-secondary px-5 py-2 text-white rounded-lg md:flex">View Details</a>
  @endif
</td>
