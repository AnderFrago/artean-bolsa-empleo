import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import { map, catchError } from 'rxjs/operators';
import { AlertsComponent } from '../alerts/alerts.component';
import { CV, CVState } from './cv';
import { OfferState } from './offer';
import { MatDialog } from '@angular/material/dialog';
import { environment } from './../../environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ApplymentsService {
  private APIEndpoint = environment.APIEndpoint;

  private applymentsUrl = `https://${this.APIEndpoint}:8000/api/v1/applyments`;

  constructor(
    private http: HttpClient,
  public dialog: MatDialog
  ) { }

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
//            alert(data.message);
          this.dialog.open(AlertsComponent, {
            data: {
              item: data.message,
              type: "error"
            }
          });
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
