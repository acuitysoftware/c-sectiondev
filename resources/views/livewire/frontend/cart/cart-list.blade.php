<section class="cart-section">
    <div class="container">
        
        <!--Cart Outer-->
        <div class="cart-outer">
            <div class="table-outer">
                <table class="cart-table">
                    <thead class="cart-header">
                        <tr>
                            <th class="prod-column">Product</th>
                            <th class="price">Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    	@if(count($carts)>0)
                    	@foreach($carts as $key=>$cart)
	                        <tr>
	                            <td class="prod-column">
	                                <div class="column-box">
	                                    <figure class="prod-thumb">
	                                    	<a href="#">
		                                    	@if(isset($cart->product->latestImage))
				                                    <img src="{{asset('storage/app/public/'.$cart->product->latestImage->image) }}" alt="Product">
				                                @else
				                                    <img src="{{asset('public/assets/images/no_image.png')}}" alt="Product">
				                                @endif
		                                    </a>
		                                </figure>
	                                    <h6 class="prod-title">{{$cart->product->name}}</h6>
	                                </div>
	                            </td>
	                            <td class="price">${{$cart->product->price}}</td>
	                            <td class="qty"><input class="quantity-spinner" type="text" wire:model="qty.{{$key}}" onchange="qtyChange({{$key}})" id="qty{{$key}}"></td>
	                            <td class="sub-total">${{$cart->total}}</td>
	                            <td class="remove"><a href="#" class="remove-btn"><span class="fa fa-times"></span></a></td>
	                        </tr>
                    	@endforeach
                    	@endif
                    	<input type="hidden" wire:model="arr_count">
                    </tbody>
                </table>
            </div>
            
<script type="text/javascript">
	function qtyChange(id) {
		var id = id;
		var new_value = $('#qty'+id).val();
		@this.set('arr_count', id);
		@this.set('qty', new_value);
	}
</script>


            <div class="row justify-content-between align-items-end flex-direction-column">


                <div class="col-xl-4 col-lg-4"></div>
                <div class="col-xl-3 col-lg-3"></div>
                <div class="col-xl-5 col-lg-5">

                    <!--Cart Total Box-->
                    <div class="cart-total-box">
                        <h4>Cart Totals</h4>
                        <!--Totals Table-->
                        <ul class="totals-table">
                            <li class="clearfix"><span class="col col-title">Subtotal</span><span class="col">$350.00</span></li>
                            <li class="clearfix"><span class="col col-title">Tax</span><span class="col">$15.00</span></li>
                            <li class="total clearfix"><span class="col col-title">Total .</span><span class="col">$365.00</span></li>
                        </ul>                        
                    </div>

                    <div class="twobtn justify-content-between align-items-center">
                        <div class="text-left"><button type="submit" class="theme-btn checkout-btn">continue shopping</button></div>
                        <div class="text-left"><button type="submit" class="theme-btn checkout-btn">Proceed to Checkout</button></div>
                    </div>

                </div>
            </div>
            
        </div>
        
    </div>
</section>