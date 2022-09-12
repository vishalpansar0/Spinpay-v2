import { Injectable } from '@angular/core';
import { ActivatedRouteSnapshot, CanActivate, Router, RouterStateSnapshot, UrlTree} from '@angular/router'; 
import { AuthService } from '../services/auth.service';

@Injectable({
  providedIn: 'root'
})
export class AuthLoginGuard implements CanActivate {
  constructor(private _route:Router, private _authService:AuthService){}

  canActivate():any {
    if(this._authService.isLoggedIn()){
      this._authService.checkAuth().subscribe(
        (success)=>{
          this._route.navigate(['register/userinfo']);
        },
        (err)=>console.log('invalid token')
      );
      return true;
    }
  }
}
