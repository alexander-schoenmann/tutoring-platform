import {Request} from "./request";

export class RequestFactory {

  static empty():Request {
    return new Request(0, undefined, undefined, undefined,
      0, 0, '', '')
  }

  static fromObject(rawRequest: any):Request {
    return new Request(
      rawRequest.id,
      typeof(rawRequest.date)==='string' ? new Date(rawRequest.date) : rawRequest.date,
      typeof(rawRequest.startTime)==='string' ? (rawRequest.startTime) : rawRequest.startTime,
      typeof(rawRequest.endTime)==='string' ? (rawRequest.endTime) : rawRequest.endTime,
      rawRequest.user_id,
      rawRequest.offer_id,
      rawRequest.description,
      rawRequest.status
    );
  }

}
