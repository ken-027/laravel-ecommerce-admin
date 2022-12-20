<h2>{{$title}}</h2>
<table>
    <caption>Filtered By: {{$datefrom}} to {{$dateto}}</caption>
    <thead>
      <tr>
        <th><strong>Order ID</strong></th>
        <th><strong>Customer</strong></th>
        <th><strong>Date</strong></th>
        <th><strong>Approved Date</strong></th>
        <th><strong>Price</strong></th>
        <th><strong>Payment Method</strong></th>
        <th><strong>Status</strong></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{$order->order_id}}</td>
                <td>{{"$order->first_name $order->last_name"}}</td>
                <td>{{$order->date}}</td>
                <td>{{$order->approved_date}}</td>
                <td>{{amount_format($order->total_orders)}}</td>
                <td>{{$order->type}}</td>
                <td>{{$order->status}}</td>
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