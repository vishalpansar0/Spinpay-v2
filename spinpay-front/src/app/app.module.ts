import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule,FormsModule } from '@angular/forms';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavbarComponent } from './navbar/navbar.component';
import { MainbodyComponent } from './mainbody/mainbody.component';
import { MainFooterComponent } from './main-footer/main-footer.component';
import { LoginComponent } from './login/login.component';
import { UserbasicinfoComponent } from './register/userbasicinfo/userbasicinfo.component';
import { UserdocsComponent } from './register/userdocs/userdocs.component';
import { LenderComponent } from './user/lender/lender.component';
import { BorrowerComponent } from './user/borrower/borrower.component';
import { AuthGuard } from './gaurds/auth.guard';
import { AuthService } from './services/auth.service';
import { IntercepterService } from './services/intercepter.service';
import { UserdataComponent } from './register/userdata/userdata.component';
import { AadharComponent } from './register/userdocs/aadhar/aadhar.component';
import { PanComponent } from './register/userdocs/pan/pan.component';
import { BankstatementComponent } from './register/userdocs/bankstatement/bankstatement.component';
import { PayslipComponent } from './register/userdocs/payslip/payslip.component';
import { UserComponent } from './user/user.component';
import { SidebarComponent } from './user/sidebar/sidebar.component';
import { DashboardComponent } from './user/dashboard/dashboard.component';
import { BorrowwerDashboardComponent } from './user/borrower/borrowwer-dashboard/borrowwer-dashboard.component';
import { BorrowwerSidebarComponent } from './user/borrower/borrowwer-sidebar/borrowwer-sidebar.component';

@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    MainbodyComponent,
    MainFooterComponent,
    LoginComponent,
    UserbasicinfoComponent,
    UserdocsComponent,
    LenderComponent,
    BorrowerComponent,
    UserdataComponent,
    AadharComponent,
    PanComponent,
    BankstatementComponent,
    PayslipComponent,
    UserComponent,
    SidebarComponent,
    DashboardComponent,
    BorrowwerDashboardComponent,
    BorrowwerSidebarComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ReactiveFormsModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [AuthGuard, AuthService,{
    provide:HTTP_INTERCEPTORS,
    useClass:IntercepterService,
    multi:true
  }],
  bootstrap: [AppComponent]
})
export class AppModule { }
