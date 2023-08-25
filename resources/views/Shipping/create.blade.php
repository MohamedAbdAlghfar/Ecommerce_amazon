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


 



	<title>Add Shipping Combany</title>
	<link rel="stylesheet" href="style.css">
</head>
<body bgcolor = "#008374">
	<h1>Add Shipping Combany</h1>
	<form method="post" action="{{ route('CreateShipping.store') }}" enctype="multipart/form-data" autocomplete="off" >
    @csrf
		<label for="name">Shipping Name:</label>
		<input type="text" id="name" name="name" required>
		
        <label for="phone">Phone:</label>
		<input type="number" id="phone" name="phone" required>

		<label for="website">Link of website:</label>
		<input type="text" id="website" name="website" required>
        
        <label for="email">Email:</label>
		<input type="text" id="email" name="email" required>

        <label for="address">Address:</label>
		<input type="text" id="address" name="address" required>
        
        <label for="location">Location:</label>
		<input type="text" id="location" name="location" required>        

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
        <a href="{{ route('Shipping.index') }}" class="back-button">Back</a>
    </form>
    

	<script src="script.js"></script>
</body>
</html>













