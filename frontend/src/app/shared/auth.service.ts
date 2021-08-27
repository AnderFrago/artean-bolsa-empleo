import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import * as moment from 'moment';
import { catchError, filter, map, tap } from 'rxjs/operators';
import { User } from './user';
import { AuthResult } from './authresult';
import { Observable, throwError } from 'rxjs';

import { environment } from './../../environments/environment';
import { FirebaseService } from './firebase.service';
import { DocumentChangeAction } from '@angular/fire/firestore';

@Injectable()
export class AuthService {
  private APIEndpoint = environment.APIEndpoint;

  private authUrl = `https://${this.APIEndpoint}:8000`;
  private privateAuthUrl = `https://${this.APIEndpoint}:8000/api/v1`;

  constructor(
    private http: HttpClient,
    private firebaseService: FirebaseService
  ) {}

  login(username: string, password: string) {
    const headers = new HttpHeaders().set('Content-Type', 'application/json');

    return this.http
      .post<any>(
        this.authUrl + '/login_check',
        { username, password },
        { headers }
      )
      .pipe(
        map((res) => {
          return {
            id_token: res.token,
          };
        }),
        catchError(this.handleError)
      );
  }
  checkProvider(username: string, provider: string) {
    const headers = new HttpHeaders().set('Content-Type', 'application/json');

    return this.http
      .post<AuthResult>(
        this.authUrl + '/provider_check',
        { username, provider },
        { headers }
      )
      .pipe(
        map((res: any) => {
          if (res.message.startsWith('ERROR:')) {
            return null;
          } else return res;
        }),
        catchError(this.handleError)
      );
  }

  register(
    username: string,
    email: string,
    password: string,
    type: string,
    provider: string
  ) {
    const headers = new HttpHeaders().set('Content-Type', 'application/json');

    return this.http
      .post<any>(
        this.authUrl + '/register',
        { username, email, password, type, provider },
        { headers }
      )
      .pipe(
        map((res) => {
          if (typeof res.message !== 'undefined') {
            let error: AuthResult = {
              id_token: '',
              error: {
                message: res.message,
                type: 'error',
              },
            };
            return error;
          } else {
            console.log('registered ' + JSON.stringify(res));
            return res;
          }
        })
      );
  }

  setSession(authResult) {
    const expiresAt = moment().add(authResult.expires_at, 'second');

    // localStorage.setItem('u', authResult.u);
    //localStorage.setItem('r', authResult.r);
    localStorage.setItem('id_token', authResult.id_token);
    //localStorage.setItem('expires_at', JSON.stringify(expiresAt.valueOf()));
    let record = {};
    record['username'] = authResult.u;
    record['role'] = authResult.r;
    record['id_token'] = authResult.id_token;
    record['expires_at'] = JSON.stringify(expiresAt.valueOf());

    this.firebaseService.create_User(record).then((data) => {
      localStorage.setItem('artean_id', data.id);
      this.firebaseService.read_Username();
      this.firebaseService.read_Role(data.id);
    });
  }

  logout() {
    const userId = localStorage.getItem('artean_id');
    this.firebaseService.delete_User(userId);
    localStorage.removeItem('artean_id');

    //localStorage.removeItem('u');
    // localStorage.removeItem('r');
    localStorage.removeItem('id_token');
    //localStorage.removeItem('expires_at');
  }

  isLoggedIn() {
    let now = moment();
    // return now.isBefore(this.getExpiration());
    const userId = localStorage.getItem('artean_id');

    if (userId == null) return false;

    return this.firebaseService.read_Users().subscribe((data) => {
      data.map((e) => {
        if (e.payload.doc.id == userId) {
          const expiration = e.payload.doc.data()['expires_at'];
          const expiresAt = JSON.parse(expiration);
          let expiration_date = moment(expiresAt);
          return now.isBefore(expiration_date);
        }
      });
    });
  }

  isLoggedOut() {
    return !this.isLoggedIn();
  }

  getExpiration() {
    // const expiration = localStorage.getItem('expires_at');
    const userId = localStorage.getItem('artean_id');

    return this.firebaseService.read_Users().subscribe((data) => {
      data.map((e) => {
        if (e.payload.doc.id == userId) {
          const expiration = e.payload.doc.data()['expires_at'];
          const expiresAt = JSON.parse(expiration);
          let expiration_date = moment(expiresAt);
          return expiration_date;
        }
      });
    });
  }

  role(username: string, password: string) {
    const headers = new HttpHeaders().set('Content-Type', 'application/json');

    return this.http
      .post<string[]>(
        this.authUrl + '/role',
        { username, password },
        { headers }
      )
      .pipe(
        tap((res) => {
          console.log('registered ' + JSON.stringify(res));
        })
      );
  }

  getRole() {
    let userId = localStorage.getItem('artean_id');
    if (userId == null) return '';
    //return this.firebaseService.read_Role(userId);

    // return localStorage.getItem('r') === 'ROLE_STUDENT'
    //   ? 's'
    //   : localStorage.getItem('r') === 'ROLE_EMPLOYER'
    //   ? 'e'
    //   : localStorage.getItem('r') === 'ROLE_ARTEAN'
    //   ? 'a'
    //   : '';
  }

  getState() {
    const username = this.firebaseService.get_Username();
    //const username = localStorage.getItem('u');
    const headers = new HttpHeaders().set('Content-Type', 'application/json');
    return this.http
      .post<any>(this.authUrl + '/state', { username }, { headers })
      .pipe(
        tap((res) => {
          console.log('registered ' + JSON.stringify(res));
        }),
        map((data) => {
          return data.state;
        })
      );
  }

  private handleError(err) {
    // in a real world app, we may send the server to some remote logging infrastructure
    // instead of just logging it to the console
    //let errorMessage: string;
    // alert(`An error occurred: ${err.error.message}`);

    // console.error(err.error.message);
    return throwError(new Error(err.error.message));
  }
}
