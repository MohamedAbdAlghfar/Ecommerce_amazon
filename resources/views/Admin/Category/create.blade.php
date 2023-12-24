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


 



	<title>Add category</title>
	<link rel="stylesheet" href="style.css">
</head>
<body bgcolor = "#008374">
	<h1>Add category</h1>
	<form method="post" action="{{ route('category.store') }}" enctype="multipart/form-data" autocomplete="off" >
    @csrf
		<label for="name">Category Name:</label>
		<input type="text" id="name" name="name" required>
		        
        <div class="form-group{{ $errors->has('Category_id') ? ' has-danger' : '' }}">
    <label class="form-control-label" for="input-Category_id">{{ __('Parent Title') }}</label>
    
    <select id="category-select" name="parent_id"  class="form-control">
    <option value="0">Null</option>
    @foreach($category as $Category)
        <option value="{{ $Category->id }}">{{ $Category->name }}</option>
    @endforeach
</select>

    @if ($errors->has('Category_id'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('Category_id') }}</strong>
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





