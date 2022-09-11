import { Injectable } from '@angular/core';
import { HttpClient,HttpHeaders } from '@angular/common/http'
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  headers= new HttpHeaders()
  .set('content-type', 'application/json')
  .set('Access-Control-Allow-Origin', "http://localhost:4201")
  .set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE')
  .set('Access-Control-Allow-Headers', 'X-Requested-With,content-type');

  constructor(private _http:HttpClient) { }

  login(endpoint:any, userData:any){
    return this._http.post(environment.backendUrl+endpoint,userData,{ 'headers': this.headers });
  }

  isLoggedIn(){
    return !!localStorage.getItem('access_token');
  }
}
