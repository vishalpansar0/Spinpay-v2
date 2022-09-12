import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthLoginGuard } from './gaurds/auth-login.guard';
import { AuthGuard } from './gaurds/auth.guard';
import { LoginComponent } from './login/login.component';
import { MainbodyComponent } from './mainbody/mainbody.component';
import { UserbasicinfoComponent } from './register/userbasicinfo/userbasicinfo.component';
import { UserdataComponent } from './register/userdata/userdata.component';

const routes: Routes = [
  { path: '', component: MainbodyComponent},
  { path: 'login', component: LoginComponent},
  { path: 'register', redirectTo: 'register/userinfo'},
  { path: 'register/userinfo', component: UserbasicinfoComponent,canActivate:[AuthGuard]},
  { path: 'register/userdata/:id', component: UserdataComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
