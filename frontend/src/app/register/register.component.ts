import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import * as moment from 'moment';
import { AuthService } from '../shared/auth.service';
import { MatSpinner } from '@angular/material/progress-spinner';
import { SocialAuthService } from 'angularx-social-login';
import { GoogleLoginProvider } from 'angularx-social-login';
import { SocialUser } from 'angularx-social-login';
import { AuthResult } from '../shared/authresult';
import { MatDialog } from '@angular/material/dialog';
import { AlertsComponent } from '../alerts/alerts.component';

@Component({
  selector: 'register',
  templateUrl: './register.component.html',
})
export class RegisterComponent {
  form: FormGroup;
  formGoogle: FormGroup;
  isFormSubmitted = false;
  user: SocialUser;
  data: AuthResult;
  provider: string = 'ARTEAN';

  constructor(
    private fb: FormBuilder,
    private authService: AuthService,
    private socialAuthService: SocialAuthService,
    private router: Router,
    public dialog: MatDialog
  ) {
    this.form = this.fb.group({
      username: ['', Validators.required],
      email: ['', Validators.required],
      password: ['', Validators.required],
      type: ['', Validators.required],
    });

    this.formGoogle = this.fb.group({
      typeGoogle: ['', Validators.required],
    });
  }

  registerWithGoogle(): void {
    const val = this.formGoogle.value;
    if (val.typeGoogle != '') {
      this.socialAuthService
        .signIn(GoogleLoginProvider.PROVIDER_ID)
        .then((user) => {
          this.user = user;
          this.data = {
            id_token: user.idToken,
            u: user.email,
          };
          this.provider = user.provider;
          this.authService
            .register(
              user.name,
              user.email,
              user.id,
              val.typeGoogle,
              this.provider
            )
            .subscribe(
              (d) => {
                // User already exists
                if (typeof d.error != 'undefined') {
                  this.isFormSubmitted = false;
                  this.dialog.open(AlertsComponent, {
                    data: {
                      item: `${d.error.message}`,
                      type: 'error',
                    },
                  });
                }

                this.data = {
                  ...d,
                  u: user.email,
                  r: val.typeGoogle,
                };
                this.authService.login(user.name, user.id).subscribe((d) => {
                  // Check provider
                  this.authService
                    .checkProvider(user.name, this.provider)
                    .subscribe((p) => {
                      this.data = {
                        ...this.data,
                        id_token: d.id_token,
                        u: user.email,
                      };
                      this.saveSession(user.name, user.id);
                      console.log('User is logged in');
                      this.router.navigateByUrl('/');
                    });
                });
              },
              (error) => {
                this.isFormSubmitted = false;
                this.dialog.open(AlertsComponent, {
                  data: {
                    item: `${error}`,
                    type: 'error',
                  },
                });
              }
            );
        });
    }
  }

  signOut(): void {
    this.socialAuthService.signOut();
  }

  register() {
    const val = this.form.value;

    if (val.email && val.password) {
      this.isFormSubmitted = true;

      this.authService
        .register(
          val.username,
          val.email,
          val.password,
          val.type,
          this.provider
        )
        .subscribe((d) => {
          if (typeof d.error !== 'undefined') {
            this.isFormSubmitted = false;
            this.dialog.open(AlertsComponent, {
              data: {
                item: `${d.error.message}`,
                type: 'error',
              },
            });
          } else {
            this.data = {
              ...d,
              u: val.username,
              r: val.type,
            };
            this.authService
              .login(val.username, val.password)
              .subscribe((d) => {
                this.data = {
                  ...this.data,
                  id_token: d.id_token,
                  u: val.email,
                };
                this.saveSession(val.username, val.password);
                console.log('User is logged in');
                this.router.navigateByUrl('/');
              });
          }
        });
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
