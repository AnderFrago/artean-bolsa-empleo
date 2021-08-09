import { Injectable } from '@angular/core';
import { HttpClient, HttpEventType, HttpHeaders } from '@angular/common/http';

import { Observable, of, throwError } from 'rxjs';
import { catchError, tap, map, finalize } from 'rxjs/operators';

import { Offer, OfferState } from './offer';

@Injectable({
  providedIn: 'root'
})
export class OfferService {
  private offersUrlPublic = 'https://localhost:8000/offers';
  private offersUrl = 'https://localhost:8000/api/v1/offers';
  private offersUrlPrivate = 'https://localhost:8000/api/v1/p/offers';


  constructor(private http: HttpClient) { }

  loadOffer(fileName: any) {
    const url = `${this.offersUrl}/load-offer`;
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    const username = localStorage.getItem('u');

    return this.http.post<any>(url, { username, fileName }, { headers })
      .pipe(
        map(data => {
          if (data.message.startsWith("ERROR:")) {
            return null;
          }
          console.log('loadOffer: ' + JSON.stringify(data));
          return data.file
        }),
        catchError(this.handleError)
      );
  }


  getOffers(): Observable<Offer[]> {
    return this.http.get<Offer[]>(this.offersUrlPublic)
      .pipe(
        tap(data => console.log(JSON.stringify(data))),
        catchError(this.handleError)
      );
  }


  getOfferById(id: number): Observable<any> {
    const url = `${this.offersUrlPrivate}/${id}`;
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });

    const username = localStorage.getItem('u');
    const password = localStorage.getItem('token');

    return this.http.post<any>(url, { username, password }, { headers })
      .pipe(
        map(data => {
          if (data.message.startsWith("ERROR:")) {
            return null;
          }
          console.log('getOffer: ' + JSON.stringify(data));
          return data;
        }),
        catchError(this.handleError)
      );
  }


  createOffer(offer: Offer): Observable<Offer> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    offer.id = null;
    console.log(offer);

    return this.http.post<any>(this.offersUrl, JSON.stringify(offer), { headers: headers })
      .pipe(
        tap(data => console.log('createOffer: ' + JSON.stringify(data))),
        map(data => {
          return data.offer;
        }),
        catchError(this.handleError)
      );
  }

  createOfferPDF(formData: FormData) {
    const username = localStorage.getItem('u');

    return this.http.post(this.offersUrl + "/offer-upload?username=" + username, formData, {
      // headers,
      reportProgress: true,
      observe: 'events'
    })
      .pipe(
        finalize(() => {
          return HttpEventType.Sent;
        })
      );

  }

  deleteOffer(id: number): Observable<{}> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const url = `${this.offersUrl}/${id}`;
    return this.http.delete<Offer>(url, { headers: headers })
      .pipe(
        tap(data => console.log('deleteOffer: ' + id)),
        map(data => {return data}),
        catchError(this.handleError)
      );
  }

  updateOffer(offer: Offer): Observable<Offer> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const url = `${this.offersUrl}/${offer.id}`;
    return this.http.put<Offer>(url, offer, { headers: headers })
      .pipe(
        tap(() => console.log('updateOffer: ' + offer.id)),
        // Return the offer on an update
        map(data => {
          return data;
        }),
        catchError(this.handleError)
      );
  }


  apply(offer: Offer): Observable<OfferState> {
    const username = localStorage.getItem('u');
    const token = localStorage.getItem('token');
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const url = `${this.offersUrlPrivate}/apply`;
    return this.http.post<any>(url, { username, id: offer.id }, { headers: headers })
      .pipe(
        tap(() => console.log('updateOffer: ' + offer.id)),
        map(data => {
          if (data.message == 'CANCEL: Already applied') {
            return null
          }
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
