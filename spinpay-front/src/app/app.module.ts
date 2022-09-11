import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { ReactiveFormsModule } from '@angular/forms';

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
    ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
