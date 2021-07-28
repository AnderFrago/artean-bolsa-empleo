import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { AuthGuard } from './shared/auth-guard.service';


@NgModule({
  imports: [
    RouterModule.forRoot([
      { path: '', redirectTo: 'home', pathMatch: 'full' },
      { path: 'home', component: HomeComponent },
      { path: 'register', component: RegisterComponent },
      { path: 'login', component: LoginComponent },
      {
        path: 'artean',
        loadChildren: () =>
          import('./artean/artean.module').then(m => m.ArteanModule),
        canActivate: [AuthGuard]
      },
      {
        path: 'offers',
        loadChildren: () =>
          import('./offers/offer.module').then(m => m.OfferModule),
        canActivate: [AuthGuard]
      },
      {
        path: 'cvs',
        loadChildren: () =>
          import('./cvs/cv.module').then(m => m.CvModule),
        canActivate: [AuthGuard]
      },
      {
        path: 'applyments',
        loadChildren: () =>
          import('./applyments/applyments.module').then(m => m.ApplymentsModule),
        canActivate: [AuthGuard]
      },
    ])
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
