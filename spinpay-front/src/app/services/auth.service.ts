import { Injectable } from '@angular/core';
import { HttpClient,HttpHeaders } from '@angular/common/http'
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private _http:HttpClient) { }

  login(endpoint:any, userData:any){
    return this._http.post(environment.backendUrl+endpoint,userData);
  }

  isLoggedIn(){
    return !!localStorage.getItem('access_token');
  }

  checkAuth(){
    return this._http.post<any>(environment.backendUrl+'api/checkAuth','')
  }
}
