<center>
    <div>
        <h2 style="color:red">SpinPay Alerts</h2>
    </div>
    <div>
        
        <h2 style="color:black">Dear user, your Loan SPINPAY00E{{$loanid}} has been approved</h2>
    </div>
    <div>
        <h1 style="color:blue">AMOUNT : &#8377;{{ $amount }}</h1>
        <h1 style="color:blue">DUE DATE : {{date_format(date_create($duedate),"d/m/Y")}}</h1>
    </div>
    <span>Thank You For Using SPINPAY</span>
</center>