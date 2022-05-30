import {Component, OnInit} from '@angular/core';
import {AuthenticationService} from "../shared/authentication.service";

@Component({
  selector: 'ts-home',
  templateUrl: './home.component.html',
  styles: []
})

export class HomeComponent implements OnInit {



  constructor(
    public authService: AuthenticationService,
  ) { }

  ngOnInit(): void {

  }


}
