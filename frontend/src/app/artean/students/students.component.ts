import { Component, OnInit } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { Router } from '@angular/router';
import { ArteanService } from 'src/app/shared/artean.service';
import { AuthService } from 'src/app/shared/auth.service';
import { User, UserState } from 'src/app/shared/user';
import { StudentsStateComponent } from '../students-state/students-state.component';

@Component({
  selector: 'app-students',
  templateUrl: './students.component.html',
  styleUrls: ['./students.component.scss']
})
export class StudentsComponent implements OnInit {

  pageTitle="Acceso de estudiantes"
  students : any;
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
    this.arteanService.getStudentsNoActivated().subscribe(data=>{
      this.students = data.students;
    });
  }
  changeState(studentname: string, numstate) {

    this.dialog.open(StudentsStateComponent, {
      data: {
        studentname,
        numstate,
      }
    });

    this.dialog.afterAllClosed
      .subscribe(() => this.refreshParent());

  }
  refreshParent(): void {
    this.arteanService.getStudentsNoActivated().subscribe(data=>{
      this.students = data.students;
    });
  }

}
