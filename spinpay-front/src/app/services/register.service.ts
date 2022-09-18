import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http'
import { environment } from 'src/environments/environment';


@Injectable({
  providedIn: 'root'
})
export class RegisterService {
  
  constructor(private _http:HttpClient) { }

  sendOtp(endpoint:any,userData:any){
    return this._http.post<any>(environment.backendUrl+endpoint,userData);
  }

  verifyOtpAndRegister(endpoint:any,userData:any){
    return this._http.post<any>(environment.backendUrl+endpoint,userData);
  }

  imageUpload(endpoint:any,formData:any){
    return this._http.post<any>(environment.backendUrl+endpoint,formData);
  }

  submitUserData(endpoint:any,userData:any){
    return this._http.post(environment.backendUrl+endpoint,userData);
  }

  getDocDetails(endpoint:any,formData:any){
    return this._http.post<any>(environment.backendUrl+endpoint,formData);
  }

  docUpload(endpoint:any,docData:any){
    return this._http.post<any>(environment.backendUrl+endpoint,docData);
  }
}
