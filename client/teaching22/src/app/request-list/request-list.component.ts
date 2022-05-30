import { Component, OnInit } from '@angular/core';
import {Request} from "../shared/request";
import {RequestStoreService} from "../shared/request-store.service";
import {AuthenticationService} from "../shared/authentication.service";
declare var $:any;

@Component({
  selector: 'ts-request-list',
  templateUrl: './request-list.component.html',
  styles: [
  ]
})

export class RequestListComponent implements OnInit {

  requests: Request[] | undefined;
  newRequests: Request[] = [];


  constructor(private rs:RequestStoreService, public authService: AuthenticationService) { }

  ngOnInit(): void {
    this.getRequests();
  }

  getRequests(){
    this.rs.getAll().subscribe(res => this.requests = res);
    this.rs.getAll().subscribe(res => this.newRequests = res);
    this.dropFilter();
  }

  dropFilter():void{
    $('.ui.dropdown').dropdown();
  }

  statusFilter(stat: string){
    this.newRequests = [];
    if(this.requests && stat != 'all') {
      for (let i = 0; i < this.requests.length; i++) {
        if(stat == 'closed' && (this.requests[i].status == 'successfull' || this.requests[i].status == 'not successfull')){
          this.newRequests?.push(this.requests[i]);
          //console.log(this.newRequests);
        }
        else if (this.requests[i].status == stat) {
          this.newRequests?.push(this.requests[i]);
          //console.log(this.newRequests);
        }
      }
    }
    else if(this.requests && stat == 'all'){
      this.newRequests = this.requests;
    }
  }


}
