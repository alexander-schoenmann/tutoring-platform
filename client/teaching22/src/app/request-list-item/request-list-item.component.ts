import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {Offer, Request} from "../shared/request";
import {AuthenticationService} from "../shared/authentication.service";
import {RequestStoreService} from "../shared/request-store.service";
import {ToastrService} from "ngx-toastr";
import {ActivatedRoute, Router} from "@angular/router";
import {OfferStoreService} from "../shared/offer-store.service";
import {DatePipe} from "@angular/common";

@Component({
  selector: 'div.ts-request-list-item',
  templateUrl: './request-list-item.component.html',
  styles: []
})

export class RequestListItemComponent implements OnInit {

  @Input() request: Request | undefined;
  @Output() rejectReq = new EventEmitter<any>();

  offer: Offer | undefined;
  requests: Request [] | undefined;

  constructor(
    private rs: RequestStoreService,
    private os: OfferStoreService,
    public authService: AuthenticationService,
    private router: Router,
    private route: ActivatedRoute,
    private toastr: ToastrService,
    public datePipe: DatePipe
  ) { }

  ngOnInit(): void {
    if (this.request) {
      this.os.getSingle(this.request?.offer_id).subscribe(res => this.offer = res);
    }
    this.rs.getAll().subscribe(res => this.requests = res);
  }

  changeStatus(stat: string) {
    if (this.request && (stat === 'accepted' || stat == 'rejected' || stat == 'successfull' || stat == 'not successfull')) {
      this.request.status = stat;
      this.rs.update(this.request).subscribe();

      if (this.offer && stat === 'accepted') {
        this.offer.status = 'booked';
        this.offer.date = this.request.date;
        this.offer.startTime = this.request.startTime;
        this.offer.endTime = this.request.endTime;
        this.os.update(this.offer).subscribe();
        this.rejectOthers();
      }

      if (this.offer && (stat === 'successfull' || stat === 'not successfull')) {
        this.offer.status = 'closed';
        this.os.update(this.offer).subscribe(
          res => this.rejectReq.emit());
      }

      this.toastr.success('Status of the request was changed to "' + this.request.status + '"!', 'Status was changed');
    }
  }

  rejectOthers() {
    if (this.requests) {
      //console.log(this.requests);
      for (let req of this.requests) {
        if (req.offer_id == this.offer?.id && req.id != this.request?.id) {
          req.status = 'rejected';
          this.rs.update(req).subscribe(
            res => this.rejectReq.emit());
        }
      }
    }
  }

}
