<h2>{{$title}}</h2>
<table width="100%">
    <caption>Category Filtered: {{ $category }}</caption>
    <caption>Brand Filtered: {{ $brand }}</caption>
    <caption>Device Filtered: {{ $device }}</caption>
    <thead>
      <tr>
        <th><strong>Model ID</strong></th>
        <th><strong>Brand</strong></th>
        <th><strong>Title</strong></th>
        <th><strong>Device</strong></th>
        <th><strong>Order</strong></th>
        <th><strong>Price</strong></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($models as $model)
            <tr>
                <td>{{$model->id}}</td>
                <td>{{$model->brand}}</td>
                <td>{{$model->title}}</td>
                <td>{{$model->device}}</td>
                <td>{{intval($model->ordering)}}</td>
                <td>{{amount_format($model->price)}}</td>
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