import { Component } from '@angular/core';
import {AuthenticationService} from "./shared/authentication.service";

@Component({
  selector: 'ts-root',
  templateUrl: './app.component.html',
  styles: []
})

export class AppComponent {

  showMobileMenu = true;

  constructor(private authService: AuthenticationService) {
  }

  toggleMobileNav(){
    this.showMobileMenu = !this.showMobileMenu;
  }

  isLoggedIn(){
    return this.authService.isLoggedIn();
  }

  getLoginLabel(){
    if(this.isLoggedIn()){
      return 'LOGOUT';
    }
    else{
      return 'LOGIN';
    }
  }

  logout() {
    this.authService.logout();

  }

}
