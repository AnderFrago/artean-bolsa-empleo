import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { AuthGuard } from '../shared/auth-guard.service';
import { OfferDetailComponent } from './offer-detail/offer-detail.component';
import { OfferListComponent } from './offer-list/offer-list.component';
import { OfferNewComponent } from './offer-new/offer-new.component';
import { OfferEditComponent } from './offer-edit/offer-edit.component';


const routes: Routes = [
  {
    path: '',
    component: OfferListComponent
  },
  { path: 'offers/:id/new', component: OfferNewComponent, canActivate: [AuthGuard] },
  { path: 'offers/:id', component: OfferDetailComponent, canActivate: [AuthGuard] },
  { path: 'offers/:id/edit', component: OfferEditComponent, canActivate: [AuthGuard] }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class OfferRoutingModule { }