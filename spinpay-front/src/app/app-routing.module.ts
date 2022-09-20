import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthGuard } from './gaurds/auth.guard';
import { LoginComponent } from './login/login.component';
import { MainbodyComponent } from './mainbody/mainbody.component';
import { UserbasicinfoComponent } from './register/userbasicinfo/userbasicinfo.component';
import { UserdataComponent } from './register/userdata/userdata.component';
import { AadharComponent } from './register/userdocs/aadhar/aadhar.component';
import { BankstatementComponent } from './register/userdocs/bankstatement/bankstatement.component';
import { PanComponent } from './register/userdocs/pan/pan.component';
import { UserdocsComponent } from './register/userdocs/userdocs.component';
import { BorrowerComponent } from './user/borrower/borrower.component';
import { BorrowwerDashboardComponent } from './user/borrower/borrowwer-dashboard/borrowwer-dashboard.component';
import { LenderComponent } from './user/lender/lender.component';
import { UserComponent } from './user/user.component';

const routes: Routes = [
  { path: '', component: MainbodyComponent},
  { path: 'login', component: LoginComponent},
  { path: 'register', redirectTo: 'register/userinfo'},
  { path: 'register/userinfo', component: UserbasicinfoComponent},
  { path: 'register/userdata', component: UserdataComponent},
  { 
    path: 'register/userdocs', 
    component: UserdocsComponent,
    children: [
      {
        path: 'aadhar', 
        component: AadharComponent, 
      },
      {
        path: 'pan',
        component: PanComponent, 
      },
      {
        path: 'bankstatement',
        component: BankstatementComponent, 
      }
    ],
  },
  { path:'user', component:UserComponent,
    children: [
      {
        path: 'borrower', 
        component: BorrowerComponent, 
        children: [
          {
            path: 'dashboard', 
            component: BorrowwerDashboardComponent, 
          },
          {
            path: 'requests',
            component: BorrowwerDashboardComponent
          }
        ],
      },
      {
        path: 'lender',
        component: LenderComponent,     
      },
    ],
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
