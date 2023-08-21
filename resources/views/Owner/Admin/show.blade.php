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
            <th>F_Name</th>
            <th>L_Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($admins as $admin)
        <tr>
            <td align = "center">{{ $admin->id }}</td>
            <td align = "center">   
                        @if ($admin->profile_image)
                           <img src="/images/{{ $admin->profile_image }}" width = 200px hight = 200px>
                        @else
                            <img src="/images/default.jpeg" class="card-img-top" alt="Default Product Photo"width = 200px hight = 200px>
                        @endif
            </td>
            <td align = "center">{{ $admin->f_name }}</td>
            <td align = "center">{{ $admin->l_name }}</td>
            <td align = "center">{{ $admin->email }}</td>
            <td align = "center">{{ $admin->phone }}</td>
            <td align = "center">  

            <form  method="POST" action="{{ route('DeleteAdmin.destroy', $admin) }}"> 
                                        
                       @csrf
                      @method('DELETE')
                   <input class="btn btn-danger btn-sm" type="submit" value="Delete" name="deleteadmin">                            
            </form>


            </td>

        </tr>        
        @endforeach
    </tbody>
</table>
<br>
<div align = "center"><a href="{{ route('owner.index') }}" class="back-button">Back</a></div>
</body>
</html>









