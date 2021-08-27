import { Component, OnInit } from '@angular/core';
import { OfferService } from '../shared/offer.service';
import { Router } from '@angular/router';
import { CvService } from '../shared/cv.service';
import { AuthService } from '../shared/auth.service';
import { saveAs } from 'file-saver';
import { FirebaseService } from '../shared/firebase.service';

@Component({
  selector: 'navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css'],
})
export class NavbarComponent implements OnInit {
  id: any;
  username: string;

  constructor(
    private cvService: CvService,
    private offerService: OfferService,
    private authService: AuthService,
    private router: Router,
    private firebaseService: FirebaseService
  ) {}

  ngOnInit() {
    if (!this.isLoggedIn()) {
      this.authService.logout();
      this.firebaseService.clear_Username();
      this.username = '';
      this.router.navigate(['/home']);
    } else {
      this.firebaseService.read_Username();
      this.username = this.firebaseService.get_Username();
      this.firebaseService.read_Role();
    }
  }

  newOffer() {
    this.router.navigate(['/offers', 'new']);
  }
  newCv() {
    this.router.navigate(['/cv', 'new']);
  }
  showCv() {
    this.cvService.showCv().subscribe((data) => {
      saveAs(data.file, data.fileName, { type: 'application/pdf' });
    });
  }
  search() {
    this.router.navigate(['/artean']);
  }
  mngStudents() {
    this.router.navigate(['/artean', 'students']);
  }
  mngEmployers() {
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
    this.username = '';
    this.router.navigate(['/home']);
  }
  isLoggedIn() {
    return this.authService.isLoggedIn();
  }
  isStudent() {
    return this.firebaseService.check_RoleStudent();
  }
  isEmployer() {
    return this.firebaseService.check_RoleEmployer();
  }
  isArtean() {
    return this.firebaseService.check_RoleArtean();
  }

  hasUsername() {
    this.username = this.firebaseService.get_Username();
    if (this.username != null) return true;
    return false;
  }
}
