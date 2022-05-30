import {Component, OnInit} from '@angular/core';
import {OfferStoreService} from "../shared/offer-store.service";
import {ActivatedRoute, Router} from "@angular/router";
import {FormBuilder, FormControl, FormGroup, Validators} from "@angular/forms";
import {OfferFactory} from "../shared/offer-factory";
import {OfferFormErrorMessages} from "./offer-form-error-messages";
import {CourseStoreService} from "../shared/course-store.service";
import {Course} from "../shared/course";
import {Level, Offer} from "../shared/offer";
import {LevelStoreService} from "../shared/level-store.service";
import {ToastrService} from "ngx-toastr";
import {AuthenticationService} from "../shared/authentication.service";

@Component({
  selector: 'ts-offer-form',
  templateUrl: './offer-form.component.html',
  styles: []
})

export class OfferFormComponent implements OnInit {

  offerForm: FormGroup;
  offer = OfferFactory.empty();
  errors: { [key: string]: string } = {};
  courses: Course[] = [];
  isUpdatingOffer = false;
  levels: Level[] = [];
  imageForm: FormGroup;

  constructor(private fb: FormBuilder,
              private os: OfferStoreService,
              private route: ActivatedRoute,
              private router: Router,
              private cs: CourseStoreService,
              private ls: LevelStoreService,
              private toastr: ToastrService,
              public authService: AuthenticationService) {
    this.offerForm = this.fb.group({});
    this.imageForm = this.fb.group({});
  }

  initOffer() {
    this.buildThumbnail();
    this.offerForm = this.fb.group({
      id: this.offer.id,
      title: [this.offer.title, Validators.required],
      description: [this.offer.description, Validators.required],
      date: [this.offer.date, Validators.required],
      startTime: [this.getBetterTime(this.offer.startTime), Validators.required],
      endTime: [this.getBetterTime(this.offer.endTime), Validators.required],
      course_id: [this.offer.course_id, [Validators.required, Validators.min(1)]],
      level_id: [this.offer.level_id, [Validators.required, Validators.min(1)]],
      image: this.imageForm
    });

    this.offerForm.statusChanges.subscribe(() => {
      this.updateErrorMessages();
    })
  }

  buildThumbnail(){
    if(this.offer.image){
      if(this.offer?.image?.id == 1){
        this.imageForm = this.fb.group({
          id: new FormControl(this.offer?.image?.id),
          url: new FormControl('')
        });
      }
      else {
        this.imageForm = this.fb.group({
          id: new FormControl(this.offer?.image?.id),
          url: new FormControl(this.offer?.image?.url)
        });
      }
    }
  }

  updateErrorMessages() {
    //console.log("Is invalid? " + this.offerForm.invalid);
    this.errors = {};
    for (const message of OfferFormErrorMessages) {
      const control = this.offerForm.get(message.forControl);
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

  ngOnInit(): void {
    this.cs.getAll().subscribe(res => this.courses = res);
    this.ls.getAll().subscribe(res => this.levels = res);

    const id = this.route.snapshot.params["id"];
    if (id) {
      this.isUpdatingOffer = true;
      this.os.getSingle(id).subscribe(offer => {
        this.offer = offer;
        this.initOffer();
      });

    }
    this.initOffer();
  }

  submitForm() {

    const offer: Offer = OfferFactory.fromObject(this.offerForm.value);

    if (this.isUpdatingOffer) {
      this.os.update(offer).subscribe(res => {
        this.router.navigate(["../../offers", offer.id], {
          relativeTo: this.route
        });
        this.toastr.success('Offer has beed updated!', 'Updated');
      });
    }
    else {
      offer.user_id = this.authService.getCurrentUserId(); // just for testing
      //console.log(offer);
      this.os.create(offer).subscribe(res => {
        this.offer = OfferFactory.empty();
        this.offerForm.reset(OfferFactory.empty());
        this.router.navigate(["../offers"], {relativeTo: this.route});
        this.toastr.success('Offer has beed added!', 'Added');
      });
    }
  }

  public getBetterTime(value: Date | undefined):any{
    if(value){
      let stringDate = value.toString();
      return stringDate.substring(11,16);
    }
  }

}
