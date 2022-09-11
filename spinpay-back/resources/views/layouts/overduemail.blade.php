<center>
    <div>
        <h2 style="color:red">SpinPay Alerts</h2>
    </div>
    <div>
        
        <h2 style="color:black">Dear user, Your Loan SPINPAY00E{{$loanid}} is Comes Under <span style="color:red; text-decoration:underline ">Overdue</span> State</h2>
        <h3>Please Pay Now In case to avoid Excessive fee</h4>
        <h3>Amount : &#8377;{{$amount}}</h3>
        <h3>Due Date : {{date_format(date_create($lastDate),"d/m/Y")}}</h3>
        <h3>Late Fee : &#8377;10 (per day will be applicable)</h3>
    </div>
</center>