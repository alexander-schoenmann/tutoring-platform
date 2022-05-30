import { Injectable } from '@angular/core';
import {Request} from "./request";
import {HttpClient} from "@angular/common/http";
import {catchError, Observable, retry, throwError} from "rxjs";

@Injectable({
  providedIn: 'root'
})

export class RequestStoreService {

  private api = 'http://teaching22.s1910456030.student.kwmhgb.at/api';

  constructor(private http: HttpClient) { }

  getAll(): Observable<Array<Request>> {
    return this.http.get<Array<Request>>(`${this.api}/requests`)
      .pipe(retry(3)).pipe(catchError(this.errorHandler));
  }

  create(request:Request):Observable<any> {
    return this.http.post(`${this.api}/requests`, request)
      .pipe(retry(3)).pipe(catchError(this.errorHandler));
  }

  update(request:Request):Observable<any> {
    return this.http.put(`${this.api}/requests/${request.id}`, request)
      .pipe(retry(3)).pipe(catchError(this.errorHandler));
  }


  private errorHandler(error:Error | any): Observable<any> {
    return throwError(error);
  }

}
