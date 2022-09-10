import { Component, OnInit } from '@angular/core';
import { environment } from '../../environments/environment';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css', '../../assets/css/main.css']
})
export class NavbarComponent implements OnInit {

  current_location:any;
  isLogin:boolean = false;
  constructor() { }

  ngOnInit(): void {
    console.log(window.location.href);
    this.current_location = window.location.href;
    if(this.current_location == environment.baseUrl){
      this.isLogin = true;
    }
  }

}
