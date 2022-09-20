import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/services/user.service';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css','../../../assets/css/dashboard.css']
})
export class DashboardComponent implements OnInit {

  constructor(private _user:UserService) { }

  ngOnInit(): void {
    this._user.getDetails('api/user/borrower',63).subscribe(
      s=>console.log(s),
      e=>console.log(e)
    )
  }

}
