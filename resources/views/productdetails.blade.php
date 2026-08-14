@extends('layouts.app')

@section('content')
    <div class="w-full flex justify-center">
        <div class="w-productdetail m-3 p-3 flex">
            <div class="w-50">
                <img src="{{ asset('images/productimg_rbg/' . $product->product_img) }}" alt="{{ $product->product_name }}"
                    class="productimage" />
            </div>
            <div class="w-50 flex flex-col justify-center items-start ms-5">
                <div class="nameproduct">{{ $product->product_name }}</div>
                <div class="flex justify-center items-center mt-8 mb-3">
                    <span class="regular-price1">${{ $product->regular_price }}</span>
                    <span class="sale-price1 ms-5">${{ $product->sale_price }}</span>
                </div>
                <div class="flex my-3 w-full">
                    <div class=" w-50 flex flex-col justify-center items-start me-5">
                        <div class="title-quantity"> Quantity</div>
                        <div class="value-quantity flex items-center justify-center mt-2"
                            data-max="{{ $product->quantity }}">
                            <img src="{{ asset('images/Minus Sign.png') }}" class="icon-quantity minus" />
                            <input type="number" class="input-quantity mx-4" value="1" min="1"
                                id="quantity-selector" />
                            <img src="{{ asset('images/Plus.png') }}" class="icon-quantity plus" />
                        </div>
                    </div>
                    <div class="w-50 flex flex-col justify-center items-start ms-5">
                        <div class="title-quantity"> Color</div>
                        <div class="value-color  mt-2 flex justify-center items-center">

                            <input type="color" value="{{ $product->color->hex_code }}" class="input-color" />

                        </div>
                    </div>
                </div>
                <div class="flex mt-5 justify-center items-center">
                    <form action="{{ route('cart.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}" />
                        <input type="hidden" name="quantity" id="quantity-input" value="1" />

                        <button type="submit" class="btn-addcart flex justify-center items-center">
                            Add To Cart
                        </button>
                    </form>


                    <a href="{{ route('wishlist.add', ['id' => $product->id]) }}"
                        class="btn-wishlist flex justify-center items-center">
                        <img src="{{ asset('images/Favorite.png') }}" class="img-wishlist" />
                    </a>

                </div>
            </div>
        </div>
    @endsection
    {{-- @section('scripts') --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let quantityInput = document.getElementById("quantity-selector");
            let hiddenQuantityInput = document.getElementById("quantity-input");
            let minusButton = document.querySelector(".minus");
            let plusButton = document.querySelector(".plus");

            if (quantityInput && hiddenQuantityInput && minusButton && plusButton) {
                // Lấy max từ data-max
                let maxVal = parseInt(quantityInput.dataset.max) || 99;

                // Khi số lượng thay đổi, cập nhật giá trị trong hidden input
                quantityInput.addEventListener("change", function() {
                    let currentVal = parseInt(quantityInput.value);
                    if (currentVal < 1) {
                        quantityInput.value = 1;
                    } else if (currentVal > maxVal) {
                        quantityInput.value = maxVal;
                    }
                    hiddenQuantityInput.value = quantityInput.value;
                });

                // Xử lý nút -
                minusButton.addEventListener("click", function() {
                    let currentVal = parseInt(quantityInput.value);
                    if (currentVal > 1) {
                        quantityInput.value = currentVal - 1;
                        hiddenQuantityInput.value = quantityInput.value;
                    }
                });

                // Xử lý nút +
                plusButton.addEventListener("click", function() {
                    let currentVal = parseInt(quantityInput.value);
                    if (currentVal < maxVal) {
                        quantityInput.value = currentVal + 1;
                        hiddenQuantityInput.value = quantityInput.value;
                    }
                });
            }
        });
    </script>
    {{-- @endsection --}}
