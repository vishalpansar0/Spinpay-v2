import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http'
import { environment } from 'src/environments/environment';


@Injectable({
  providedIn: 'root'
})
export class RegisterService {
  
  constructor(private _http:HttpClient) { }

  userinfo(endpoint:any,userData:any){
    return this._http.post<any>(environment.backendUrl+endpoint,userData);
  }
}
