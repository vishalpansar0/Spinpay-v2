import { Component, Input, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, Validators } from '@angular/forms';
import { RegisterService } from 'src/app/services/register.service';
import { AuthService } from '../../../services/auth.service';
import { UserdocsComponent } from '../userdocs.component';

@Component({
  selector: 'app-aadhar',
  templateUrl: './aadhar.component.html',
  styleUrls: ['./aadhar.component.css','../../../../assets/css/main.css']
})
export class AadharComponent implements OnInit {

  constructor(private _route:Router, private fb:FormBuilder, private regService:RegisterService, private _auth:AuthService ,private userdoc:UserdocsComponent) { }

  iid:any;
  num:any;
  imageFile:any;
  errmsg:string='';
  errFlag:boolean=false;

  aadharData= this.fb.group({
    aadhar_num:['',[Validators.required]],
    aadhar_image:['',[Validators.required]]
  });

  get aadhar_num(){
    return this.aadharData.get('aadhar_num'); 
  }

  get aadhar_image(){
    return this.aadharData.get('aadhar_image'); 
  }

  async ngOnInit(){
    await this._auth.checkAuth().subscribe(
      (response)=>{
          this.iid = response.id;
          console.log(this.iid);
          if(this.iid>0){
            console.log('jbn');
            const formData = new FormData();
                formData.append('doc_id', '1');
                formData.append('user_id', this.iid);
            this.regService.getDocDetails('api/getDocDetails',formData).subscribe(
              (resp) => this.getDocSuccess(resp),
              (err) => console.log(err)
            );  
          }else{
            this._route.navigate(['login']);
          }
      },
      (error)=>{
        this._route.navigate(['login']);
      }
    );
    console.log(this.iid);
    
      
  }

  getDocSuccess(res:any){
    if(res.status==200){
      if(res.flag){
        this._route.navigate(['register/userdocs/pan']);
      }
    }else if(res.status==400){
      this._route.navigate(['login']);
    }
  }

  onFileChange(e:Event) {
    const target = e.target as HTMLInputElement;
    const files = target.files as FileList;
    const file = files[0];
    this.imageFile = file
    console.log(files);
  }

  submitImage(){
    this.num = this.aadharData.get('aadhar_num')?.value;
    const formData = new FormData();
          formData.append('document_number', this.num);
          formData.append('document_image', this.imageFile);
          formData.append('user_id', this.iid);
          formData.append('master_document_id', '1');
    this.regService.docUpload('api/aadhar',formData).subscribe(
      success=>{
        if(success.status==200){
          this._route.navigate(['register/userdocs/pan']);
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
