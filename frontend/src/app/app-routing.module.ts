import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { HomeComponent } from './home/home.component';


@NgModule({
  imports: [
    RouterModule.forRoot([
      { path: '', redirectTo: 'home', pathMatch: 'full' },
      { path: 'home', component: HomeComponent },
      {
        path: 'offers',
        loadChildren: () =>
          import('./offers/offer.module').then(m => m.OfferModule)
      },
      {
        path: 'cvs',
        loadChildren: () =>
          import('./cvs/cv.module').then(m => m.CvModule)
      },
    ])
  ],
  exports: [RouterModule]
})
export class AppRoutingModule { }
