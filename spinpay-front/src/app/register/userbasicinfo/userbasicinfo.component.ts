import { Component, OnInit } from '@angular/core';
import { FormBuilder, Validators } from '@angular/forms';

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

  constructor(private fb:FormBuilder) { }

  get name(){
    return this.registerUserInfoForm.get('name');
  }

  get useremail(){
    return this.registerUserInfoForm.get('useremail');
  }

  get userpassword(){
    return this.registerUserInfoForm.get('userpassword');
  }

  get userpasswordcnf(){
    return this.registerUserInfoForm.get('userpasswordcnf');
  }

  get userphone(){
    return this.registerUserInfoForm.get('userphone');
  }

  registerUserInfoForm = this.fb.group({
    role : [''],
    name : ['',[Validators.required]],
    useremail: ['',[Validators.required, Validators.email]],
    userpassword: ['',[Validators.required]],
    userpasswordcnf: ['',[Validators.required]],
    userphone: ['',[Validators.required]]
  });

  ngOnInit(): void {
  }

  public selectrole($e:Event,val:number):void {
    $e.preventDefault();
     if(val==3){
       this.isRoleTwo = false;
       this.isRoleOne = true;
       this.registerUserInfoForm.patchValue({role: '3'});
     }
     else if(val==4){
       this.isRoleTwo = true;
       this.isRoleOne = false;
       this.registerUserInfoForm.patchValue({role: '4'});
     }
  }

  public onSubmit(){
     console.log(this.registerUserInfoForm.get('name')?.value);
     if(this.registerUserInfoForm.get('role')?.value ==='' || this.registerUserInfoForm.get('name')?.value || this.registerUserInfoForm.get('useremail')?.value == '' || this.registerUserInfoForm.get('userpassword')?.value == '' || this.registerUserInfoForm.get('userpasswordcnf')?.value == '' || this.registerUserInfoForm.get('userphone')?.value == ''){
        this.errmsg = 'please fill all fields correctly.';
        this.allValCheck = false;
     }else{
      this.allValCheck = true;
     }
  }

}
