<meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Table --}}
    <div class="relative overflow-x-auto bg-white rounded-xl shadow-container">
      <table class="min-w-full leading-normal">
        {{-- Table Head --}}
        <thead class="bg-cream">
          <tr>
            <th scope="col" class="px-4 py-4 text-center w-[15.2vw]">
              Product Code
            </th>
            <th scope="col" class="px-4 py-4 text-left w-[21vw]">
              Product Name
            </th>
            <th scope="col" class="px-4 py-4 text-center lg:w-[12vw] md:w-[5vw]">
              Total Ingredients
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Product Price
            </th>
            <th scope="col" class="px-4 py-4 text-center">
              Action
            </th>
          </tr>
        </thead>

        {{-- Table Body --}}
        <tbody>
            {{-- Table Body --}}
            @if(isset($products) && $products->isNotEmpty())
            @foreach ($products as $product)
                <tr class="bg-white border-y text-base text-abu">
                    <th scope="row" class="px-4 py-3 font-medium text-center">{{ $product->product_code }}</th>
                    <td class="px-4 py-3">{{ $product->product_name }}</td>
                    <td class="px-4 py-3 text-right">{{ $product->total_ingredients }}</td>
                    <td class="px-4 py-3 text-center">{{ 'Rp' . number_format($product->product_price, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 flex gap-4 items-center justify-center">
                    <a href="{{ route('edit-product',  ['id' => $product->id]) }}" class="border-2 w-fit p-1 rounded-lg cursor-pointer hover:shadow-button hover:shadow-gray-400">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                        </svg>
                    </a>
                    <a data-modal-target="deleteModal" data-modal-toggle="deleteModal" class="border-2 w-fit p-1 rounded-lg cursor-pointer"
                        href="" onclick="confirmation(event, {{ $product->id }})">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                        </svg>
                    </a>
                    </td>
                </tr>
            @endforeach
            @elseif ($products->isEmpty())
            {{-- {{ dd($request->session()->all()) }} --}}
                <tr>
                    <td colspan="5" class="text-center py-4">No Products Found</td>
                </tr>
            @endif
            </tr>
        </tbody>
    </table>
</div>

<script>

    function confirmation(event, id) {
        event.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Make a POST request to your delete route
                fetch(`/delete-product/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to delete the item');
                    }
                })
                .then(data => {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    }).then(() => {
                        // Optionally, reload the page or remove the deleted item from the DOM
                        location.reload(); // Or manipulate DOM to remove the deleted row
                    });
                })
                .catch(error => {
                    Swal.fire({
                        title: "Error!",
                        text: "There was an issue deleting the file.",
                        icon: "error"
                    });
                    console.error('Error:', error);
                });
            }
        });
    }
</script>

