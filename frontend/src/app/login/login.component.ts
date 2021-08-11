import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import * as moment from "moment";
import { AuthService } from '../shared/auth.service';
import { AlertsComponent } from "../alerts/alerts.component";
import { MatDialog } from '@angular/material/dialog';
import { MatSpinner } from '@angular/material/progress-spinner';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
})
export class LoginComponent {

  form: FormGroup;
  isFormSubmitted: boolean = false;

  isDisabled = true;

  constructor(private fb: FormBuilder,
    private authService: AuthService,
    private router: Router,
    public dialog: MatDialog
    ) {

    this.form = this.fb.group({
      email: ['', Validators.required],
      password: ['', Validators.required]
    });
  }

  login() {
    const val = this.form.value;

    if (val.email && val.password) {

      this.isFormSubmitted = true;

      this.authService.login(val.email, val.password)
        .subscribe(        
          data => { 
            this.isFormSubmitted = false;
            data = {
              ...data,
              u: val.email,
            }
            // Save session: Generate expiration date
            const expire_moment = moment().add(1, 'days');
            data.expires_at = JSON.stringify(expire_moment.valueOf())
            this.authService.role(val.email, val.password).subscribe(r => {
              data = {
                ...data,
                r: r[r.length - 1]
              }
              this.authService.setSession(data);
            }
            )
            console.log("User is logged in");
            this.router.navigateByUrl('/');
          },
          error=>{
            this.isFormSubmitted = false;
            this.dialog.open(AlertsComponent, {
              data: {
                  item: `${error}`,
                  type: "error"
              }
              });
          },
        );
    }
  }

}
