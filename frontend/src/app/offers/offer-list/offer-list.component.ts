import { Component, OnInit } from '@angular/core';
import { Offer } from 'src/app/shared/offer';
import { OfferService } from 'src/app/shared/offer.service';

@Component({
  selector: 'app-offer-list',
  templateUrl: './offer-list.component.html',
  styleUrls: ['./offer-list.component.scss']
})
export class OfferListComponent implements OnInit {
  offers: Offer[]=[];
  constructor(private offerService: OfferService) { }

  ngOnInit() {
   this.offerService.getOffers().subscribe(
    (data: Offer[]) => this.offers = data
   );
  }
}