import { Component, Input, OnInit } from '@angular/core';
import { Offer } from 'src/app/shared/offer';
import { OfferService } from 'src/app/shared/offer.service';

@Component({
  selector: 'app-offer-item',
  templateUrl: './offer-item.component.html',
  styleUrls: ['./offer-item.component.scss']
})
export class OfferItemComponent implements OnInit {

  @Input() offer: Offer;

  constructor(private offerService: OfferService) { }

  ngOnInit(): void {
    if (typeof this.offer.numberOfApplyments === 'undefined') {
      this.offer.numberOfApplyments = 0;
    }
    console.log(this.offer);
  }


}
