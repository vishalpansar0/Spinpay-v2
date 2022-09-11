@extends('agent.agentLayouts.header')
@include('agent.agentLayouts.header')
@push('title')
    <title>Agent Dashboard</title>
@endpush

<div class="navbar fixed-top">
    <div class="main-logo-head">
        SpinPay
    </div>
    <div class="nav-menu">
        <a href="">{{
               Session::get('name')
            }}</a>&nbsp;&nbsp;&nbsp;
        <a href="{{url('agent/dashboard')}}">Dashboard </a>&nbsp;&nbsp;&nbsp;
        <a href=""> Logout</a>
    </div>
</div>
{{-- @php
    echo "<pre style='color:white'>";
    print_r($aadhar);
    echo '</pre>';
@endphp --}}
<div style="margin-top:70px">
    <div class="left-menu-div">
        <div class="menu-wrapper">

            <div class="menu-item-div ">
                <a href="{{url('userview')}}/{{$id}}"><button class="m-btn"><i class="fas fa-user"></i><br>User</button></a>
            </div>

            <div class="menu-item-div active">
                <button class="m-btn"><i class="fas fa-glass-cheers"></i><br> Transactions</button>
            </div>

            <div class="menu-item-div">
                <a href="{{url('userview/loans')}}/{{$id}}"><button class="m-btn"><i class="fas fa-users"></i><br> Loans </button></a>
            </div>

            <div class="menu-item-div">
                <a href="{{url('userRequests')}}/{{$id}}"><button class="m-btn"><i class="fas fa-info-circle"></i><br> Requests </button></a>
            </div>


        </div>

    </div>
    <div class="right-main-div">
        <div class="container-fluid">
            <p>{{ request()->get('') }}</p>
            <table class="table text-center table-dark" >
                <thead>
                    <tr>
                        <th scope="col">Transaction Id</th>
                        <th scope="col">From</th>
                        <th scope="col">To</th>
                        <th scope="col">Type</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Time</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody id="records_table">
                    @foreach($transaction as $data)
                    <tr>    
                        <td>{{ $data['id'] }}</td>
                        <td>{{ $data['from'] }}</td>
                        <td>{{ $data['to'] }}</td>
                        <td>{{ $data['type'] }}</td>
                        <td>{{ $data['amount'] }}</td>
                        @if($data->status == 'successfull')
                            <td style="padding:12px">
                                <span style="background-color:#28a745;padding:10px;border-radius:100px">
                                    {{ $data['status'] }}
                                </span>
                            </td>
                        @else
                            <td style="padding:12px">
                                <span style="background-color:#dc3545;padding:10px;border-radius: 100px;">
                                    {{ $data['status'] }}
                                </span>
                            </td>
                        @endif
                        <td>{{ Carbon\Carbon::parse($data->date)->format('h:i:s') }}</td>
                        <td>{{ Carbon\Carbon::parse($data->time)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>


    </div>
</div>
<!-- Add New Storage Modal -->

<button id="openModalBtn" data-bs-toggle="modal" data-bs-target="#newStorageAddModel" style="display:none"></button>

<div class="modal fade bd-example-modal-lg" id="newStorageAddModel" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="min-width:90vw ">
    <div class="modal-dialog modal-lg" style="min-width:90vw; ">
        <div class="modal-content" style="min-width:90vw;min-height:90vh">
            <div class="modal-header" style="min-width:90vw;">
                <h6 class="modal-title" id="staticBackdropLabel">Document View</h6>
                <button type="button" data-bs-dismiss="modal" aria-label="Close" style="border:none;background:none;"><i
                        class="fas fa-times" style="color:blue;"></i></button>
            </div>
            <div class="modal-body" style="min-width:90vw;min-height:90vh">
                <embed id="modal-image-view" src="
                {{-- @if ($aadhar->document_image != '') --}}
                    {{-- {{ asset('storage') }}/{{$aadhar[0]->document_image}} --}}
                 {{-- @else    
                    {{ url('/images/notAvailable.png') }}
                 @endif --}}
                 " width="100%" height="1000px" style="border-radius: 10px" />
            </div>
        </div>
    </div>
</div>


@include('agent.agentLayouts.jsAgent')
{{-- <script>
     $(document).ready(function() {
        $.ajax({
            url: "/",
            type: "get",
            dataType: "json",
            // data: getData,
            beforeSend: function() {

            },
            success: function(response) {
                console.log(response);
            }
        )};
     });
</script> --}}
@include('agent.agentLayouts.footer')
