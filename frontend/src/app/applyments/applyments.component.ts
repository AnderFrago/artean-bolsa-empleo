import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

import { ApplymentsService } from '../shared/applyments.service';
import { CV, CVState } from '../shared/cv';
import { Offer } from '../shared/offer';

import { saveAs } from 'file-saver';
import { DomSanitizer } from '@angular/platform-browser';
import { MatIconRegistry } from '@angular/material/icon';
import { MatDialog } from '@angular/material/dialog';
import { ApplymentsStateComponent } from './applyments-state/applyments-state.component';
import { AuthService } from '../shared/auth.service';



@Component({
  selector: 'app-applyments',
  templateUrl: './applyments.component.html',
  styleUrls: ['./applyments.component.scss']
})
export class ApplymentsComponent implements OnInit {

  offerId: number;
  cvs: CV[];
  displayedColumns: string[] = ['username', 'file', 'state', 'action'];
  state: CVState;

  constructor(
    private authService: AuthService,
    private applymentsService: ApplymentsService,
    private activatedroute: ActivatedRoute,
    private router: Router,
    iconRegistry: MatIconRegistry, sanitizer: DomSanitizer,
    public dialog: MatDialog
  ) {
    iconRegistry.addSvgIcon(
      'file-down',
      sanitizer.bypassSecurityTrustResourceUrl('assets/images/filedown-icon.svg'));

  }

  ngOnInit(): void {
    this.authService.getState().subscribe(data=>{
        if(data != 1){
          alert("Cuenta no validada");
          this.authService.logout()
          this.router.navigate(['login'])
        }
    });
    this.offerId = parseInt(this.activatedroute.snapshot.params['id']);
    this.applymentsService.getCVsForOffer(this.offerId).subscribe(data => {
      this.cvs = data;
    });
  }

  loadCV(fileName) {
    this.applymentsService.loadCV(fileName).subscribe(data => {
      saveAs(data.file, fileName, { type: "application/pdf" });
    });
  }

  changeState(studentname: string, numstate) {

    this.dialog.open(ApplymentsStateComponent, {
      data: {
        numstate,
        offerId: this.offerId,
        studentname,
      }
    });

    this.dialog.afterAllClosed
      .subscribe(() => this.refreshParent());

  }
  refreshParent(): void {
    this.applymentsService.getCVsForOffer(this.offerId).subscribe(data => {
      this.cvs = data;
    });
  }

}

