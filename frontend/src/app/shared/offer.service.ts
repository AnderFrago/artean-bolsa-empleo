import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

import { Observable, of, throwError } from 'rxjs';
import { catchError, tap, map } from 'rxjs/operators';

import { Offer } from './offer';

@Injectable({
  providedIn: 'root'
})
export class OfferService {
  private offersUrl = 'api/offers';

  constructor(private http: HttpClient) { }

  getOffers(): Observable<Offer[]> {
    return this.http.get<Offer[]>(this.offersUrl)
      .pipe(
        tap(data => console.log(JSON.stringify(data))),
        catchError(this.handleError)
      );
  }

  getMaxOfferId(): Observable<Offer> {
    return this.http.get<Offer[]>(this.offersUrl)
    .pipe(
      // Get max value from an array
      map(data => Math.max.apply(Math, data.map(function(o) { return o.id; }))   ),
      catchError(this.handleError)
    );
  }

  getOfferById(id: number): Observable<Offer> {
    const url = `${this.offersUrl}/${id}`;
    return this.http.get<Offer>(url)
      .pipe(
        tap(data => console.log('getOffer: ' + JSON.stringify(data))),
        catchError(this.handleError)
      );
  }

  createOffer(offer: Offer): Observable<Offer> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    offer.id = null;
    return this.http.post<Offer>(this.offersUrl, offer, { headers: headers })
      .pipe(
        tap(data => console.log('createOffer: ' + JSON.stringify(data))),
        catchError(this.handleError)
      );
  }

  deleteOffer(id: number): Observable<{}> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    const url = `${this.offersUrl}/${id}`;
    return this.http.delete<Offer>(url, { headers: headers })
      .pipe(
        tap(data => console.log('deleteOffer: ' + id)),
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
        map(() => offer),
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
