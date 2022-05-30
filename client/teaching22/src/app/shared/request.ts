import {Offer} from "./offer";
import {User} from "./user";
export {Offer} from "./offer";
export {User} from "./user";

export class Request {

  constructor(public  id: number, public date: Date | undefined, public startTime: Date | undefined,
              public endTime: Date | undefined, public user_id: number, public offer_id: number,
              public description?: string, public status?: string, public user?: User,
              public offer?: Offer) {
  }

}
