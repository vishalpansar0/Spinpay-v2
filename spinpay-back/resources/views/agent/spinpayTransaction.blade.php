@include('layouts.header')

<nav class="navbar navbar-expand-lg table-dark text-center">
        <div class="container-fluid">
          <h1>Spinpay Transactions</h1>

        </div>
    {{-- </form> --}}
  </nav>



<div class="container-fluid">
    <table class="table text-center table-dark" >
        <thead>
            <tr>
                <th scope="col">Transaction Id</th>
                <th scope="col">Loan Id</th>
                <th scope="col">Borrower Id</th>
                <th scope="col">Borrower Name</th>
                <th scope="col">Amount</th>
                <th scope="col">Time</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody id="records_table">
            @foreach($transaction as $data)
            <tr>
                <td>SPINPAY00T{{ $data['id'] }}</td>
                <td>SPINPAY00L{{ $data['lid'] }}</td>
                <td>SPINPAY00U{{ $data['uid'] }}</td>
                <td>{{ $data['uname'] }}</td>
                <td>{{ $data['stamount'] }}</td>
                <td>{{ Carbon\Carbon::parse($data['stdate'])->format('h:i:s') }}</td>
                <td>{{ Carbon\Carbon::parse($data['sttime'])->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

  
