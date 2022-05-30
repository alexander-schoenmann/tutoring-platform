import { NgModule } from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {HomeComponent} from "./home/home.component";
import {OfferListComponent} from "./offer-list/offer-list.component";
import {OfferDetailsComponent} from "./offer-details/offer-details.component";
import {RequestListComponent} from "./request-list/request-list.component";
import {OfferFormComponent} from "./offer-form/offer-form.component";
import {LoginComponent} from "./login/login.component";
import {CanNavigateToAdminGuard} from "./can-navigate-to-admin.guard";
import {NotFoundComponent} from "./not-found/not-found.component";
import {CanNavigateToRequestGuard} from "./can-navigate-to-request.guard";
import {CanNavigateToLoginGuard} from "./can-navigate-to-login.guard";

const routes: Routes = [
  { path: '', redirectTo: 'home', pathMatch: 'full' },
  { path: 'home', component: HomeComponent },
  { path: 'offers', component: OfferListComponent },
  { path: 'offers/:id', component: OfferDetailsComponent },
  { path: 'requests', component: RequestListComponent, canActivate:[CanNavigateToRequestGuard]},
  { path: 'admin', component:OfferFormComponent, canActivate:[CanNavigateToAdminGuard]},
  { path: 'admin/:id', component:OfferFormComponent, canActivate:[CanNavigateToAdminGuard]},
  { path: 'login', component:LoginComponent, canActivate:[CanNavigateToLoginGuard]},
  {path: '**', component: NotFoundComponent},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule],
  providers: [CanNavigateToAdminGuard]
})

export class AppRoutingModule { }
