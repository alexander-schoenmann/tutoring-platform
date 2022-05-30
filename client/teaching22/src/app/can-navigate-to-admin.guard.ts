import {Injectable} from '@angular/core';
import {
  ActivatedRoute,
  ActivatedRouteSnapshot,
  CanActivate,
  Router,
  RouterStateSnapshot,
  UrlTree
} from '@angular/router';
import {Observable} from 'rxjs';
import {AuthenticationService} from "./shared/authentication.service";

@Injectable({
  providedIn: 'root'
})
export class CanNavigateToAdminGuard implements CanActivate {

  constructor(
    private authService: AuthenticationService,
    private router: Router,
    private route: ActivatedRoute
  ) {
  }


  //check if user is logged in and role = admin (for /admin & /admin/:id)
  canActivate(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    if (this.authService.isLoggedIn() && !this.authService.getCurrentUserIsStudent()) {
      return true;
    }
    else {
      window.alert("Sie müssen sich als Lector einloggen, um den Administrationsbereich zu betreten");
      this.router.navigate(["../"], {relativeTo: this.route});
      return false;
    }
  }


}
