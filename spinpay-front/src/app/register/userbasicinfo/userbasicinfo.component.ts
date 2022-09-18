import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { AuthService } from '../../services/auth.service';
import { RegisterService } from 'src/app/services/register.service';
import { Router,ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-userbasicinfo',
  templateUrl: './userbasicinfo.component.html',
  styleUrls: ['./userbasicinfo.component.css','../../../assets/css/main.css']
})
export class UserbasicinfoComponent implements OnInit {
  
  isRoleOne:boolean=false;
  isRoleTwo:boolean=false;
  errmsg:string ='';
  allValCheck = true;
  otpDivShow = false;

  first:number = 0;
  second  :number = 0;
  third:number = 0;
  fourth:number = 0;

  constructor(private fb:FormBuilder,private _auth:AuthService, private _regService:RegisterService, private _route:Router, private _actRoute:ActivatedRoute) { }

  get name(){
    return this.registerUserInfoForm.get('name');
  }

  get email(){
    return this.registerUserInfoForm.get('email');
  }

  get password(){
    return this.registerUserInfoForm.get('password');
  }

  get password_confirmation(){
    return this.registerUserInfoForm.get('password_confirmation');
  }

  get phone(){
    return this.registerUserInfoForm.get('phone');
  }

  registerUserInfoForm = this.fb.group({
    role_id : [''],
    name : ['',[Validators.required]],
    email: ['',[Validators.required, Validators.email]],
    password: ['',[Validators.required]],
    password_confirmation: ['',[Validators.required]],
    phone: ['',[Validators.required]],
    userOtp: ['']
  });

  otpForm = this.fb.group({
    first  :['',[Validators.required]],
    second :['',[Validators.required]],
    third  :['',[Validators.required]],
    fourth :['',[Validators.required]]
  });

  ngOnInit(): void {
    this._auth.checkAuth().subscribe(
      (success)=>this._route.navigate(['register/userinfo']),
      (err)=>''
     );
  }

  public selectrole($e:Event,val:number):void {
    $e.preventDefault();
     if(val==3){
       this.isRoleTwo = false;
       this.isRoleOne = true;
       this.registerUserInfoForm.patchValue({role_id: '3'});
     }
     else if(val==4){
       this.isRoleTwo = true;
       this.isRoleOne = false;
       this.registerUserInfoForm.patchValue({role_id: '4'});
     }
  }

  public onSubmit(){
    //  console.log(this.registerUserInfoForm.get('name')?.value);
     if(!this.registerUserInfoForm.valid){
        this.errmsg = 'please fill all fields correctly.';
        this.allValCheck = false;
     }else{
      this.allValCheck = true;
      this._regService.sendOtp('api/sendotp',this.registerUserInfoForm.value).subscribe(
        response => this.success(response),
        error    => this.error()
      );
     }
  }

  public success(response:any){
    console.log(response)
    if(response['status'] == 200){
      this.otpDivShow = true;
    }else if(response['status'] == 400 || response['status'] == 500){
      this.errmsg = response['message'];
      this.allValCheck = false;
    }else if(response['status'] == 406){
      this.allValCheck = false;
      if(response['message']['phone']!=""){
        this.errmsg = response['message']['phone'];
      }
      if(response['message']['name']!=""){
          this.errmsg = response['message']['name'];
      }
      if(response['message']['email']!=""){
          this.errmsg = response['message']['email'];
      }
      if(response['message']['password']!=""){
          this.errmsg = response['message']['password'];
      }
      if(response['message']['password_confirmation']!=""){
          this.errmsg = response['message']['password_confirmation'];
      }
    }
  }

  public error(){
    this.errmsg = 'oops!, something went wrong, please try again later';
    this.allValCheck = false;
  }
  

  movetoNext(next:any){
    next.focus();
  }
  
  verifyOtpSubmit(){
    if(!this.otpForm.valid){
      this.errmsg = 'please enter otp correctly.';
      this.allValCheck = false;
    }else{
      this.allValCheck = true;
      let first:any = this.otpForm.get('first')?.value;
      let second:any = this.otpForm.get('second')?.value;
      let third:any = this.otpForm.get('third')?.value;
      let fourth:any = this.otpForm.get('fourth')?.value;
      let final:any = first+second+third+fourth;
      this.registerUserInfoForm.patchValue({userOtp: final});
      this._regService.sendOtp('api/verifyotp',this.registerUserInfoForm.value).subscribe(
        response => {
          if(response.status==200){
            console.log(response.id)
            this._route.navigate(['register/userdata/',response.id])
          }else{
            this.errmsg = 'something went wrong please try later.';
            this.allValCheck = false;
          }
        },
        error    => {
          this.errmsg = 'something went wrong please try later.';
            this.allValCheck = false;
        },
      );
    }
  }
}
