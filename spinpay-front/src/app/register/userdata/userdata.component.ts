import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { FormBuilder, Validators } from '@angular/forms';

@Component({
  selector: 'app-userdata',
  templateUrl: './userdata.component.html',
  styleUrls: ['./userdata.component.css','../../../assets/css/main.css']
})
export class UserdataComponent implements OnInit {
  

  constructor(private _route:ActivatedRoute, private fb:FormBuilder) { }
  iid:number = 0;
  userDataForm = this.fb.group({
    address_line:['ughb'],
    city:[''],
    state:[''],
    pincode:[''],
    age:[''],
    gender:[''],
    dob:[''],
    image:['']
  });

  ngOnInit(): void {
    let id = this._route.snapshot.paramMap.get('id');
    this.iid = Number(id);
  }

}
