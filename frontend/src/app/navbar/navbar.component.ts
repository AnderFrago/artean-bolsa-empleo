import { Component, OnInit } from '@angular/core';
import { OfferService } from '../shared/offer.service';
import { Router } from '@angular/router';
import { CvService } from '../shared/cv.service';
import { AuthService } from '../shared/auth.service';

@Component({
  selector: 'navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {

  id: any;
  username: string;

  constructor(
    private cvService: CvService,
    private offerService: OfferService,
    private authService: AuthService,
    private router: Router) { }

  ngOnInit() {
    if (!this.isLoggedIn()) {
      this.authService.logout();
      this.username = "";
      this.router.navigate(['/']);
    } else {
      this.username = localStorage.getItem('u');
    }

  }

  newOffer() {
    // Get max offer Id from the offer list
    this.offerService.getMaxOfferId().subscribe(
      data => {
        this.id = data;
        this.router.navigate(['/offers', ++this.id, 'new']);
      }
    );
  }
  newCv() {
    this.router.navigate(['/cv', 'new']);
  }

  register() {
    this.router.navigate(['/register']);
  }
  login() {
    this.router.navigate(['/login']);
  }
  logout() {
    this.authService.logout();
    this.username = "";
    this.router.navigate(['/']);
  }
  isLoggedIn() {
    return this.authService.isLoggedIn();
  }
  isStudent() {
    return this.authService.getRole() === "s";
  }
  isEmployer() {
    return this.authService.getRole() === "e";
  }

}
