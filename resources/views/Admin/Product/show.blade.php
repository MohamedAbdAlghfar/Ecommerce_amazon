<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
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
<body>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">{{ __('Products') }}</h3>
                        </div>
                    </div>
                </div>
                @foreach($product as $product)
                <div class="row">
                @if ($product->Photos->isNotEmpty())
    <img src="/images/{{ $product->Photos->first()->filename }}">
                @else
                                
                                    <img src="/images/default.jpeg" class="card-img-top" alt="Default Product Photo">
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ \Str::limit($product->name, 100) }}</h5>
                                </div>
                            </div>
                        </div>
                        
                       
                        <form  method="POST" action="{{ route('product.destroy', $product) }}">
                                        
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('product.edit', $product) }}" class="back-button">Edit</a>
                                        

                                        <input class="btn btn-danger btn-sm" type="submit" value="Delete" name="deletecourse">
                                    </form>
                    @endforeach
                </div>
                
                <div class="card-footer py-4">
                    <nav class="d-flex justify-content-end" aria-label="...">
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div><br><br>
<a href="{{ route('admin.index') }}" class="back-button">Back</a>
</body>
</html>