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
                            <h3 class="mb-0">{{ __('Stores') }}</h3>
                        </div>
                    </div>
                </div>
                @foreach($store as $store)
                <div class="row">
                @if ($store->store_image)
    <img src="/images/{{ $store->store_image }}"width = 200px hight = 200px>
                @else
                                
                                    <img src="/images/default.jpeg" class="card-img-top" alt="Default Product Photo"width = 200px hight = 200px>
                                @endif
                                
                            
                <div class="row">
                @if ($store->store_cover)
    <img src="/images/{{ $store->store_cover }}">
                @else
                                
                                    <img src="/images/default.jpeg" class="card-img-top" alt="Default Product Photo">
                                @endif
                                
                                
                                
                                <div class="card-body">
                                    <h5 class="card-title">{{ \Str::limit($store->name, 100) }}</h5>
                                </div>
                            </div>
                        </div>
                        
                       
                        <form  method="POST" action="{{ route('store.destroy', $store) }}"> 
                                        
                                        @csrf
                                        @method('DELETE')
                                      

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



