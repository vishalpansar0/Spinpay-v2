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

            <div class="menu-item-div ">
                <a href="{{url('userview/transaction')}}/{{$id}}"><button class="m-btn"><i class="fas fa-glass-cheers"></i><br> Transactions</button></a>
            </div>

            <div class="menu-item-div active">
                <button class="m-btn"><i class="fas fa-users"></i><br> Loans </button>
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
                        <th scope="col">Loan Id</th>
                        <th scope="col">Request Id</th>
                        <th scope="col">Borrower Id</th>
                        <th scope="col">Lender Id</th>
                        <th scope="col">Interest</th>
                        <th scope="col">Processing Fee</th>
                        <th scope="col">Late fee</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Repayment Id</th>
                        <th scope="col">Start date</th>
                        <th scope="col">End date</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody id="records_table">
                    @foreach($loans as $data)
                    <tr>
                        <td>{{ $data['id'] }}</td>
                        <td>{{ $data['request_id'] }}</td>
                        <td>{{ $data['borrower_id'] }}</td>
                        <td>{{ $data['lender_id'] }}</td>
                        <td>{{ $data['interest'] }}</td>
                        <td>{{ $data['processing_fee'] }}</td>
                        <td>{{ $data['late_fee'] }}</td>
                        <td>{{ $data['amount'] }}</td>
                        {{-- <td>{{ $data['sent_transaction_id'] }}</td> --}}
                        <td>{{ $data['repayment_transaction_id'] }}</td>
                        {{-- <td>{{  }}</td> --}}
                        <td>{{ Carbon\Carbon::parse($data['start_date'])->format('h:i:s') }}</td>
                        <<td>{{ Carbon\Carbon::parse($data['end_date'])->format('h:i:s') }}</td>
                        @if($data->status == 'ongoing')
                            <td style="padding:12px">
                                <span style="background-color:orange;padding:10px;border-radius:100px">
                                    {{ $data['status'] }}
                                </span>
                            </td>
                        @elseif($data->status == 'repaid')
                            <td style="padding:12px">
                                <span style="background-color:green;padding:10px;border-radius: 100px;">
                                    {{ $data['status'] }}
                                </span>
                            </td>
                            @else
                            <td style="padding:12px">
                                <span style="background-color:red;padding:10px;border-radius: 100px;">
                                    {{ $data['status'] }}
                                </span>
                            </td>
                        @endif
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
