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
                            <h3 class="mb-0">{{ __('Photos') }}</h3>
                        </div>
                    </div>
                </div>
                <a href="{{ route('ShowProductPhotos.create', $product) }}" class="back-button">Add Photos</a>
              <br><br><br><br>
                @foreach ($product->photos as $photo)
    <img src="/images/{{  $photo->filename }}" alt="Photo" width="200px" hight="200px"/>

                       
                        <form  method="POST" action="{{ route('ShowProductPhotos.destroy', $photo) }}"> 
                                        
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('ShowProductPhotos.EditPhoto', $photo) }}" class="back-button">Edit</a>

                                        <input class="btn btn-danger btn-sm" type="submit" value="Delete" name="deleteproduct">
                            
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