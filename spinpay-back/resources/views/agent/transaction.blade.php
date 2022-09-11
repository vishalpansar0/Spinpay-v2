@include('layouts.header')

<nav class="navbar navbar-expand-lg table-dark text-center">
        <div class="container-fluid">
          <h1>Transactions</h1>
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
              <li style="" class="">
                <select  id="type">
                    <option value="all">All</option>
                    <option value="disburse">Disburse</option>
                    <option value="repayed">Repayed</option>
                    <option value="self">Self</option>
                </select>
            </li>
              <li class="nav-item ml-5">
                <span>
                    <button class="btn btn-outline-success" type="submit" id="btn1">Successfull</button>
                </span>
              </li>
              <li class="nav-item ml-5">
                <span>
                    <button class="btn btn-outline-danger" type="submit" id="btn2">Failed</button>
                </span>
              </li>
            </ul>
              <button class="btn btn-outline-success"  type="submit" id="submitFilterData">Apply</button>
          </div>
        </div>
    {{-- </form> --}}
  </nav>



<div class="container-fluid">
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

  
<script type="text/javascript">
    let t=0;
    let status="";
    $('#btn1').on('click',function(){
        if(t == 0){
            $('#btn1').css('background-color','#28a745');
            $('#btn1').css('color','white');
            t=1;
            status="successfull";
        }
        else if(t == 1){
            $('#btn2').css('background-color','#212529');
            $('#btn2').css('color','#dc3545');
            $('#btn2').css('border-color','#dc3545')

            $('#btn1').css('background-color','#28a745');
            $('#btn1').css('color','white');
            status="successfull";
        }

    });

    $('#btn2').on('click',function(){
        if(t == 0){
            $('#btn2').css('background-color','#dc3545');
            $('#btn2').css('color','white');
            status="failed";

        }
        else if(t == 1){
            $('#btn1').css('background-color','#212529');
            $('#btn1').css('color','#28a745');
            $('#btn1').css('border-color','#28a745')

            $('#btn2').css('background-color','#dc3545');
            $('#btn2').css('color','white');
            status="failed";
        }
    });

    $('#submitFilterData').click(function(event){
        fromdate = $("#fromdate").val();
        todate =$("#todate").val();
        const trandata = {
            'fromdate' : fromdate,
            'todate' : todate,
            'status' : status,
            'type' :$("#type").val(),
        };

        $.ajax({
            url: "api/transaction",
            type: "post",
            datatype: "JSON",
            data: trandata,
            beforeSend: function(){
                $('#records_table').empty();
            },
            success: function(result){
                var trHTML = '';
                $.each(result,function(i,item){
                    if(item.status == 'successfull'){
                        status='<span style="background-color:#28a745;padding:10px;border-radius:100px">Successfull</span>'
                    }
                    else{
                        status='<span style="background-color:#dc3545;padding:10px;border-radius: 100px;">Failed</span>'
                    }
                    date=new Date(item.date);
                    const dateString = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
                    const timeString =   date.getHours()+ ":" + date.getMinutes() + ":" + date.getSeconds();
                    trHTML += '<tr><td>' + item.id + '</td><td>' + item.from + '</td><td>' + item.to + '</td><td>' + item.type + '</td><td>' + item.amount + '</td><td>' + status + '</td><td>' +  timeString + '</td><td>' + dateString + '</td></tr>';
                });
                $('#records_table').append(trHTML);
            }
        });
    });

</script>