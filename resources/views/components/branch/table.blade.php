{{-- table.blade.php --}}
<div class="relative overflow-x-auto bg-white rounded-xl shadow-container">
    <table class="min-w-full leading-normal">
        <thead class="bg-cream">
            <tr>
                <th scope="col" class="px-4 py-3 text-center">Branch Code</th>
                <th scope="col" class="px-4 py-3">Branch Name</th>
                <th scope="col" class="px-4 py-3 text-center">Admin Count</th>
                <th scope="col" class="px-4 py-3 text-center">Actions</th>
            </tr>
        </thead>
        <tbody>

            @if(isset($branches) && $branches->isNotEmpty())
            @foreach ($branches as $branch)
                <tr class="bg-white border-y text-base text-abu">
                    <th scope="row" class="px-3 py-[10px] font-medium text-center">{{ $branch->branch_code }}</th>
                    <td class="px-3 py-[10px]">{{ $branch->branch_name }}</td>
                    <td class="px-3 py-[10px] text-center">{{ $branch->branch_admin_count }}</td>
                    <td class="px-3 py-[10px] flex gap-4 items-center justify-center">
                        <a href="{{ route('edit-branch', ['id' => $branch->id]) }}" class="border-2 w-fit p-1 rounded-lg cursor-pointer">
                            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                            </svg>
                        </a>
                        <x-branch.delete-branch :branch="$branch" />
                    </td>
                </tr>
            @endforeach
            @elseif ($branches->isEmpty())
            {{-- {{ dd($request->session()->all()) }} --}}
                <tr>
                    <td colspan="4" class="text-center py-4">No branches found</td>
                </tr>
            @endif
        </tbody>
    </table>
</div>

{{-- Pagination --}}
@if(isset($branches))
    <div class="mt-4">
        {{ $branches->appends(request()->query())->links() }}
    </div>
@endif

