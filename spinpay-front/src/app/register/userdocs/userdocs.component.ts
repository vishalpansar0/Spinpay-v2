import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, Validators } from '@angular/forms';
import { RegisterService } from 'src/app/services/register.service';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-userdocs',
  templateUrl: './userdocs.component.html',
  styleUrls: ['./userdocs.component.css','../../../assets/css/main.css']
})
export class UserdocsComponent implements OnInit {
  // iid:any;
  constructor(private _route:Router,private _auth:AuthService) { }

  ngOnInit(): void {

  }

}
