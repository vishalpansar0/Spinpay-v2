import { Component, Input, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { FormBuilder, Validators } from '@angular/forms';
import { RegisterService } from 'src/app/services/register.service';
import { AuthService } from '../../../services/auth.service';
import { UserdocsComponent } from '../userdocs.component';

@Component({
  selector: 'app-pan',
  templateUrl: './pan.component.html',
  styleUrls: ['./pan.component.css','../../../../assets/css/main.css']
})
export class PanComponent implements OnInit {

  constructor(private _route:Router, private fb:FormBuilder, private regService:RegisterService, private _auth:AuthService ,private userdoc:UserdocsComponent) { }

  iid:any;
  num:any;
  imageFile:any;
  errmsg:string='';
  errFlag:boolean=false;

  panData= this.fb.group({
    pan_num:['',[Validators.required]],
    pan_image:['',[Validators.required]]
  });

  get pan_num(){
    return this.panData.get('pan_num'); 
  }

  get pan_image(){
    return this.panData.get('pan_image'); 
  }

  async ngOnInit(){
    await this._auth.checkAuth().subscribe(
      (response)=>{
          this.iid = response.id;
          console.log(this.iid);
          if(this.iid>0){
            console.log(response);
            const formData = new FormData();
                formData.append('doc_id', '2');
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
        this._route.navigate(['register/userdocs/bankstatement']);
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
    this.num = this.panData.get('pan_num')?.value;
    const formData = new FormData();
          formData.append('document_number', this.num);
          formData.append('document_image', this.imageFile);
          formData.append('user_id', this.iid);
          formData.append('master_document_id', '2');
    this.regService.docUpload('api/pancard',formData).subscribe(
      success=>{
        if(success.status==200){
          if(success.isLender=='no'){
            this._route.navigate(['register/userdocs/bankstatement']);
          }else if(success.isLender=='yes'){
            this._route.navigate(['user']);
          }
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
