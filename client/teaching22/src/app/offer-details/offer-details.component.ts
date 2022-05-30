import {Component, OnInit} from '@angular/core';
import {Offer} from "../shared/offer";
import {OfferStoreService} from "../shared/offer-store.service";
import {ActivatedRoute, Router} from "@angular/router";
import {OfferFactory} from "../shared/offer-factory";
import {ToastrService} from "ngx-toastr";
import {AuthenticationService} from "../shared/authentication.service";
import {DatePipe} from "@angular/common";
declare var $:any;

@Component({
  selector: 'ts-offer-details',
  templateUrl: './offer-details.component.html',
  styles: [
  ]
})

export class OfferDetailsComponent implements OnInit {

  offer: Offer = OfferFactory.empty();

  constructor(
    private os: OfferStoreService,
    private router: Router,
    private route: ActivatedRoute,
    private toastr: ToastrService,
    public authService: AuthenticationService,
    public datePipe: DatePipe
  ) { }

  ngOnInit(): void {
    const params = this.route.snapshot.params;
    this.os.getSingle(params['id']).subscribe(res => this.offer = res);
    //console.log(this.offer);
  }

  removeOffer(){
    if(confirm('Do you really want to delete this offer?')){
      this.os.remove(this.offer.id).subscribe(
        res => this.router.navigate(
          ['../'],
          {relativeTo:this.route}));
      this.toastr.success('The offer "' + this.offer.title + '" has beed deleted!', 'Deleted');
    }
  }

  showPopup() {
    $('.activating.element')
      .popup();
  }

}
