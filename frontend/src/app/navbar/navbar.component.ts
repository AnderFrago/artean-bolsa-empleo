import { Component, OnInit } from '@angular/core';
import { OfferService } from '../shared/offer.service';
import { Router } from '@angular/router';
import { CvService } from '../shared/cv.service';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {

  id : any;

  constructor(
    private cvService: CvService, 
    private offerService: OfferService, 
    private router: Router) { }

  ngOnInit() {
  }

  newOffer(){
      // Get max offer Id from the offer list
      this.offerService.getMaxOfferId().subscribe(
        data => {
          this.id = data;
          this.router.navigate(['/offers', ++this.id, 'new']);
        }
      );
  }
  newCv(){
    // Get max offer Id from the offer list
    this.cvService.getMaxCvId().subscribe(
      data => {
        this.id = data;
        this.router.navigate(['/cvs', ++this.id, 'new']);
      }
    );
}

}
