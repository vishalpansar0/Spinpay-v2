import { Component, OnInit } from '@angular/core';
import { UserService } from 'src/app/services/user.service';

@Component({
  selector: 'app-borrower',
  templateUrl: './borrower.component.html',
  styleUrls: ['./borrower.component.css','../../../assets/css/dashboard.css']
})
export class BorrowerComponent implements OnInit {

  constructor(private _user:UserService) { }

  ngOnInit(): void {

  }

}
