    {{-- Table --}}
    <div class="relative overflow-x-auto bg-white rounded-xl shadow-container">
      <table class="min-w-full leading-normal">
        {{-- Table Head --}}
        <thead class="bg-cream">
          <tr>
            <th scope="col" class="px-4 py-4 text-center">
              Ingredient Name
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Start Amount
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Usage Amount
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Purchase Amount
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Adjustment Amount
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              End Amount
            </th>
            <th scope="col" class="px-4 py-4 text-center">
                Metric Unit
            </th>
          </tr>
        </thead>

        {{-- Table Body --}}
        <tbody>
            @if(isset($summary))
                @foreach ($summary as $item)
            {{-- Table Body --}}
                    <tr class="bg-white border-y text-base text-abu">
                        <th scope="row" class="px-4 py-3 font-medium text-center">{{ $item->INGREDIENT_NAME }}</th>
                        <td class="px-4 py-3 text-center">{{ $item->START_AMT }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->USAGE_AMT }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->PURCHASE_AMT }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->ADJUSTMENT_AMT }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->END_AMT }}</td>
                        <td class="px-4 py-3 text-center">{{ $item->METRIC_UNIT }}</td>
                    </tr>
                @endforeach
            @elseif ($summary->isEmpty())
            {{-- {{ dd($request->session()->all()) }} --}}
                <tr>
                    <td colspan="5" class="text-center py-4">No Summary Found</td>
                </tr>
            @endif
        </tbody>
      </table>
    </div>
