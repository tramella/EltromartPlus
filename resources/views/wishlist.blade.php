@extends('layouts.app')
@section('content')
    <div class="w-full px-5 py-10 flex  flex-col justify-center items-center">

        {{-- wishlists --}}
        {{-- <div class="title-wishlist">WishList</div> --}}
        @if ($wishlists->isEmpty())
            <div class="w-full flex justify-center items-center">Wishlist is empty</div>
        @else
            <div class="w-wishlist flex flex-col">

                <table class="w-full">
                    <thead class="thead-css">
                        <tr class="item-center py-2">
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wishlists as $index => $w)
                            <tr class="item-center item-wishlist py-5 trbody-css">
                                <td>{{ $loop->iteration }}</td>
                                <td class="w-full flex justify-center items-center"><img
                                        src="{{ asset('images/productimg_rbg/' . $w->product->product_img) }}"
                                        class="img-wishlist"></td>
                                <td>
                                    <div class="pro_namew">{{ $w->product->product_name }}</div>
                                </td>
                                <td>
                                    <div class="pro_pricew">${{ $w->product->regular_price }} to
                                        ${{ $w->product->sale_price }}</div>
                                </td>
                                <td>
                                    <form action="{{ route('wishlist.remove', ['id' => $w->product->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </td>
                            <tr>
                        @endforeach
                    </tbody>

                    {{-- <form action="{{ route('wishlist.remove', $wishlist->product->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Xóa</button>
                    </form> --}}
                </table>

            </div>
        @endif
    </div>
@endsection
