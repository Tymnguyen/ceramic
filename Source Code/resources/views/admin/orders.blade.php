@extends('layout.adminlayout')

@section('mainbody')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="mb-3 ml-2">
        <button type="button" class="btn rounded-pill btn-dark" onclick="createRole();">Create New Role</button>
    </div>
    <div class="card">
        <h5 class="card-header">ORDER LIST</h5>
        <hr class="my-0"></br>
        <div class="table-responsive text-nowrap" style="min-height: 350px; padding:10px;">
            <table class="table table-sm table-hover" id="dataTable">
                <thead>
                    <tr>
                        <th></th>
                        <th>Transaction ID</th>
                        <th>Date</th>
                        <th>Buyer Name</th>
                        <th>Reciever</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($orders as $order)
                    <tr id="tablerow_{{$order->id}}">
                        <td>
                            <a class="btn btn-icon btn-outline-secondary" href="{{url('/admin/order/orderdetails')}}/{{$order->id}}">
                                <span class="tf-icons bx bx-list-ol"></span>
                            </a>
                        </td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$order->transactionid}}</strong></td>
                        <td>{{$order->createdat}}</td>
                        <td>{{ $order->buyer ? $order->buyer->fullname : 'Guest' }}</td>
                        <td>{{$order->fullname}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->email}}</td>
                        <td>$ {{$order->grandtotalamount}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#menu_order').addClass('active');
        $('#dataTable').DataTable({
            "pageLength": 10,
            "bLengthChange": false,
            "bFilter": true,
            "bInfo": false,
            "bAutoWidth": false
        });
    });
</script>

@endsection