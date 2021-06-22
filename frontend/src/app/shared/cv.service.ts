import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

import { Observable, of, throwError } from 'rxjs';
import { catchError, tap, map } from 'rxjs/operators';

import { Cv } from './cv';

@Injectable({
  providedIn: 'root'
})
export class CvService {
  private cvsUrl = 'api/cvs';

  constructor(private http: HttpClient) { }

  getCvs(): Observable<Cv[]> {
    return this.http.get<Cv[]>(this.cvsUrl)
      .pipe(
        tap(data => console.log(JSON.stringify(data))),
        catchError(this.handleError)
      );
  }

  getMaxCvId(): Observable<Cv> {
    return this.http.get<Cv[]>(this.cvsUrl)
    .pipe(
      // Get max value from an array
      map(data => Math.max.apply(Math, data.map(function(o) { return o.id; }))   ),
      catchError(this.handleError)
    );
  }

  getCvById(id: number): Observable<Cv> {
    const url = `${this.cvsUrl}/${id}`;
    return this.http.get<Cv>(url)
      .pipe(
        tap(data => console.log('getCv: ' + JSON.stringify(data))),
        catchError(this.handleError)
      );
  }

  createCv(cv: Cv): Observable<Cv> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    cv.id = null;
    return this.http.post<Cv>(this.cvsUrl, cv, { headers: headers })
      .pipe(
        tap(data => console.log('createCv: ' + JSON.stringify(data))),
        catchError(this.handleError)
      );
  }

  deleteCv(id: number): Observable<{}> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const url = `${this.cvsUrl}/${id}`;
    return this.http.delete<Cv>(url, { headers: headers })
      .pipe(
        tap(data => console.log('deleteCv: ' + id)),
        catchError(this.handleError)
      );
  }

  updateCv(cv: Cv): Observable<Cv> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const url = `${this.cvsUrl}/${cv.id}`;
    return this.http.put<Cv>(url, cv, { headers: headers })
      .pipe(
        tap(() => console.log('updateCv: ' + cv.id)),
        // Return the cv on an update
        map(() => cv),
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
