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

@if($shipping->Orders)
<div align = "center">
<h2>{{ $shipping->name }}</h2>
  
  @if ($shipping->cover_image)
    <img src="{{ $shipping->cover_image }}"width = 400px hight = 200px align = "center">
  @else
    <p> NO IMAGE FOUND </p>
  @endif
</div>
  <br><br>
  <div class="sold-grid">
  @foreach ($shipping->Orders as $Order) 
  @if($Order->trans_date > now()->toDateString())
  <div class="sold-item">
 <div class="fixed-size-img">
 

</div> 
  
<p class="sold-date"><font color="black"><b>Request on </b></font> :: {{ $Order->created_at }}</p>
      <p class="sold-price">$ {{ $Order->price }}</p>
      <p class="sold-price"><font color="black">Product name :: </font> {{ $Order->Product->name }}</p>
      <p class="sold-price"><font color="black">From Store :: </font> {{ $Order->Product->Store->name }}</p>
      <p class="sold-price"><font color="black">THE BUYER :: </font> {{ $Order->User->f_name }}</p>
      <p class="sold-price"><font color="black">LOCATION OF ORDER </font> ::{{ $Order->location }} </p>
      <p class="sold-price"><font color="black"> Tras_date </font> ::{{ $Order->trans_date }} </p>
      <a href="{{ route('UpdateStatus.change', $Order) }}" class="back-button">Accept</a>
    </div>
    @endif
@endforeach
</div>
</div>
</div>
<br>
@else
<h2> No Orders </h2>
@endif
<a href="{{ route('Shipping.index') }}" class="back-button">Back</a>
</body>







</html>




