import { Component, OnInit } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { Router } from '@angular/router';
import { ArteanService } from 'src/app/shared/artean.service';
import { AuthService } from 'src/app/shared/auth.service';
import { User, UserState } from 'src/app/shared/user';
import { EmployersStateComponent } from '../employers-state/employers-state.component';


@Component({
  selector: 'app-employers',
  templateUrl: './employers.component.html',
  styleUrls: ['./employers.component.scss']
})
export class EmployersComponent implements OnInit {

  pageTitle="Acceso de empresas"
  employers : any;
  state: UserState;

  constructor(
    private arteanService: ArteanService,
    private authService: AuthService,
    private router: Router,
    public dialog: MatDialog
  ) { }

  ngOnInit(): void {
    this.authService.getState().subscribe(data=>{
      if(data != 1){
        alert("Cuenta no validada");
        this.authService.logout()
        this.router.navigate(['login'])
      }
  });
    this.arteanService.getEmployersNoActivated().subscribe(data=>{
      this.employers = data.employers;
    });
  }
  changeState(employername: string, numstate) {

    this.dialog.open(EmployersStateComponent, {
      data: {
        employername,
        numstate,
      }
    });

    this.dialog.afterAllClosed
      .subscribe(() => this.refreshParent());

  }
  refreshParent(): void {
    this.arteanService.getEmployersNoActivated().subscribe(data=>{
      this.employers = data.employers;
    });
  }

}
