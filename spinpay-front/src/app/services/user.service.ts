import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http'
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(private _http:HttpClient) { }

  getDetails(endpoint:any,id:any){
    return this._http.post<any>(environment.backendUrl+endpoint,id);
  }
}
