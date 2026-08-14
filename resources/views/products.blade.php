@extends('layouts.app')

@section('content')
    <div class="w-full flex justify-between">
        <div class="sort-by flex flex-col justify-start p-5">
            <div class="title-sort">Sort By:</div>
            <div class="flex pt-5">
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}"
                    class="item-sort flex justify-center items-center me-3">
                    <img src="{{ asset('images/Increase.png') }}" class="img-sort" />
                    <div class="text-sort">Low Price - High</div>
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}"
                    class="item-sort flex justify-center items-center me-3">
                    <img src="{{ asset('images/Increase.png') }}" class="img-sort" />
                    <div class="text-sort">High Price - Low</div>
                </a>
                <a href="{{ request()->fullUrlWithQuery(['sort' => 'discount']) }}"
                    class="item-sort flex justify-center items-center">
                    <img src="{{ asset('images/Percentage.png') }}" class="img-sort" />
                    <div class="text-sort">Hot Discounts</div>
                </a>
            </div>
        </div>
        <div class="filter flex p-5 mx-20">
            <div class="item-filter flex justify-center items-center">
                <img src="{{ asset('images/Filter.png') }}" class="img-sort" />
                <div class="text-sort">Filters</div>
            </div>
        </div>
    </div>
    <div class="w-full flex flex-wrap justify-center items-center mb-5 mt-2">
        @foreach ($products as $t)
            <div class="item-a1 mx-3">
                <div class="mt-5 me-3">

                    <div class=" flex flex-col justify-center items-center item-products">
                        <div class="overplay1">
                            <a href="{{ route('product.detail', ['id' => $t->id]) }}" class="btn-buy2">View
                                Details</a>
                            <a href="#" class="btn-buy1 mt-2">Add to Cart</a>

                        </div>
                        <img src="{{ asset('images/productimg_rbg/' . $t->product_img) }}" alt="sp1"
                            class="img-product" />
                        <div class="text-start font-medium mt-5">
                            <p class="text-start name-product">{{ $t->product_name }}</p>
                            <p class="mt-5 text-sm text-center"><span class="regular-price">
                                    @if ($t->sale_price == null)
                                        <strong class="text-price">${{ $t->regular_price }}</strong>
                                    @else
                                        <s class="reg_price font-normal">${{ $t->regular_price }}</s> to
                                </span><strong class="text-price">${{ $t->sale_price }}</strong>
        @endif

        </p>
    </div>

    </div>
    </div>
    </div>
    @endforeach
    </div>
    <div class="w-full flex justify-center items-center">
        {{ $products->links('vendor.pagination.default') }}

    </div>
@endsection
