import { Injectable } from '@angular/core';
import {Level} from "./level";
import {HttpClient} from "@angular/common/http";
import {catchError, Observable, retry, throwError} from "rxjs";

@Injectable({
  providedIn: 'root'
})
export class LevelStoreService {

  private api = 'http://teaching22.s1910456030.student.kwmhgb.at/api';

  constructor(private http: HttpClient) {

  }

  getAll(): Observable<Array<Level>> {
    return this.http.get<Array<Level>>(`${this.api}/levels`)
      .pipe(retry(3)).pipe(catchError(this.errorHandler));
  }


  private errorHandler(error:Error | any): Observable<any> {
    return throwError(error);
  }

}
