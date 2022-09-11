import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { MainbodyComponent } from './mainbody/mainbody.component';
import { UserbasicinfoComponent } from './register/userbasicinfo/userbasicinfo.component';

const routes: Routes = [
  { path: '', component: MainbodyComponent},
  { path: 'login', component: LoginComponent},
  { path: 'register', redirectTo: 'register/userinfo'},
  { path: 'register/userinfo', component: UserbasicinfoComponent},
  // { path: 'register/userdata', component: UserdataComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
