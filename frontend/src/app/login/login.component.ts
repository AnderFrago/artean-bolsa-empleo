import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import * as moment from 'moment';
import { AuthService } from '../shared/auth.service';
import { MatDialog } from '@angular/material/dialog';
import { MatSpinner } from '@angular/material/progress-spinner';
import { SocialAuthService } from 'angularx-social-login';
import { GoogleLoginProvider } from 'angularx-social-login';
import { SocialUser } from 'angularx-social-login';
import { AuthResult } from '../shared/authresult';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
})
export class LoginComponent {
  form: FormGroup;
  isFormSubmitted: boolean = false;

  isDisabled = true;

  user: SocialUser;
  data: AuthResult;
  provider: string = 'ARTEAN';

  constructor(
    private fb: FormBuilder,
    private authService: AuthService,
    private socialAuthService: SocialAuthService,
    private router: Router,
    public dialog: MatDialog,
    private toastrService: ToastrService
  ) {
    this.form = this.fb.group({
      username: ['', Validators.required],
      password: ['', Validators.required],
    });
  }

  signInWithGoogle(): void {
    this.socialAuthService
      .signIn(GoogleLoginProvider.PROVIDER_ID)
      .then((user) => {
        this.user = user;
        this.data = {
          ...this.data,
          u: user.name,
        };
        this.provider = 'GOOGLE';
        this.authService.login(user.name, user.id).subscribe((d) => {
          this.data = {
            ...this.data,
            id_token: d.id_token,
          };
          // Check provider
          this.authService
            .checkProvider(user.name, this.provider)
            .subscribe((p) => {
              if (typeof p != 'undefined') {
                this.saveSession(user.name, user.id);
                console.log('User is logged in');
                this.router.navigateByUrl('/');
              }
            });
        });
      });
  }

  signOut(): void {
    this.socialAuthService.signOut();
  }

  login() {
    const val = this.form.value;

    if (val.username && val.password) {
      this.isFormSubmitted = true;

      this.authService.login(val.username, val.password).subscribe(
        (d) => {
          // Check provider
          this.authService
            .checkProvider(val.username, this.provider)
            .subscribe((p) => {
              if (typeof p != 'undefined') {
                this.data = {
                  ...this.data,
                  id_token: d.id_token,
                  u: val.username,
                };
                this.saveSession(val.username, val.password);
                console.log('User is logged in');
                this.router.navigateByUrl('/');
              } else {
                // Clear Google
                this.socialAuthService.signOut();
              }
            });
        },
        (error) => {
          this.isFormSubmitted = false;
          this.toastrService.error(`${error}`, 'ERROR:');
        }
      );
    }
  }

  saveSession(username, password) {
    // Save session: Generate expiration date
    const expire_moment = moment().add(1, 'days');
    this.data.expires_at = JSON.stringify(expire_moment.valueOf());
    this.authService.role(username, password).subscribe((r) => {
      this.data = {
        ...this.data,
        r: r[r.length - 1],
      };
      this.authService.setSession(this.data);
    });
  }
}
