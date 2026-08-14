@extends('layouts.app')

@section('content')
    <div class="w-full flex flex-col justify-center items-center">
        <div class="w-process flex flex-col justify-center items-center p-10">
            <div class="w-full flex justify-between items-end">
                <div class="text-process">Your Cart</div>
                <div class="text-process">Check To Pay</div>
                <div class="text-process">Finish Order</div>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mt-2 shadow-sm">
                <div class="color-process h-2.5 rounded-full" style="width: 50%"></div>
            </div>
        </div>
        <div class="w-full flex justify-center items-center py-5">
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
                    @foreach ($cartFormatted as $index => $w)
                        <tr class="item-center item-wishlist py-5 trbody-css">
                            <td>{{ $loop->iteration }}</td>

                            <!-- Cột Ảnh -->
                            <td class="w-full flex justify-center items-center">
                                <img src="{{ asset('images/productimg_rbg/' . $w['img']) }}" class="img-wishlist">
                            </td>


                            <!-- Cột Tên Sản Phẩm -->
                            <td>
                                <div class="pro_namew">{{ $w['name'] }}</div>
                            </td>

                            <!-- Cột Giá -->
                            <td>
                                <div class="pro_pricew">
                                    ${{ $w['price'] }}
                                </div>
                            </td>

                            <!-- Cột Số Lượng -->
                            <td>
                                <div class="pro_quantity">{{ $w['quantity'] }}</div>
                            </td>

                            <!-- Cột Tổng Giá -->
                            <td>
                                <div class="pro_totalprice">
                                    ${{ number_format($w['quantity'] * $w['price'], 2) }}
                                </div>
                            </td>

                            <!-- Cột Xóa Sản Phẩm -->
                            {{-- <td>
                        <form action="{{ route('cart.remove', ['id' => $w->product_id]) }}" method="POST"
                            class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete"><i
                                    class="fa-solid fa-trash-can text-red-500"></i></button>
                        </form>
                    </td> --}}
                        </tr>
                    @endforeach

                </tbody>
            </table>
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

        <div class="w-full flex flex-col justify-center item-center item-wishlist py-5">
            <div>Please input your exactly imformation</div>
            <div class="w-full flex justify-center item-center">
                <div class="w-50 flex flex-col justify-between items-center  me-10">
                    <div class="w-full flex flex-col justify-center items-start my-3">
                        <div>First Name <span class="force">*</span></div>
                        <div><input type="text" class="input-address" /></div>
                    </div>
                    <div class="w-full flex flex-col justify-center items-start my-3">
                        <div>First Name <span class="force">*</span></div>
                        <div><input type="text" class="input-address" /></div>
                    </div>
                    <div class="w-full flex flex-col justify-center items-start my-3">
                        <div>First Name <span class="force">*</span></div>
                        <div><input type="text" class="input-address" /></div>
                    </div>
                </div>
                <div class="w-50">
                    <div class="w-full flex flex-col justify-center items-start my-3">
                        <div>First Name <span class="force">*</span></div>
                        <div><input type="text" class="input-address" /></div>
                    </div>
                    <div class="w-full flex flex-col justify-center items-start my-3">
                        <div>First Name <span class="force">*</span></div>
                        <div><input type="text" class="input-address" /></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full flex flex-col justify-center item-center item-wishlist py-5">
            <div>Choose a payment</div>
            <div class="w-full flex justify-center items-start my-3">
                <div class="me-20"><input type="radio" />COD</div>
                <div><input type="radio" />Paypal</div>
            </div>
        </div>
        <div class="w-full  flex justify-center item-center item-wishlist py-5">
            <button type="submit" class="btn-check-pay">Finish Order</button>
        </div>
    </div>
@endsection
