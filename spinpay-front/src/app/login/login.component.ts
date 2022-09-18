import { Component, OnInit } from '@angular/core';
import { AuthService } from '../services/auth.service';
import { FormBuilder,Validators } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css','../../assets/css/main.css']
})
export class LoginComponent implements OnInit {

  errmsg:string = '';
  errFlag:boolean = false;

  constructor(private fb:FormBuilder, private _auth:AuthService, private _route:Router ) { }

  loginForm = this.fb.group({
     email: ['',[Validators.required,Validators.email]],
     password: ['',[Validators.required]]
  });

  get email(){
    return this.loginForm.get('email');
  }
  get password(){
    return this.loginForm.get('password');
  }

  ngOnInit(): void {
     this._auth.checkAuth().subscribe(
      (success)=>this._route.navigate(['register/userinfo']),
      (err)=>''
     )
  }

  userLogin(){
    if(!this.loginForm.valid){
       this.errmsg = 'please enter email and password!'
       this.errFlag = true;
    }
    else{
      this,this.errFlag = false;
      this._auth.login('api/login',this.loginForm.value).subscribe(
        response => this.success(response),
        (error) => this.error(error)
      );
    }
  }

  success(response:any){
    localStorage.setItem('access_token',response['access_token']);
    this._route.navigate(['/register/userinfo']);
  }

  error(err:any){
    if(err.status==401){
      this.errmsg = 'invalid credentials! please try with valid creds or register';
      this.errFlag = true;
    }else{
      this.errmsg = 'something went wrong!, please try again later.';    
      this.errFlag = true;
    }

  }

}
