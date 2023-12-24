<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    
    <link rel="stylesheet" href="style.css">
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

<img src="/images/{{  $photo->filename }}" alt="Photo" width="200px" hight="200px"/>
<br><br><br>
<form method="post" action="{{ route('ShowProductPhotos.updatePhoto', $photo) }}" enctype="multipart/form-data" autocomplete="off" >
          @csrf
          @method('put') 
<div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-image">{{ __('change picture') }}</label>
                                    <input type="file" name="image" id="input-image" class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}" >
                                    
                                    @if ($errors->has('image'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('image') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <button type="submit" id="submit">SAVE</button>
</form>
<br><br>
<a href="{{ route('admin.index') }}" class="back-button">Back</a>




