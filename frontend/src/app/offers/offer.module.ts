import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { OfferItemComponent } from './offer-item/offer-item.component';
import { OfferListComponent } from './offer-list/offer-list.component';
import { OfferNewComponent } from './offer-new/offer-new.component';
import { OfferDetailComponent } from './offer-detail/offer-detail.component';
import { OfferRoutingModule } from './offer-routing.module';


@NgModule({
    imports: [
        CommonModule,
        ReactiveFormsModule,
        OfferRoutingModule,
        FormsModule
    ],
    exports: [
        OfferListComponent
    ],
    declarations: [
        OfferItemComponent,
        OfferListComponent,
        OfferNewComponent,
        OfferDetailComponent
    ],
    providers: [],
})
export class OfferModule { }
