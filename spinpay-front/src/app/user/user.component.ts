import { Component, OnInit } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user',
  templateUrl: './user.component.html',
  styleUrls: ['./user.component.css']
})
export class UserComponent implements OnInit {

  constructor(private _auth:AuthService,private _route:Router) { }

  ngOnInit(): void {
    this._auth.checkAuth().subscribe(
      response=>{
        console.log(response);
        if(response.id>0){
          if(response.role_id==3){
            this._route.navigate(['user/borrower/dashboard']);
          }else if(response.role_id==4){
            this._route.navigate(['user/lender/dashboard']);  
          }
        }else{
          this._route.navigate(['login']);
        }
    },
      error=>{
        this._route.navigate(['login']);
      }
    );
  }
}
