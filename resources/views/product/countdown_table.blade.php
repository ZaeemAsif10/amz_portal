<table class="table table-nowrap mb-0" id="myTable">
    <thead>
        <tr class="text-center">
            <th>#</th>
            <th>User</th>
            <th>Product ID</th>
            <th class="web_view_h">Time</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="reserveTable">
        @if (count($data['reserve_products']) > 0)
            @foreach ($data['reserve_products'] as $key => $reserve)
                <tr class="text-center">
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $reserve->users->name ?? '' }}</td>
                    <td>{{ $reserve->products->product_no ?? '' }}</td>

                    {{-- <td class="countdown" data-end-time="{{ $reserve->start_time }}">
                        <span class="countdown-timer badge badge-danger"></span>
                    </td> --}}

                    <td class="web_view">
                        <div class="countdown badge badge-danger" data-end="{{ $reserve->start_time }}">
                        </div>
                    </td>

                    <td>
                        <img src="{{ url('public/uploads/image/' . ($reserve->products->image ?? '')) }}"
                            width="40" height="40" alt="No Image">
                    </td>
                    <td>
                        @if (Auth::user()->role == 'pm')
                            <a href="{{ url('create_order/' . ($reserve->products->product_no ?? '')) }}"
                                class="btn btn-success btn-sm">Create Order</a>
                        @endif
                        <input type="hidden" name="product_id" id="product_id"
                            value="{{ $reserve->products->id ?? '' }}">
                        <input type="hidden" name="id" id="id" value="{{ $reserve->id }}">
                        <button type="submit" class="btn btn-danger btn-sm remove_btn">Remove</button>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
