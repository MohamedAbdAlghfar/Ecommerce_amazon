<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">

.recent-sold {
  margin-top: 20px;
}

.recent-sold h2 {
  font-size: 24px;
  margin-bottom: 10px;
}

.sold-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.sold-item {
  border: 3px solid #ccc;
  padding: 10px;
}

.sold-item img {
  width: 40%;
  margin-bottom: 10px;
}

.sold-item h3 {
  font-size: 18px;
  margin-bottom: 5px;
}

.sold-date {
  font-style: italic;
  font-size: 14px;
  margin-bottom: 5px;
}

.sold-price {
  font-weight: bold;
  font-size: 16px;
  color: black;
}

.fixed-size-img {
  width: 100px;
  height: 100px;
}
   
.back-button {
  background-color: red;
  color: white;
  border: 1px solid black;
  padding: 5px 10px;
  font-size: 16px;
  text-decoration: none;
  cursor: pointer;
}
   </style>
  </head>


<body bgcolor = "#008374">

<div class="recent-sold">
  <h2>Recent Sold Items</h2>
  <div class="sold-grid">
  @foreach ($request as $request) 
  <div class="sold-item">
 <div class="fixed-size-img">
 @if ($request->Product->Photos->isNotEmpty())
    <img src="{{ $request->Product->Photos->first()->filename }}">
@else
    <p> NO IMAGE FOUND </p>
@endif

</div> 
  <h3>{{ $request->Product->name }}</h3>
      <p class="sold-date"><font color="black"><b>Sold on </b></font> :: {{ $request->created_at }}</p>
      <p class="sold-price">$ {{ $request->price }}</p>
      <p class="sold-price"><font color="black">THE BUYER :: </font> {{ $request->User->f_name }}</p>
      <p class="sold-price"><font color="black">LOCATION OF ORDER </font> ::{{ $request->location }} </p>
      <p class="sold-price"><font color="black">OTHER AVAILABLE PIECES </font> ::{{ $request->Product->available_pieces }} </p>
@if($request->ShippingCompany)
    <p class="sold-price"><font color="black">THE SHIPPING_COM NAME </font> ::{{ $request->ShippingCompany->name }}</p>
@else
    <p class="sold-price"><font color="black">No Shipping Company</font></p>
@endif
<p class="sold-price"><font color="black">TRANS_DATE </font> ::{{ $request->trans_date }} </p>
    </div>
@endforeach
</div>
</div>
</div>
<br>
<a href="{{ route('admin.index') }}" class="back-button">Back</a>
</body>







</html>