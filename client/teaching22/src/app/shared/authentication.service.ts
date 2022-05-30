import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import jwtDecode from "jwt-decode";
//npm install --save-dev jwt-decode

interface Token {
  exp: number;
  user: {
    id: string;
    isStudent: string;
  };
}

@Injectable()

export class AuthenticationService {
  private api: string = "http://teaching22.s1910456030.student.kwmhgb.at/api/auth";

  constructor(private http: HttpClient) {}

  login(email: string, password: string) {
    return this.http.post(`${this.api}/login`, {
      email: email,
      password: password
    });
  }

  public getCurrentUserId() {
    return Number.parseInt(<string>sessionStorage.getItem("userId"));
  }

  public getCurrentUserIsStudent() {
    return Number.parseInt(<string>sessionStorage.getItem("isStudent"));
  }

  public setSessionStorage(token: string) {
    //console.log("Storing token");
    //console.log(jwtDecode(token));
    const decodedToken = jwtDecode(token) as Token;
    //console.log(decodedToken);
    //console.log(decodedToken.user.id);
    sessionStorage.setItem("token", token);
    sessionStorage.setItem("userId", decodedToken.user.id);
    sessionStorage.setItem("isStudent", decodedToken.user.isStudent);
  }

  logout() {
    this.http.post(`${this.api}/logout`, {});
    sessionStorage.removeItem("token");
    sessionStorage.removeItem("userId");
    sessionStorage.removeItem("isStudent");
    //console.log("logged out");
  }

  public isLoggedIn() {
    if (sessionStorage.getItem("token")) {
      let token: string = <string>sessionStorage.getItem("token");
      //console.log(jwtDecode(token));
      const decodedToken = jwtDecode(token) as Token;
      let expirationDate: Date = new Date(0);
      expirationDate.setUTCDate(decodedToken.exp);
      if (expirationDate < new Date()) {
        console.info("token expired");
        sessionStorage.removeItem("token");
        return false;
      } return true;
    } else {
      return false;
    }
  }

  isLoggedOut() {
    return !this.isLoggedIn();
  }

}
