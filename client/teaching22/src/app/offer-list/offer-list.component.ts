import {Component, OnInit} from '@angular/core';
import {Course, Level, Offer} from "../shared/offer";
import {OfferStoreService} from "../shared/offer-store.service";
import {CourseStoreService} from "../shared/course-store.service";
import {AuthenticationService} from "../shared/authentication.service";
import {LevelStoreService} from "../shared/level-store.service";
import {ActivatedRoute, Router} from "@angular/router";
declare var $:any;

@Component({
  selector: 'ts-offer-list',
  templateUrl: './offer-list.component.html',
  styles: []
})

export class OfferListComponent implements OnInit {

  offers: Offer[] | undefined;
  newOffers: Offer[] = [];
  courses: Course[] = [];
  levels: Level[] = [];

  constructor(private os:OfferStoreService, private cs:CourseStoreService, private ls:LevelStoreService, public authService: AuthenticationService, private route: ActivatedRoute,
              private router: Router,
  ) { }

  ngOnInit(): void {
    this.os.getAll().subscribe(res => this.offers = res);
    this.cs.getAll().subscribe(res => this.courses = res);
    this.ls.getAll().subscribe(res => this.levels = res);
    this.os.getAll().subscribe(res => this.newOffers = res);
    this.dropFilter();
    this.dropFilterVisible();
  }

  courseStatus: boolean = false;
  levelStatus: boolean = false;

  dropFilter():void{
    $('.ui.dropdown').dropdown();
  }

  statusFilter(stat: string){
    this.newOffers = [];
    if(this.offers && stat != 'all') {
      for (let i = 0; i < this.offers.length; i++) {
        if (this.offers[i].status == stat) {
          this.newOffers?.push(this.offers[i]);
          //console.log(this.newOffers);
        }
      }
    }
    else if(this.offers && stat == 'all'){
      this.newOffers = this.offers;
    }
    //console.log(this.newOffers);
  }

  dropFilterVisible(){
    if(this.authService.isLoggedOut() || this.authService.getCurrentUserIsStudent()){
      $('.ui.dropdown').addClass('hideDropFilter');
    }
  }

}
