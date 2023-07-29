<!DOCTYPE html>
<html>
<head>
<style type="text/css">
form {
	max-width: 500px;
	margin: 0 auto;
}

label {
	display: block;
	margin-bottom: 5px;
}

input[type="text"], input[type="number"], textarea {
	width: 100%;
	padding: 10px;
	margin-bottom: 20px;
	border-radius: 5px;
	border: 1px solid #ddd;
}

button[type="submit"] {
	display: block;
	margin: 20px auto 0;
	padding: 10px 20px;
	background-color: #4CAF50;
	color: #fff;
	border-radius: 5px;
	border: none;
	cursor: pointer;
}

button[type="submit"]:hover {
	background-color: #3e8e41;
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


 



	<title>Add Product</title>
	<link rel="stylesheet" href="style.css">
</head>
<body bgcolor = "#008374">
	<h1>Add Product</h1>
	<form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data" autocomplete="off" >
    @csrf
		<label for="name">Product Name:</label>
		<input type="text" id="name" name="name" required>
		
        <label for="N_Of_Pices">N_Of_Pices:</label>
		<input type="number" id="N_Of_Pices" name="available_pieces" required>

		<label for="price">Price:</label>
		<input type="number" id="price" name="price" required>
        
        <label for="Brand">Brand:</label>
		<input type="text" id="Brand" name="brand" required>

        <label for="color">Color:</label>
		<input type="text" id="color" name="color" required>
        
        <label for="Weight">Weight:</label>
		<input type="number" id="Weight" name="weight" required>        
		
        <label for="description">Description:</label>
		<textarea id="description" name="description"></textarea>
        
        <label for="About">About:</label>
		<textarea id="About" name="about"></textarea>
        
        <div class="form-group{{ $errors->has('Category_id') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input-Category_id">{{ __('Parent Title') }}</label>
    
    <select id="category-select" name="parent_id" required class="form-control">
    <option value="0">Null</option>
    @foreach(\App\Models\Category::orderBy('id', 'desc')->get() as $Category)
        <option value="{{ $Category->id }}">{{ $Category->name }}</option>
    @endforeach
</select>

    @if ($errors->has('Category_id'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('Category_id') }}</strong>
        </span>
    @endif
</div>


<div class="form-group{{ $errors->has('Store_id') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input-Store_id">{{ __('Store Title') }}</label>
<select id="category-select" name="store_id" required class="form-control">
    <option value="0">Null</option>
    @foreach(\App\Models\Store::orderBy('id', 'desc')->get() as $Store)
        <option value="{{ $Store->id }}">{{ $Store->name }}</option>
    @endforeach
</select>
@if ($errors->has('Store_id'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('Store_id') }}</strong>
        </span>
    @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#category-select').select2();
    });
</script>
        <label for="col_1">Aditional_info:</label>
		<input type="text" id="col_1" name="col_1" >
        
        <label for="col_2">Aditional_info:</label>
		<input type="text" id="col_2" name="col_2" >
        
        <label for="col_3">Aditional_info:</label>
		<input type="text" id="col_3" name="col_3" >
        
        <label for="col_4">Aditional_info:</label>
		<input type="text" id="col_4" name="col_4" >

        <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-image">{{ __('Image') }}</label>
                                    <input type="file" name="image" id="input-image" class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}" required>
                                    
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>

		<button type="submit" id="submit">SAVE</button>
        <a href="{{ route('admin.index') }}" class="back-button">Back</a>
    </form>
    

	<script src="script.js"></script>
</body>
</html>