import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';
import { RegisterService } from 'src/app/services/register.service';

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

  constructor(private fb:FormBuilder, private _regService:RegisterService) { }

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
    phone: ['',[Validators.required]]
  });

  ngOnInit(): void {
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
      this._regService.userinfo('api/sendotp',this.registerUserInfoForm.value).subscribe(
        response => this.success(response),
        error    => console.log('error', error)
      );
     }
  }

  public success(response:any){
    console.log(response)
    if(response['status'] == 200){
      this.errmsg = response['message'];
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

}
