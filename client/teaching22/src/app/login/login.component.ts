import { Component, OnInit } from "@angular/core";
import { FormBuilder, FormGroup, Validators } from "@angular/forms";
import { Router } from "@angular/router";
import { AuthenticationService } from "../shared/authentication.service";

interface Response {
  access_token: string;
}

@Component({
  selector: "ts-login",
  templateUrl: "./login.component.html"
})

export class LoginComponent implements OnInit {
  loginForm: FormGroup;
  constructor(  private fb: FormBuilder,
                private router: Router,
                private authService: AuthenticationService) {
    this.loginForm = this.fb.group({});
  }

  ngOnInit() {
    this.loginForm = this.fb.group({
      email: ["", [Validators.required, Validators.email]],
      password: ["", Validators.required]
    });
  }

  login() {
    const val = this.loginForm.value;
    if (val.email && val.password) {
      this.authService.login(val.email, val.password).subscribe((res: any) => {
        //console.log(res);
        this.authService.setSessionStorage((res as Response).access_token);
        this.router.navigateByUrl("/");
      });
    }
  }

  isLoggedIn() {
    return this.authService.isLoggedIn();
  }

  isStudent(){
    return this.authService.getCurrentUserIsStudent() === 1; //1 = Student, 0 = Lector
  }

}
