import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import { catchError, map, tap } from 'rxjs/operators';
import { User, UserState } from './user';

@Injectable({
  providedIn: 'root'
})
export class ArteanService {

  private arteanUrl = 'https://localhost:8000/api/v1/artean';

  constructor(private http: HttpClient) { }


  updateEmployerState(employername: string, newstate: UserState): Observable<string> {
    const url = `${this.arteanUrl}/employers-update-state` ;
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    const username = localStorage.getItem('u');

    return this.http.post<any>(url, { employername, newstate }, { headers })
      .pipe(
        map(data => {
          if (data.message.startsWith("ERROR:")) {
            return null;
          }
          console.log('stateUpdated: ' + JSON.stringify(data));
          return data.state
        }),
        catchError(this.handleError)
      );

  }


  updateStudentState(studentname: string, newstate: UserState): Observable<string> {
    const url = `${this.arteanUrl}/students-update-state` ;
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    const username = localStorage.getItem('u');

    return this.http.post<any>(url, { studentname, newstate }, { headers })
      .pipe(
        map(data => {
          if (data.message.startsWith("ERROR:")) {
            return null;
          }
          console.log('stateUpdated: ' + JSON.stringify(data));
          return data.state
        }),
        catchError(this.handleError)
      );

  }

  search(keyword: string):Observable<string[]> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const url = `${this.arteanUrl}/search`;

    return this.http.post<any>(url, {keyword})
    .pipe(
      map(
        data => { return data.cvs}
      )
    );
  }

  getStudentsNoActivated():Observable<any> {
    const url = `${this.arteanUrl}/students-pending-activation` ;
    return this.http.get<any>(url)
      .pipe(
        tap(data=>console.log(data),
        map(data => {return data})
        )
      );
  }
  getEmployersNoActivated():Observable<any> {
    const url = `${this.arteanUrl}/employers-pending-activation`;
    return this.http.get<any>(url)
      .pipe(
        tap(data=>console.log(data),
        map(data => {
          return data;
        })
        )
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
