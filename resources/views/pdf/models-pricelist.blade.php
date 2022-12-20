<h2>Pricelist for {{ $model_info->title }}</h2>
<table width="100%">
    <thead>
      <tr>
        <th><strong>Price ID</strong></th>
        <th><strong>Specs</strong></th>
        @foreach ($models_pricelist as $pricelist)           
            @foreach (json_decode($pricelist->price) as $name => $value)
                <th><strong>{{ $name }}</strong></th>
            @endforeach
            @break
        @endforeach
      </tr>
    </thead>
    <tbody>
        @foreach ($models_pricelist as $pricelist)           
            <tr>
            <td>{{$pricelist->id}}</td>
            <td>{{$pricelist->name}}</td>
            @foreach (json_decode($pricelist->price) as $key => $price)
                <td>{{amount_format($price)}}</td>
            @endforeach
            </tr>
        @endforeach
    </tbody>
</table>

<style>
  h2 {
    text-align: center;
  }
  * {
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
  }
  table caption {
    font-size: 20px;
    text-align: left;
    margin: 15px 10px;
  }
  table {
    widows: 100%;
    border-spacing: 0;
    border-collapse: collapse;
  }
  table th {
    background-color: #212529;
    color: white;
  }
  table td, table th {
    border: 1px solid rgb(43, 43, 43);
    padding: 4px;
  }
</style>

{{-- @php
    exit();
@endphp --}}