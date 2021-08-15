import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { NgModule } from '@angular/core';
import { ReactiveFormsModule } from '@angular/forms';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { CvModule } from './cvs/cv.module';
import { FooterComponent } from './footer/footer.component';
import { HomeComponent } from './home/home.component';
import { NavbarComponent } from './navbar/navbar.component';
import { OfferModule } from './offers/offer.module';
import { CvService } from './shared/cv.service';
import { OfferService } from './shared/offer.service';

import { LoginComponent } from './login/login.component';
import { AuthService } from './shared/auth.service';
import { RegisterComponent } from './register/register.component';
import { AuthInterceptor } from './shared/auth.interceptor';
import { AuthGuard } from './shared/auth-guard.service';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { MatButtonModule } from '@angular/material/button';
import { ApplymentsModule } from './applyments/applyments.module';
import { ArteanModule } from './artean/artean.module';
import { ArteanService } from './shared/artean.service';
import { AlertsComponent } from './alerts/alerts.component';
import { MatDialogModule } from '@angular/material/dialog';
import { MatProgressSpinnerModule, MatSpinner } from '@angular/material/progress-spinner';

import { SocialLoginModule, SocialAuthServiceConfig } from 'angularx-social-login';
import {
  GoogleLoginProvider,
  //FacebookLoginProvider
} from 'angularx-social-login';


@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    FooterComponent,
    NavbarComponent,
    LoginComponent,
    RegisterComponent,
    AlertsComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    ReactiveFormsModule,
    HttpClientModule,
    OfferModule,
    CvModule,
    ApplymentsModule,
    ArteanModule,
    BrowserAnimationsModule,
    MatButtonModule,
    MatDialogModule,
    MatProgressSpinnerModule,
    SocialLoginModule

  ],
  providers: [OfferService, CvService, AuthService, ArteanService,
    AuthGuard,
    {
      provide: HTTP_INTERCEPTORS,
      useClass: AuthInterceptor,
      multi: true
    },
    {
      provide: 'SocialAuthServiceConfig',
      useValue: {
        autoLogin: false,
        providers: [
          {
            id: GoogleLoginProvider.PROVIDER_ID,
            provider: new GoogleLoginProvider(
              '944387348450-2t0jjcie7lerot31je2btibf80ac0erh.apps.googleusercontent.com'
            )
          },
          // {
          //   id: FacebookLoginProvider.PROVIDER_ID,
          //   provider: new FacebookLoginProvider('clientId')
          // }
        ],
        onError: (err) => {
          console.error(err);
        }
      } as SocialAuthServiceConfig,
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
