import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { catchError, filter, map, tap } from 'rxjs/operators';
import { throwError } from 'rxjs';

import { environment } from './../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class MailerService {
  private emailUrl = `https://${environment.APIEndpoint}:8000/api/v1/email`;

  constructor(private http: HttpClient) {}

  statusChanged() {
    const username = localStorage.getItem('u');
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    return (
      this.http
        .post<any>(this.emailUrl + `/status-changed`, { username }, { headers })
        .pipe(
          tap((res) => {
            console.log('statusChanged ' + JSON.stringify(res));
          })
        ),
      catchError(this.handleError)
    );
  }
  accountValidated() {
    const username = localStorage.getItem('u');
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    return (
      this.http
        .post<any>(
          this.emailUrl + `/account-validated`,
          { username },
          { headers }
        )
        .pipe(
          tap((res) => {
            console.log('accountValidated ' + JSON.stringify(res));
          })
        ),
      catchError(this.handleError)
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
