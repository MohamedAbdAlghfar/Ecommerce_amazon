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
  @foreach ($recentorder as $recentorder) 
  <div class="sold-item">
 <div class="fixed-size-img">
 @if ($recentorder->filename)
    <img src="{{ $recentorder->filename }}"width = 200px hight = 200px>
@else
    <p> NO IMAGE FOUND </p>
@endif

</div> 
  <h3>{{ $recentorder->product_name }}</h3>
      <p class="sold-date"><font color="black"><b>Sold on </b></font> :: {{ $recentorder->trans_date }}</p>
      <p class="sold-price">$ {{ $recentorder->price }}</p>
      <p class="sold-price"><font color="black">From Store :: </font> {{ $recentorder->store_name }}</p> 
      <p class="sold-price"><font color="black">THE BUYER :: </font> {{ $recentorder->user_name }}</p>
      <p class="sold-price"><font color="black">LOCATION OF ORDER </font> ::{{ $recentorder->location }} </p>
      <p class="sold-price"><font color="black">OTHER AVAILABLE PIECES </font> ::{{ $recentorder->available_pieces }} </p>
      @if($recentorder->shipping_com_name)
    <p class="sold-price"><font color="black">THE SHIPPING_COM NAME </font> ::{{ $recentorder->shipping_com_name }}</p>
@else
    <p class="sold-price"><font color="black">No Shipping Company</font></p>
@endif
    </div>
@endforeach
</div>
</div>
</div>
<br>
<a href="{{ route('admin.index') }}" class="back-button">Back</a>
</body>







</html>