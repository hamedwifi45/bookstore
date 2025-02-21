@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        عربةالتمشي
                    </div>
                    <div class="card-body">
                        @if ($items->count())
                            
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">العنوان</th>
                                <th scope="col">السعر</th>
                                <th scope="col">الكمية</th>
                                <th scope="col">السعر الكلي</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        @php($totalPrice = 0)
                        @foreach($items as $item)
                            @php($totalPrice += $item->price * $item->pivot->number_of_copy)

                            <tbody>
                                <tr>
                                    <th scope="row">{{ $item->title }}</th>
                                    <td>{{ $item->price }} $</td>
                                    <td>{{ $item->pivot->number_of_copy }}</td>
                                    <td>{{ $item->price * $item->pivot->number_of_copy }} $</td>
                                    <td>
                                        <form style="float:left; margin: auto 5px" method="post" action="{{ route('cart.remove_all', $item->id) }}">
                                            @csrf
                                            <button class="btn btn-outline-danger btn-sm" type="submit">أزل الكل</button>
                                        </form>

                                        <form style="float:left; margin: auto 5px" method="post" action="{{ route('cart.remove_one', $item->id) }}">
                                            @csrf
                                            <button class="btn btn-outline-warning btn-sm" type="submit">أزل واحدًا</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                    </table>

                    <h4 class="mb-5">المجموع النهائي: {{ $totalPrice }} $</h4>

                    <!-- Set up a container element for the button -->
                    <div id="paypal-button-container"></div>
                    <a href="{{-- route('credit.checkout')--}}" class="d-inline-block mb-4 float-start btn bg-cart" style="text-decoration:none;">
                        <span>بطاقة ائتمانية</span>
                        <i class="fas fa-credit-card"></i>
                    </a>
                    <p id="result-message"></p>
                    

                        @else
                        <div class="alert alert-info text-center">
                            الكعكة الكاذبة
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
<script
            src="https://www.paypal.com/sdk/js?client-id=test&buyer-country=US&currency=USD&components=buttons&enable-funding=venmo,paylater,card"
            data-sdk-integration-source="developer-studio"
        ></script>
<script>
    window.paypal
    .Buttons({
        style: {
            shape: "rect",
            layout: "vertical",
            color: "gold",
            label: "paypal",
        },
        message: {
            amount: 100,
        } ,

        async createOrder() {
            try {
                const response = await fetch("/api/orders", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    // use the "body" param to optionally pass additional order information
                    // like product ids and quantities
                    body: JSON.stringify({
                        cart: [
                            {
                                id: "YOUR_PRODUCT_ID",
                                quantity: "YOUR_PRODUCT_QUANTITY",
                            },
                        ],
                    }),
                });

                const orderData = await response.json();

                if (orderData.id) {
                    return orderData.id;
                }
                const errorDetail = orderData?.details?.[0];
                const errorMessage = errorDetail
                    ? `${errorDetail.issue} ${errorDetail.description} (${orderData.debug_id})`
                    : JSON.stringify(orderData);

                throw new Error(errorMessage);
            } catch (error) {
                console.error(error);
                // resultMessage(`Could not initiate PayPal Checkout...<br><br>${error}`);
            }
        } ,

        async onApprove(data, actions) {
            try {
                const response = await fetch(
                    `/api/orders/${data.orderID}/capture`,
                    {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                    }
                );

                const orderData = await response.json();
                // Three cases to handle:
                //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                //   (2) Other non-recoverable errors -> Show a failure message
                //   (3) Successful transaction -> Show confirmation or thank you message

                const errorDetail = orderData?.details?.[0];

                if (errorDetail?.issue === "INSTRUMENT_DECLINED") {
                    // (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                    // recoverable state, per
                    // https://developer.paypal.com/docs/checkout/standard/customize/handle-funding-failures/
                    return actions.restart();
                } else if (errorDetail) {
                    // (2) Other non-recoverable errors -> Show a failure message
                    throw new Error(
                        `${errorDetail.description} (${orderData.debug_id})`
                    );
                } else if (!orderData.purchase_units) {
                    throw new Error(JSON.stringify(orderData));
                } else {
                    // (3) Successful transaction -> Show confirmation or thank you message
                    // Or go to another URL:  actions.redirect('thank_you.html');
                    const transaction =
                        orderData?.purchase_units?.[0]?.payments
                            ?.captures?.[0] ||
                        orderData?.purchase_units?.[0]?.payments
                            ?.authorizations?.[0];
                    resultMessage(
                        `Transaction ${transaction.status}: ${transaction.id}<br>
          <br>See console for all available details`
                    );
                    console.log(
                        "Capture result",
                        orderData,
                        JSON.stringify(orderData, null, 2)
                    );
                }
            } catch (error) {
                console.error(error);
                resultMessage(
                    `Sorry, your transaction could not be processed...<br><br>${error}`
                );
            }
        } ,
    })
    .render("#paypal-button-container"); 
</script>
@endsection
{{-- المشروع من ناحية الدفع غير منتهي وذلك بسبب العقوبات الاقتصادية اتمنى من نفسي المستقبلي ان يكمل المشروع على اكمل وجه --}}