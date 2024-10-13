{{-- Table --}}
<div class="relative overflow-x-auto bg-white rounded-xl shadow-container">
    <table class="min-w-full leading-normal">
    {{-- Table Head --}}
    <thead class="bg-cream">
        <tr>
        <th scope="col" class="px-4 py-4 text-center w-[15.2vw]">
            Ingredient Code
        </th>
        <th scope="col" class="px-4 py-4 text-left w-[21vw]">
            Ingredient Name
        </th>
        <th scope="col" class="px-4 py-4 text-right lg:w-[15vw] md:w-[7vw]">
            Ingredient Amount
        </th>
        <th scope="col" class="px-4 py-4 text-center">
            Metric
        </th>
        <th scope="col" class="px-4 py-4 text-center">
            Action
        </th>
        </tr>
    </thead>

    {{-- Table Body --}}
    <tbody>
        {{-- Table Body --}}
        @if(isset($ingredients) && $ingredients->isNotEmpty())
        @foreach ($ingredients as $ingredient)
            <tr class="bg-white border-y text-base text-abu">
                <th scope="row" class="px-4 py-3 font-medium text-center">{{ $ingredient->ingredient_code }}</th>
                <td class="px-4 py-3">{{ $ingredient->ingredient_name }}</td>
                <td class="px-4 py-3 text-right">{{ $ingredient->ingredient_amt }}</td>
                <td class="px-4 py-3 text-center">{{ $ingredient->metric_unit }}</td>
                <td class="px-4 py-3 flex gap-4 items-center justify-center">
                <a href="{{ route('edit-ingredient') }}" class="border-2 w-fit p-1 rounded-lg cursor-pointer">
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                    </svg>
                </a>
                <x-ingredient.delete-ingredient />
                </td>
            </tr>
        @endforeach
        @elseif ($ingredients->isEmpty())
        {{-- {{ dd($request->session()->all()) }} --}}
            <tr>
                <td colspan="5" class="text-center py-4">No Ingredients found</td>
            </tr>
        @endif
        </tr>
    </tbody>
    </table>
</div>


@if(isset($ingredients))
{{-- {{ dd(isset($ingredients)) }} --}}

    <div class="mt-4">
        {{ $ingredients->appends(request()->query())->links() }}
    </div>
@endif
