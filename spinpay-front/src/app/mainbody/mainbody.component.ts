import { Component, OnInit } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-mainbody',
  templateUrl: './mainbody.component.html',
  styleUrls: ['./mainbody.component.css','../../assets/css/main.css']
})
export class MainbodyComponent implements OnInit {

  constructor(private _auth:AuthService, private _route:Router) { }

  ngOnInit(): void {
    this._auth.checkAuth().subscribe(
      (success)=>this._route.navigate(['register/userinfo']),
      (err)=>''
     )
  }

}
