import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Injectable } from "@angular/core";
import * as moment from "moment";
import { catchError, filter, map, tap } from "rxjs/operators";
import { User } from "./user";
import { AuthResult } from "./authresult";
import { throwError } from "rxjs";



@Injectable()
export class AuthService {
    private authUrl = 'https://localhost:8000';

    constructor(private http: HttpClient) {
    }

    login(username: string, password: string) {
        const headers = new HttpHeaders().set('Content-Type', 'application/json');

        return this.http.post<AuthResult>(this.authUrl + '/login_check', { username, password }, { headers })
            .pipe(
                tap(res => console.log("logged in " + JSON.stringify(res))),
                catchError(this.handleError)
            )
    }


    register(username: string, password: string, type: string) {
        const headers = new HttpHeaders().set('Content-Type', 'application/json');

        return this.http.post<AuthResult>(this.authUrl + '/register', { username, password, type }, { headers })
            .pipe(
                tap(res => console.log("registered " + JSON.stringify(res)))
            );
    }

    setSession(authResult) {
        const expiresAt = moment().add(authResult.expires_at, 'second');

        localStorage.setItem('u', authResult.u);
        localStorage.setItem('r', authResult.r);

        localStorage.setItem('token', authResult.token);
        localStorage.setItem("expires_at", JSON.stringify(expiresAt.valueOf()));

    }

    logout() {

        localStorage.removeItem('u');
        localStorage.removeItem('r');
        localStorage.removeItem("token");
        localStorage.removeItem("expires_at");
    }

    isLoggedIn() {
        let now = moment();
        return now.isBefore(this.getExpiration());
    }

    isLoggedOut() {
        return !this.isLoggedIn();
    }

    getExpiration() {
        const expiration = localStorage.getItem("expires_at");
        const expiresAt = JSON.parse(expiration);
        let expiration_date = moment(expiresAt);
        return expiration_date;
    }

    role(username: string, password: string) {
        const headers = new HttpHeaders().set('Content-Type', 'application/json');

        return this.http.post<string[]>(this.authUrl + '/role', { username, password }, { headers })
            .pipe(
                tap(res => {
                    console.log("registered " + JSON.stringify(res))
                }),
            );
    }

    getRole() {
        return localStorage.getItem('r') === "ROLE_STUDENT" ? "s" : localStorage.getItem('r') === "ROLE_EMPLOYER" ? "e" : ""


            ;
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