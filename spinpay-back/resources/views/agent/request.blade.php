@include('layouts.header')

<nav class="navbar navbar-expand-lg table-dark text-center">
        <div class="container-fluid">
          <h1>Requests</h1>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item ml-5">
                <a class="nav-link active" aria-current="page" >From</a>
              </li>
              <li class="nav-item">
                <input class="date form-control input-sm" type="date" style="width:100%" id="fromdate">
              </li>
              <li class="nav-item ml-5">
                <a class="nav-link active" aria-current="page" >To</a>
              </li>
              <li class="nav-item">
                <input class="date form-control input-sm" type="date" style="width:100%" id="todate">
              </li>
              <li style="margin-left:23px" class="">
                  <select class="selectStatus" id="status">
                      <option value="all">All</option>
                      <option value="approved">Approved</option>
                      <option value="pending">Pending</option>
                      <option value="rejected">Rejected</option>
                  </select>
              </li>
            </ul>
              <button class="btn btn-outline-success"  type="submit" id="submitFilterData">Apply</button>
          </div>
        </div>
  </nav>

  <div class="container-fluid">
    <table class="table text-center table-dark" >
        <thead>
            <tr>
                <th scope="col">Request Id</th>
                <th scope="col">User Id</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th>
                <th scope="col">Tenure</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody id="records_table">
            @foreach($requests as $data)
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['user_id'] }}</td>
                <td>{{ $data['amount'] }}</td>
                @if($data->status == 'approved')
                  <td style="padding:12px">
                    <span style="background-color:#28a745;padding:10px;border-radius:100px">
                      {{ $data['status'] }}
                    </span>
                  </td>
                @elseif($data->status == 'pending')
                  <td style="padding:12px">
                    <span style="background-color:blue;padding:10px;border-radius: 100px;">
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
                <td>{{ $data['tenure'] }}</td>
                <td>{{ Carbon\Carbon::parse($data->created_at)->format('h:i:s') }}</td>
                <td>{{ Carbon\Carbon::parse($data->created_at)->format('Y-m-d') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

<script>
    $('#submitFilterData').click(function(event){
        fromdate = $('#fromdate').val();
        todate = $('#todate').val();
        status = $('#status').val();
        const data={
            'fromdate' : fromdate,
            'todate' : todate,
            'status' : status,
        };

        $.ajax({
            url: "api/filterRequest",
            type: "POST",
            dataType: "json",
            data: data,
            beforeSend: function(){
                $('#records_table').empty();
            },
            success: function(response){
                var trHTML= '';
                $.each(response,function(key,value){
                    if(value.status == 'approved'){
                      status='<span style="background-color:#28a745;padding:10px;border-radius:100px">approved</span>'
                    }
                    else if(value.status == 'pending'){
                      status='<span style="background-color:blue;padding:10px;border-radius: 100px;">pending</span>'
                    }
                    else{
                      status='<span style="background-color:#dc3545;padding:10px;border-radius: 100px;">rejected</span>'
                    }
                    date=new Date(value.created_at);
                    const dateString = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate();
                    const timeString =   date.getHours()+ ":" + date.getMinutes() + ":" + date.getSeconds();
                    trHTML += '<tr><td>' + value.id + '</td><td>' + value.user_id + '</td><td>' + value.amount + '</td><td>' + status + '</td><td>' + value.tenure + '</td><td>' + timeString + '</td><td>' + dateString + '</td></tr>';
                });
                $('#records_table').append(trHTML);
            }
        });

    });
</script>
