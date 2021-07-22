import { Component, OnInit } from '@angular/core';
import { MatIconRegistry } from '@angular/material/icon';
import { DomSanitizer } from '@angular/platform-browser';
import { ActivatedRoute, Router } from '@angular/router';
import { ApplymentsService } from 'src/app/shared/applyments.service';
import { AuthService } from 'src/app/shared/auth.service';
import { Offer, OfferState } from 'src/app/shared/offer';
import { OfferService } from 'src/app/shared/offer.service';
import { saveAs } from 'file-saver';

@Component({
  selector: 'app-offer-detail',
  templateUrl: './offer-detail.component.html',
  styleUrls: ['./offer-detail.component.scss']
})
export class OfferDetailComponent implements OnInit {

  offer: Offer;
  offerId: number;
  isOwner = false;
  isStudent = false;
  offerState: OfferState;

  constructor(
    private activatedroute: ActivatedRoute,
    private router: Router,
    private offerService: OfferService,
    private authService: AuthService,
    private applymentsService: ApplymentsService,
    iconRegistry: MatIconRegistry, sanitizer: DomSanitizer,

  ) {

    iconRegistry.addSvgIcon(
      'file-down',
      sanitizer.bypassSecurityTrustResourceUrl('assets/images/filedown-icon.svg'));

  }

  ngOnInit() {
    this.offerId = parseInt(this.activatedroute.snapshot.params['id']);
    this.offerService.getOfferById(this.offerId).subscribe(data => {
      if (data.message.includes("owner")) {
        this.isOwner = true;
      }
      this.offer = data.offer;
    });
    this.isStudent = this.authService.getRole() === "s";

    this.applymentsService.getApplymentState(this.offerId).subscribe(data => {
      this.offerState = data;
    });

  }


  loadOffer(fileName) {
    this.offerService.loadOffer(fileName).subscribe(data => {
      saveAs(data.file, fileName, { type: "application/pdf" });
    });
  }


  apply() {
    this.offerService.apply(this.offer).subscribe(
      data => {
        console.log(data);
        if (data != null) {
          this.offerState = data;
        }
      }
    );
    // TODO Treatment of response
  }

  goEdit(): void {
    this.router.navigate(['/offers', this.offerId, 'edit']);
  }
  goDelete(): void {
    this.offerService.deleteOffer(this.offerId).subscribe(
      () => this.router.navigate([''])
    );
  }
  goManage(): void {
    this.router.navigate(['/applyments', this.offerId, 'manage']);
  }

  onBack(): void {
    this.router.navigate(['']);
  }

}


