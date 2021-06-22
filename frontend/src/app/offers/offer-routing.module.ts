import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { OfferDetailComponent } from './offer-detail/offer-detail.component';
import { OfferListComponent } from './offer-list/offer-list.component';
import { OfferNewComponent } from './offer-new/offer-new.component';


const routes: Routes = [
  {
    path: '',
    component: OfferListComponent
  },
  {path: 'offers/:id/new', component: OfferNewComponent},
  {path: 'offers/:id', component: OfferDetailComponent},
  {path: 'offers/:id/edit', component: OfferListComponent}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class OfferRoutingModule {}