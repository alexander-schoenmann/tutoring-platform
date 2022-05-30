import {Image} from "./image";
export {Image} from "./image";

export class User {

  constructor(public  id: number, public firstname: string, public lastname: string, public email: string, public password: string,
              public phone: number, public isStudent: boolean, public education?: string, public description?: string,
              public image?: Image) {
  }

}
