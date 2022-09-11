import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule,FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

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
    BorrowerComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ReactiveFormsModule,
    HttpClientModule,
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent, AuthGuard, AuthService]
})
export class AppModule { }
