import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { OfferItemComponent } from './offer-item/offer-item.component';
import { OfferListComponent } from './offer-list/offer-list.component';
import { OfferNewComponent } from './offer-new/offer-new.component';
import { OfferDetailComponent } from './offer-detail/offer-detail.component';
import { OfferRoutingModule } from './offer-routing.module';
import { OfferEditComponent } from './offer-edit/offer-edit.component';
import { MatCardModule } from '@angular/material/card';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';

@NgModule({
    imports: [
        CommonModule,
        ReactiveFormsModule,
        OfferRoutingModule,
        FormsModule,
        MatCardModule,
        MatButtonModule,
        MatIconModule
    ],
    exports: [
        OfferListComponent,
    ],
    declarations: [
        OfferItemComponent,
        OfferListComponent,
        OfferNewComponent,
        OfferDetailComponent,
        OfferEditComponent
    ],
    providers: [],
})
export class OfferModule { }
