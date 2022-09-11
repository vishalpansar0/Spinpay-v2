import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree} from '@angular/router'; 
import { Observable } from 'rxjs';
import { AuthService } from '../services/auth.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {
  constructor(private _route:Router, private _authService:AuthService){}

  canActivate():boolean {
    if(this._authService.isLoggedIn()){
      return true;
    }else{
      this._route.navigate(['login'])
      return false
    }
  }
  
}
