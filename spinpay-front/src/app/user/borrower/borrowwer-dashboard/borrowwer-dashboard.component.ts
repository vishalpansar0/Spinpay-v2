import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/services/user.service';

@Component({
  selector: 'app-borrowwer-dashboard',
  templateUrl: './borrowwer-dashboard.component.html',
  styleUrls: ['./borrowwer-dashboard.component.css','../../../../assets/css/dashboard.css']
})
export class BorrowwerDashboardComponent implements OnInit {

  constructor(private _user:UserService) { }
  name:any;
  amount:any;
  start_date:any;
  end_date:any;
  limit:any;
  loan_id:any;
  loanp:any;
  reason:any;
  score:any;
  status:any;
  statuss:any;

  async ngOnInit(){
      await this._user.getDetails('api/user/borrower',63).subscribe(
        response=>{
          this.name        = response.data.name;
          this.amount      = response.data.amount;
          this.start_date  = response.data.start_date;
          this.end_date    = response.data.end_date;
          this.limit       = response.data.limit!=null? response.data.limit : 'N/A';
          this.loanp       = response.data.loanp;
          this.reason      = response.data.reason;
          this.score       = response.data.score!=null? response.data.score : 'N/A';
          this.status      = response.data.status;
          this.statuss     = response.data.statuss;
        },
        e=>console.log(e)
      );
    }

}
