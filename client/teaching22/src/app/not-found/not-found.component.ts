import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from "@angular/router";

@Component({
  selector: 'ts-not-found',
  templateUrl: './not-found.component.html',
  styles: [
  ]
})

export class NotFoundComponent implements OnInit {

  public notFoundImage = "";

  constructor(
    private router: Router,
    private route: ActivatedRoute
  ) { }

  ngOnInit(): void {
    this.notFoundImageMethod();
  }

  notFoundImageMethod(){
    this.notFoundImage = "https://m.media-amazon.com/images/G/02/error/"+(Math.floor(Math.random()*43)+1)+".-TTD-c.jpg";
  }

  reload(){
    this.notFoundImageMethod();
  }

  home(){
    this.router.navigate(["/home"], {relativeTo: this.route});
  }

}
