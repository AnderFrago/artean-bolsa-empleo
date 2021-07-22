import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import * as moment from 'moment';
import { AuthService } from '../shared/auth.service';

@Component({
  selector: 'register',
  templateUrl: './register.component.html',
})
export class RegisterComponent {

  form: FormGroup;

  constructor(private fb: FormBuilder,
    private authService: AuthService,
    private router: Router) {

    this.form = this.fb.group({
      username: ['', Validators.required],
      password: ['', Validators.required],
      type: ['', Validators.required]

    });
  }

  register() {
    const val = this.form.value;

    if (val.username && val.password) {
      this.authService.register(val.username, val.password, val.type)
        .subscribe(
          data => {
            data = {
              ...data,
              u: val.username,
              r: val.type
            }
            this.authService.login(val.username, val.password)
              .subscribe(
                data => {
                  data = {
                    ...data,
                    u: val.username,
                  }
                  // Save session: Generate expiration date
                  const expire_moment = moment().add(1, 'days');
                  data.expires_at = JSON.stringify(expire_moment.valueOf())
                  this.authService.role(val.username, val.password).subscribe(r => {
                    data = {
                      ...data,
                      r: r[r.length - 1]
                    }
                    this.authService.setSession(data);
                  }
                  )
                  console.log("User is logged in");
                  this.router.navigateByUrl('/');
                }
              );
          },
          () => {
            console.log("User is registered in");
            this.router.navigateByUrl('/');
          }
        );
    }
  }

}
