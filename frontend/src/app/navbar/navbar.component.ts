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
    this.router.navigate(['/offers','new']);
  }
  newCv() {
    this.router.navigate(['/cv', 'new']);
  }
  search() {
    this.router.navigate(['/artean']);
  }
  mngStudents(){
    this.router.navigate(['/artean', 'students']);
  }
  mngEmployers(){
    this.router.navigate(['/artean', 'employers']);
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
  isArtean() {
    return this.authService.getRole() === "a";
  }

}
