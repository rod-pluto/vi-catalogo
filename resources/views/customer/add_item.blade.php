<div class="text-center">
    <img src="{{ $product->image }}" alt="..." width="100%" height="200px">
    <h5 style="color:brown"><b><i>{{ $product->ean }}</i><b></h5>
    <h5>{{ $product->name }}</h5>
</div>

<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <input type="number" class="form-control" name="quantity" id="quantity" min="1" value="1">
        </div>
    </div>
    <div class="col-xs-6 col-sm-12 col-md-6">
        <button 
            class="btn btn-primary btn-block" 
            onclick="addItemToShoppingCart(parseInt({{ $product->id }}),'{{ $product->name }}', '{{ $product->description }}', parseInt($('#quantity').val()), {{ $product->price }}, '{{ $product->image }}')">
            Eu quero!
        </button>
    </div>
</div>
