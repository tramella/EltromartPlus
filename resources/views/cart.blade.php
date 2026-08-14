@extends('layouts.app')
@php
    $total = 0; // Khởi tạo biến tổng tiền
@endphp
@section('content')
    <div class="w-full p-5 flex flex-col justify-center items-center">
        <div class="title-cart  my-5">Your Cart</div>
        @if ($message)
            <div class="w-full flex flex-col justify-center items-center">
                <div class="w-message-cart">
                    <div class="w-full flex justify-center items-center">
                        <i class="fa-solid fa-circle-info icon-infocart"></i>
                        <p class="text-center">Please, hurry! The product is being sold at a shocking promotional price!</p>
                    </div>

                </div>
                <div class="info-cart">{{ $message }}</div>
                <a href="{{ route('main') }}" class="btn-shoppping">Continue Shopping</a>
            </div>
        @else
            <table class="w-wishlist">
                <thead class="thead-css">
                    <tr class="item-center py-2">
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $index => $w)
                        @php
                            $productPrice = $w->product->sale_price ?? $w->product->regular_price;
                            $itemTotal = $w->quantity * $productPrice;
                            $total += $itemTotal;
                        @endphp
                        <tr class="item-center item-wishlist py-5 trbody-css">
                            <td>{{ $loop->iteration }}</td>

                            <!-- Cột Ảnh -->
                            <td class="w-full flex justify-center items-center">
                                <img src="{{ asset('images/productimg_rbg/' . $w->product->product_img) }}"
                                    class="img-wishlist">
                            </td>

                            <!-- Cột Tên Sản Phẩm -->
                            <td>
                                <div class="pro_namew">{{ $w->product->product_name }}</div>
                            </td>

                            <!-- Cột Giá -->
                            <td>
                                <div class="pro_pricew">
                                    ${{ $w->product->sale_price ?? $w->product->regular_price }}
                                </div>
                            </td>

                            <!-- Cột Số Lượng -->
                            <td>
                                <div class="pro_quantity">{{ $w->quantity }}</div>
                            </td>

                            <!-- Cột Tổng Giá -->
                            <td>
                                <div class="pro_totalprice">
                                    ${{ number_format($w->quantity * ($w->product->sale_price ?? $w->product->regular_price), 2) }}
                                </div>
                            </td>

                            <!-- Cột Xóa Sản Phẩm -->
                            <td>
                                <form action="{{ route('cart.remove', ['id' => $w->product_id]) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete"><i
                                            class="fa-solid fa-trash-can text-red-500"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="w-full  flex justify-center item-center item-wishlist py-5 mt-3">
                <input type="text" class="input-coupon" placeholder="Your coupon" />
                <div class="btn-add-coupon">Apply</div>
            </div>
            <div class="w-full  flex justify-center item-center item-wishlist py-5">
                <div class="w-total-cart flex flex-col justify-center items-center">
                    <div class="w-full flex  justify-between items-center">
                        <div class="w-left text-right font-bold">Sub Total</div>
                        <div class=" w-right font-bold text-green-600">
                            ${{ number_format($total, 2) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full  flex justify-center item-center item-wishlist py-5">
                <form action="{{ route('checktopay') }}" method="POST">
                    @csrf
                    @foreach ($cartItems as $w)
                        <input type="hidden" name="cart[{{ $w->product_id }}][img]"
                            value="{{ $w->product->product_img }}">
                        <input type="hidden" name="cart[{{ $w->product_id }}][name]"
                            value="{{ $w->product->product_name }}">
                        <input type="hidden" name="cart[{{ $w->product_id }}][quantity]" value="{{ $w->quantity }}">
                        <input type="hidden" name="cart[{{ $w->product_id }}][price]"
                            value="{{ $w->product->sale_price ?? $w->product->regular_price }}">
                    @endforeach
                    <input type="hidden" name="total" value="{{ $total }}">

                    <button type="submit" class="btn-check-pay">Check to pay</button>
                </form>
                {{-- <a href="{{ route('checktopay', ['cart'=>$cartItems, 'total'=>$total]) }}" class="btn-check-pay">Check to pay</a> --}}
            </div>
        @endif
    </div>
@endsection
{{-- @section('scripts') --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let deleteBtns = document.querySelectorAll(".btn-delete");

        deleteBtns.forEach(btn => {
            btn.addEventListener("click", function(event) {
                event.preventDefault(); // Ngăn form submit ngay lập tức

                let form = this.closest(".delete-form");

                Swal.fire({
                    title: "Are you sure to delete?",
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Delete!",
                    cancelButtonText: "Cancel"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
{{-- @endsection --}}
