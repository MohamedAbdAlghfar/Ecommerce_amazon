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
<div align = "center">
<h2> {{ $data['shipping']->name }} </h2>
</div>


<div class="recent-sold">
@if($data['shipping']->cover_image)
<img src="/images/{{$data['shipping']->cover_image}}"width = 200px hight = 200px>
@endif
  <br><br>
  <div class="sold-grid">
  @foreach ($data['order'] as $Order) 
  
  <div class="sold-item">
 <div class="fixed-size-img">
 

</div> 
  
<p class="sold-date"><font color="black"><b>Request on </b></font> :: {{ $Order->created_at }}</p>
      <p class="sold-price">$ {{ $Order->price }}</p>
      <p class="sold-price"><font color="black">Product name :: </font> {{ $Order->product_name }}</p>
      <p class="sold-price"><font color="black">From Store :: </font> {{ $Order->store_name }}</p>
      <p class="sold-price"><font color="black">THE BUYER :: </font> {{ $Order->user_name }}</p>
      <p class="sold-price"><font color="black">LOCATION OF ORDER </font> ::{{ $Order->location }} </p>
      <p class="sold-price"><font color="black"> Tras_date </font> ::{{ $Order->trans_date }} </p>
      <form method="POST" action="{{ route('UpdateStatus.change', $Order) }}"> 
    @csrf
    @method('put')
    <button type="submit" class="back-button">Accept</button>
</form>
    </div>
    
@endforeach
</div>
</div>
</div>
<br>

<a href="{{ route('Shipping.index') }}" class="back-button">Back</a>
</body>







</html>




