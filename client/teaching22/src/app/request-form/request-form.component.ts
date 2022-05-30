import {Component, Input, OnInit} from '@angular/core';
import {Offer} from "../shared/offer";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {RequestFactory} from "../shared/request-factory";
import {ActivatedRoute, Router} from "@angular/router";
import {RequestFormErrorMessages} from "./request-form-error-messages";
import {Request} from "../shared/request";
import {RequestStoreService} from "../shared/request-store.service";
import {ToastrService} from "ngx-toastr";
import {AuthenticationService} from "../shared/authentication.service";

@Component({
  selector: 'div.ts-request-form',
  templateUrl: './request-form.component.html',
  styles: []
})

export class RequestFormComponent implements OnInit {

  @Input() offer: Offer | undefined;
  requestForm: FormGroup;
  request = RequestFactory.empty();
  errors: { [key: string]: string } = {};

  constructor(private fb: FormBuilder,
              private rs: RequestStoreService,
              private route: ActivatedRoute,
              private router: Router,
              private toastr: ToastrService,
              public authService: AuthenticationService) {
    this.requestForm = this.fb.group({});
  }

  ngOnInit(): void {
    this.initRequest();
  }

  initRequest() {
    //console.log(this.offer);
    this.requestForm = this.fb.group({
      id: this.request.id,
      description: [this.request?.description],
      date: [this.offer?.date, Validators.required],
      startTime: [this.getBetterTime(this.offer?.startTime), Validators.required],
      endTime: [this.getBetterTime(this.offer?.endTime) , Validators.required]
    });

    this.requestForm.statusChanges.subscribe(() => {
      this.updateErrorMessages();
    });

  }

  updateErrorMessages() {
    this.errors = {};
    for (const message of RequestFormErrorMessages) {
      const control = this.requestForm.get(message.forControl);
      if (
        control &&
        control.dirty &&
        control.invalid && control.errors &&
        control.errors[message.forValidator] &&
        !this.errors[message.forControl]
      ) {
        this.errors[message.forControl] = message.text;
      }
    }
  }

  submitForm() {
    //console.log(this.requestForm.value);
    const request: Request = RequestFactory.fromObject(this.requestForm.value);

    request.user_id = this.authService.getCurrentUserId();
    if(this.offer) {
      request.offer_id = this.offer?.id;
    }
    request.status = 'waiting';
    //console.log(request);
    this.rs.create(request).subscribe(res => {
      this.request = RequestFactory.empty();
      this.requestForm.reset(RequestFactory.empty());
      this.router.navigate(["../requests"], {relativeTo: this.route});
      this.toastr.success('Request has beed sent!', 'Sent');
    });

  }

  public getBetterTime(value: Date | undefined):any{
    if(value){
      let stringDate = value.toString();
      return stringDate.substring(11,16);
    }
  }

}
