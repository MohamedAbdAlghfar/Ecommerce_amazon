<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>My Profile</title>
    <link rel="stylesheet" href="style.css">
    <style type="text/css">  
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

.profile {
  display: flex;
         }

.avatar {
  margin-right: 20px;
}

.avatar img {
  width: 300px;
  height: 300px;
  border-radius: 50%;
  object-fit: cover;
}

.info h1 {
  margin-top: 0;
}

.info h2 {
  margin-top: 0;
  font-weight: normal;
}

.info ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.info ul li {
  margin-bottom: 10px;
}

.info ul li strong {
  display: inline-block;
  width: 100px;
}
label, input[type="text"] {
  font-size: 24px;
  height: 40px;
}
label, input[type="number"] {
  font-size: 24px;
  height: 40px;
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

</head>
  <body bgcolor = "#008374">
    <div class="container">
      <div class="profile"> 
        <div class="avatar">
        @if ($shipping->filename)
    <img src="/images/{{ $shipping->filename }}"width = 200px hight = 200px>
        @else
                                
    <img src="/images/default.jpeg" class="card-img-top" alt="Default Product Photo"width = 200px hight = 200px>
        @endif
            
        <div class="info">
         <br><br><br><br><br><br><br><br> 
        <form method="post" action="{{ route('Shipping.update', $shipping) }}" enctype="multipart/form-data" autocomplete="off" >
          @csrf
          @method('put')
          <label for="name">Name:</label>
		<input type="text" id="name" name="name" required value= "{{ $shipping->name }}">
        <br><br><br><br>
        <label for="phone">Phone:</label>
		<input type="text" id="phone" name="phone" required value= "{{ $shipping->phone }}">
        <br><br><br><br>
       
        <label for="email">Email:</label>
		<input type="text" id="email" name="email" required value= "{{ $shipping->email }}">

        <br><br><br><br>
        <label for="website">Website:</label>
		<input type="text" id="website" name="website" required  value= "{{ $shipping->website }}">
        
        <br><br><br><br>
        <label for="location">Location:</label>
		<input type="text" id="location" name="location" required value= "{{ $shipping->location }}">

        <br><br><br><br>
        <label for="address">address:</label>
		<input type="text" id="address" name="address" required value= "{{ $shipping->address }}">

        <br><br><br><br>
        <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-image">{{ __('change your picture') }}</label>
                                    <input type="file" name="image" id="input-image" class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}" >
                                    
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
    
        <button type="submit" id="submit">SAVE</button>
        <a href="{{ route('Shipping.index') }}" class="back-button">Back</a>
    </form>

        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>







