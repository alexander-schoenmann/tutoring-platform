import {User} from "./user";
import {Image} from "./image";
import {Level} from "./level";
import {Course} from "./course";
export {User} from "./user";
export {Image} from "./image";
export {Level} from "./level";
export {Course} from "./course";

export class Offer {

  constructor(public  id: number, public title: string, public description: string, public date: Date | undefined,
              public startTime: Date | undefined, public endTime: Date | undefined, public user_id: number,
              public course_id: number, public level_id: number, public image?: Image, public status?: string,
              public user?: User, public course?: Course, public level?: Level) {
  }

}
