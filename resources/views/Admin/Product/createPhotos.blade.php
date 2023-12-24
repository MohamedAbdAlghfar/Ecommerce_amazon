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
<h1>Add Product Photos</h1> 
	<form method="post" action="{{ route('ShowProductPhotos.store', $product) }}" enctype="multipart/form-data" autocomplete="off" >
    @csrf
    <label>Images:</label>
    <input type="file" name="images[]" multiple accept="image/*">


		<button type="submit" id="submit">SAVE</button>
       <br><br>
        <a href="{{ route('admin.index') }}" class="back-button">Back</a>
    </form>











