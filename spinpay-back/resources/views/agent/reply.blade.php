@extends('agent.agentLayouts.header')
@include('layouts.header')

<div class="navbar">
    <div class="main-logo-head">
        SpinPay
    </div>
    <div class="nav-menu">
        <a href="">{{Session::get('agent_name')}}</a>&nbsp;&nbsp;&nbsp;
        <a href="{{url('agent/dashboard')}}"> Dashboard</a>&nbsp;&nbsp;&nbsp;
        <a href="{{url('api/agentLogout')}}"> Logout</a>
    </div>
</div>

<div class="container-fluid" style="margin-top: 30px">
    <div class="row text-center">
        <h2 style="color:white">User queries</h2>
    </div>
    <input type="text" style="display:none" id="agent_id" value="{{Session::get('agent_id')}}">
    <table class="table text-center table-dark">
        <thead>
            <tr>
                <th scope="col">Query Id</th>
                <th scope="col">User Id</th>
                <th scope="col">Category</th>
                <th scope="col">User Issue</th>
                <th scope="col">Reply Message </th>
                <th scope="col">Raise Time</th>
                <th scope="col">Last Reply Time</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody id="records_table">
            @foreach ($query as $data)
                <tr>
                    <td>{{ $data->id }}</td>
                    <td>{{ $data->user_id }}</td>
                    <td>{{ $data->category }}</td>
                    <td id="{{$data->id}}">{{ $data->user_message }}</td>
                    @if ($data->reply_message == null)
                        <td>--</td>
                    @else
                        <td>{{ $data->reply_message }}</td>
                    @endif
                    <td>{{ Carbon\Carbon::parse($data->created_at)->format('d/m/y') }}</td>
                    @if ($data->updated_at != $data->updated_at)
                        <td>--</td>
                    @else
                        <td>{{ Carbon\Carbon::parse($data->updated_at)->format('d/m/y') }}</td>
                    @endif
                    <td><button class="btn btn-primary" onclick="setModal('{{$data->id}}')">Reply</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button class="btn btn-primary" id="openModal" data-bs-toggle="modal" data-bs-target="#addagentmodal" style="display:none"></button>
</div>


<div class="modal fade" id="addagentmodal" data-bs-backdrop="static" data-bs-keyboard="false"
tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content" style="background-color:#17202A">
        <div class="modal-header">
            <h6 class="modal-title" id="staticBackdropLabel" style="color:white">reply user's query</h6>
            <button type="button" data-bs-dismiss="modal" id="closeModal" aria-label="Close" style="border:none;background:none;"><i
                    class="fas fa-times" style="color:blue;"></i></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger text-center" id="errorDiv" style="padding:0%;display:none"></div>
            <input type="text" id="qIdModal" style="display:none">
            <textarea name="query" id="modalQuery" cols="30" rows="5" style="background-color:transparent;color:white;padding:10px;width:100%" disabled></textarea>
            <div class="inputDiv">
                <textarea name="reason" id="modalreply" cols="30" rows="10" style="background-color:transparent;color:white;padding:10px;width:100%"></textarea>
            </div>
            <div class="inputDiv mt-2">
                <button class="btn capbtn" id="replyQBtn" style="float:right">reply</button>
        </div>
    </div>
</div>
</div>
</div>

<script>
        $(document).ready(function() {
            function errormsg(str) {
            $('#errorDiv').html(str);
            $('#errorDiv').css('display', 'block');
            }
        $('#replyQBtn').on('click',function(){
            var query_id = $('#qIdModal').val();
            var agent_id = $('#agent_id').val();
            var query_reply = $('#modalreply').val();
            query_reply = query_reply.trim();
            if(query_reply==""){
                if(agent_id=="" || query_id==""){
                    errormsg('some error occurred!')
                }else{
                    errormsg('reply can not be empty')
                }
                
            }else{
                const getData = {
               'id' : query_id,
               'reply_message': query_reply,
               'repiled_id':agent_id,
            };
            $.ajax({
                url: "/api/agentreply",
                type: "post",
                dataType: "json",
                data: getData,
                beforeSend: function() {
                    $('#profile_aprv_btn').prop('disabled',true);
                    $('#profile_aprv_btn').html('Approving...');
                },
                success: function(response) {
                    console.log(response);
                    alert(response['message']);
                    $('#closeModal').click();
                }
            });
            }
        });
        });

        function setModal(id){
        var q = $('#'+id).text();
        $('#qIdModal').val(id);
        $('#modalQuery').html(q);
        $('#openModal').click();

    }
</script>
