<html lang="en">
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
<table width = 100% bgcolor = "#008374" cellspacing = "30px" height = 100% >
    <thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>website</th>
            <th>location</th>
            <th>address</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($shipping as $shipping)
        <tr>
            <td align = "center">{{ $shipping->id }}</td>
            <td align = "center">   
                        @if ($shipping->cover_image)
                           <img src="/images/{{ $shipping->cover_image }}" width = 200px hight = 200px>
                        @else
                            <img src="/images/default.jpeg" class="card-img-top" alt="Default Product Photo"width = 200px hight = 200px>
                        @endif
            </td>
            <td align = "center">{{ $shipping->name }}</td>
            <td align = "center">{{ $shipping->phone }}</td>
            <td align = "center">{{ $shipping->email }}</td>
            <td align = "center">{{ $shipping->website }}</td> 
            <td align = "center">{{ $shipping->location }}</td>
            <td align = "center">{{ $shipping->address }}</td>
            <td align = "center">  

            <form  method="POST" action="{{ route('DeleteShipping.destroy', $shipping) }}"> 
                                        
                                        @csrf
                                       @method('DELETE')
                                    <input class="btn btn-danger btn-sm" type="submit" value="Delete" name="DeleteShipping">                            
                                 
                                </form>
                                <a href="{{ route('Shipping.show', $shipping) }}" class="btn btn-info btn-sm">show</a>

            </td>

        </tr>        
        @endforeach
    </tbody>
</table>
<br>
<div align = "center"><a href="{{ route('owner.index') }}" class="back-button">Back</a></div>
</body>
</html>



















