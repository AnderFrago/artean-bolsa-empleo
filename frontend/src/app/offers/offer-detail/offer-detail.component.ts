import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Offer } from 'src/app/shared/offer';
import { OfferService } from 'src/app/shared/offer.service';

@Component({
  selector: 'app-offer-detail',
  templateUrl: './offer-detail.component.html',
  styleUrls: ['./offer-detail.component.scss']
})
export class OfferDetailComponent implements OnInit {

  offer: Offer;
  prodId: number;

  constructor(private activatedroute: ActivatedRoute, private router: Router, private offerService: OfferService) {}

  ngOnInit() {
    this.prodId = parseInt(this.activatedroute.snapshot.params['id']);
    this.offerService.getOfferById(this.prodId).subscribe(
      (data: Offer) => this.offer = data
    );
  }
  goEdit():void{
    this.router.navigate(['/offers', this.prodId, 'edit']);
  }
  onBack(): void {
    this.router.navigate(['']);
  }

}
