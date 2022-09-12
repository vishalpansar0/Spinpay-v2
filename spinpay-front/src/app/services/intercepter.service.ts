import { Injectable } from '@angular/core';
import { HttpEvent, HttpHandler, HttpInterceptor, HttpRequest } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class IntercepterService implements HttpInterceptor {

  constructor() { }

  intercept(req: HttpRequest<any>, next: HttpHandler){
    let token_head = req.clone({
      setHeaders:{
        Authorization: 'Bearer '+localStorage.getItem('access_token'),
      }
    });
    return next.handle(token_head);
  }
}
