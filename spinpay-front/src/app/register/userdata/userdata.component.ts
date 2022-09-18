import { Component, OnInit } from '@angular/core';
import { ActivatedRoute,Router } from '@angular/router';
import { FormBuilder, Validators } from '@angular/forms';
import { RegisterService } from 'src/app/services/register.service';
import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-userdata',
  templateUrl: './userdata.component.html',
  styleUrls: ['./userdata.component.css','../../../assets/css/main.css']
})
export class UserdataComponent implements OnInit {
  

  constructor(private _actRoute:ActivatedRoute, private _route:Router, private fb:FormBuilder, private regService:RegisterService, private _auth:AuthService) { }
  iid:any=0;
  imageFile:any;
  errmsg:string = '';
  errFlag:boolean = false;

  userDataForm = this.fb.group({
    user_id:['',[Validators.required]],
    address_line:['',[Validators.required]],
    city:['',[Validators.required]],
    state:['',[Validators.required]],
    pincode:['',[Validators.required]],
    age:['',[Validators.required]],
    gender:['',[Validators.required]],
    dob:['',[Validators.required]],
    image:['',[Validators.required]],
  });
  ngOnInit(): void {

    this._auth.checkAuth().subscribe(
      (response)=>{
        console.log('hello');
          this.iid = response.id;
          this.userDataForm.get('user_id')?.setValue(this.iid);
      },
      (error)=>{
        this._route.navigate(['login']);
      }
    );
  }

  get address_line(){
    return this.userDataForm.get('address_line'); 
  }
  get city(){
    return this.userDataForm.get('city'); 
  }
  get state(){
    return this.userDataForm.get('state'); 
  }
  get pincode(){
    return this.userDataForm.get('napincodeme'); 
  }
  get age(){
    return this.userDataForm.get('age'); 
  }
  get gender(){
    return this.userDataForm.get('aggendere'); 
  }
  get dob(){
    return this.userDataForm.get('dob'); 
  }
  get image(){
    return this.userDataForm.get('image'); 
  }


  onFileChange(e:Event) {
    const target = e.target as HTMLInputElement;
    const files = target.files as FileList;
    const file = files[0];
    this.imageFile = file
    console.log(files);
  }

  submitUserData(){
    if(this.userDataForm.valid){
      this.errFlag = false;
      this.regService.submitUserData('api/userdata',this.userDataForm.value).subscribe(
        success=>this.submitImage(),
        error=>{
          this.errmsg = 'oops, something went wrong!, please try again later.';
          this.errFlag = true;
        }
      );
      
    }else{
      this.errmsg = 'please fill all fields correctly!';
      this.errFlag = true;
    }
  }
  submitImage(){
    const formData = new FormData();
          formData.append('image', this.imageFile);
          formData.append('user_id', this.iid);
    this.regService.imageUpload('api/imageUpload',formData).subscribe(
      success=>{
        if(success.status==200){
          this._route.navigate(['user']);
        }else{
          this.errmsg = 'oops, something went wrong!, please try again later.';
          this.errFlag = true;
        }
      },
      error=>{
        this.errmsg = 'oops, something went wrong!, please try again later.';
        this.errFlag = true;
      }
    );
  }

}
