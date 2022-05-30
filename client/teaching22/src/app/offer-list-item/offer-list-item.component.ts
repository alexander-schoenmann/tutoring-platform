import {Component, Input, OnInit, Output} from '@angular/core';
import {Offer} from "../shared/offer";
import {AuthenticationService} from "../shared/authentication.service";
import {DatePipe} from "@angular/common";

@Component({
  selector: 'a.ts-offer-list-item',
  templateUrl: './offer-list-item.component.html',
  styles: [
  ]
})

export class OfferListItemComponent implements OnInit {

  @Input() offer: Offer | undefined;

  constructor(public authService: AuthenticationService, public datePipe: DatePipe) { }

  ngOnInit(): void { }

  transformLetter(value:string | undefined): any {
    if (value) {
      let first = value.substring(0, 1).toUpperCase();
      return first + value.substring(1);
    }
  }

}
