export class ErrorMessage {

  constructor(public forControl: string,
              public forValidator: string,
              public text: string) { }

}

export const RequestFormErrorMessages = [
  new ErrorMessage('date', 'required', 'Es muss ein Datum angegeben werden'),
  new ErrorMessage('startTime', 'required', 'Es muss eine Startzeit angegeben werden'),
  new ErrorMessage('endTime', 'required', 'Es muss eine Endzeit angegeben werden'),
];
