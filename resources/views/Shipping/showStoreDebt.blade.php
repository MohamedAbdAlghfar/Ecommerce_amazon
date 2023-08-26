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
.back-button {
  background-color: black;
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
            <th>Store name</th>
            <th>Debt</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data['stores'] as $store)
        <tr>

            <td align = "center">{{ $store['store_name'] }}</td>
            <td align = "center">{{ $store['debt'] }}</td>
            <td align = "center">
                 <form action="{{ route('delShippingStoresDebt.DelStoreDebt', ['shipping_id' => $data['shipping_id'], 'store_id' => $store['store_id']]) }}" method="POST">
                      @csrf
                      @method('DELETE')

                             <!-- Add any additional form fields or content here -->

                     <button type="submit">Make Debt Zero</button>
                    </form> 
       </td>


        </tr>        
        @endforeach
    </tbody>
</table>
<br>
<div align = "center"><a href="{{ route('Shipping.index') }}" class="back-button">Back</a></div>
</body>
</html>



















