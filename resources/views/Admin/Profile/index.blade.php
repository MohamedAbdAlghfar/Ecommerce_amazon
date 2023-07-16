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
            <td align = "center">{{ $admin->F_Name }}</td>
            <td align = "center">{{ $admin->L_Name }}</td>
            <td align = "center">{{ $admin->Email }}</td>
            <td align = "center">{{ $admin->Phone }}</td>
        </tr>        
        @endforeach
    </tbody>
</table>
<br>
<div align = "center"><a href="{{ route('admin.index') }}" class="back-button">Back</a></div>
</body>
</html>









