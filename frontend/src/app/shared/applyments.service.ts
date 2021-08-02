import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import { map, catchError } from 'rxjs/operators';
import { CV, CVState } from './cv';
import { OfferState } from './offer';

@Injectable({
  providedIn: 'root'
})
export class ApplymentsService {

  private applymentsUrl = 'https://localhost:8000/api/v1/applyments';

  constructor(private http: HttpClient) { }

  updateApplymentState(offerId: number, newstate: CVState, studentname: string): Observable<string> {
    const url = `${this.applymentsUrl}/update-state` ;
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    const username = localStorage.getItem('u');

    return this.http.post<any>(url, { offerId, newstate, studentname }, { headers })
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


  getCVsForOffer(id: number): Observable<CV[]> {
    const url = `${this.applymentsUrl}/cvs-offer` ;
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    const username = localStorage.getItem('u');

    return this.http.post<any>(url, { username, id }, { headers })
      .pipe(
        map(data => {
          if (data.message.startsWith("ERROR:")) {
            return null;
          }
          console.log('getCvs: ' + JSON.stringify(data));
          return data.cvs
        }),
        catchError(this.handleError)
      );

  }


  getApplymentState(id: number) {
    const url = `${this.applymentsUrl}/state`;
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    const username = localStorage.getItem('u');

    return this.http.post<any>(url, { username, id }, { headers })
      .pipe(
        map(data => {
          if (data.message.startsWith("ERROR:")) {
            alert(data.message);
            return null;
          }
          console.log('getOffer: ' + JSON.stringify(data));
          const numState = +data.message.split(' ')[1];
          switch (numState) {
            case 0: return OfferState.NoApplied;
            case 1: return OfferState.Applied;
            case 2: return OfferState.WaitingResponse;
            case 3: return OfferState.Discard;
            case 4: return OfferState.Selected;
          }
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
