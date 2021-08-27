import { Injectable } from '@angular/core';
import { HttpClient, HttpEventType, HttpHeaders } from '@angular/common/http';

import { Observable, of, Subscription, throwError } from 'rxjs';
import { catchError, tap, map, finalize } from 'rxjs/operators';

import { environment } from './../../environments/environment';
import { FirebaseService } from './firebase.service';

@Injectable({
  providedIn: 'root',
})
export class CvService {
  private APIEndpoint = environment.APIEndpoint;

  private cvsUrl = `https://${this.APIEndpoint}:8000/api/v1`;

  constructor(
    private http: HttpClient,
    private firebaseService: FirebaseService
  ) {}

  createCV(formData: FormData) {
    const username = this.firebaseService.get_Username();
    // const username = localStorage.getItem('u');

    return this.http
      .post(this.cvsUrl + '/cv-upload?username=' + username, formData, {
        // headers,
        reportProgress: true,
        observe: 'events',
      })
      .pipe(
        finalize(() => {
          return HttpEventType.Sent;
        })
      );
  }

  showCvByFileName(fileName: any) {
    const url = `${this.cvsUrl}/cv-filename`;
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const username = this.firebaseService.get_Username();
    // const username = localStorage.getItem('u');

    return this.http.post<any>(url, { username, fileName }, { headers }).pipe(
      map((data) => {
        if (data.message.startsWith('ERROR:')) {
          return null;
        }
        console.log('showCvByUsername: ' + JSON.stringify(data));
        return data.file;
      }),
      catchError(this.handleError)
    );
  }

  showCv() {
    const url = `${this.cvsUrl}/cv-show`;
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    const username = this.firebaseService.get_Username();
    // const username = localStorage.getItem('u');

    return this.http.post<any>(url, { username }, { headers }).pipe(
      map((data) => {
        if (data.message.startsWith('ERROR:')) {
          return null;
        }
        console.log('show cv : ' + JSON.stringify(data));
        return data.file;
      }),
      catchError(this.handleError)
    );
  }

  private handleError(err) {
    // in a real world app, we may send the server to some remote logging infrastructure
    // instead of just logging it to the console
    let errorMessage: string;
    if (err.error instanceof ErrorEvent) {
      // A client-side or network error occurred. Handle it accordingly.
      errorMessage = `An error occurred: ${err.error.message}`;
    } else {
      // The backend returned an unsuccessful response code.
      // The response body may contain clues as to what went wrong,
      errorMessage = `Backend returned code ${err.status}: ${err.body.error}`;
    }
    console.error(err);
    return throwError(errorMessage);
  }
}
