    {{-- Table --}}
    <div class="relative overflow-x-auto bg-white rounded-xl shadow-container">
      <table class="min-w-full leading-normal">
        {{-- Table Head --}}
        <thead class="bg-cream">
          <tr>
            <th scope="col" class="px-4 py-4 w-[13vw] text-center">
              Transaction Number
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Branch Name
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Total Ingredient
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Submitted By
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Transaction Date
            </th>
          </tr>
        </thead>

        {{-- Table Body --}}
        <tbody>
            @if(isset($purchases) && $purchases->isNotEmpty())
            @foreach ($purchases as $purchase)
            <tr class="bg-white border-y text-base text-abu">
                <th scope="row" class="px-4 py-3 font-medium text-center">{{ $purchase->purchase_trx_no }}</th>
                <td class="px-4 py-3 text-center">{{ $purchase->branch_name }}</td>
                <td class="px-4 py-3 text-center">{{ $purchase->total_ingredient }}</td>
                <td class="px-4 py-3 text-center">{{ $purchase->submitted_by }}</td>
                <td class="px-4 py-3 text-center">{{ $purchase->trx_date }}</td>
              </tr>
            @endforeach
            @elseif ($purchases->isEmpty())
            {{-- {{ dd($request->session()->all()) }} --}}
                <tr>
                    <td colspan="5" class="text-center py-4">No Purchase Transactions Found</td>
                </tr>
            @endif
        </tbody>
      </table>
    </div>
