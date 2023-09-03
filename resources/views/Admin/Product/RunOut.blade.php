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
  <h2>Products Run Out</h2>
  <div class="sold-grid">
  @foreach ($product as $product) 
  <div class="sold-item">
 <div class="fixed-size-img">
 @if ($product->filename)
    <img src="/images/{{ $product->filename }}"width = 200px hight = 200px> 
@else
    <p> NO IMAGE FOUND </p>
@endif

</div> 
  <h3>{{ $product->product_name }}</h3>
      <p class="sold-date"><font color="black"><b>Available pieces </b></font> :: {{ $product->available_pieces }}</p>
      <a href="{{ route('product.edit', $product) }}" class="back-button">Edit</a>
    </div> 
@endforeach
</div>
</div>
</div>
<br>
<a href="{{ route('admin.index') }}" class="back-button">Back</a>
</body>

</html>






                                                                                         






