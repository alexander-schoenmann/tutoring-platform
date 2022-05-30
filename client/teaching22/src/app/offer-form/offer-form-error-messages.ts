export class ErrorMessage {

  constructor(public forControl: string,
              public forValidator: string,
              public text: string) { }

}

export const OfferFormErrorMessages = [
  new ErrorMessage('title', 'required', 'Ein Offertitle muss angegeben werden'),
  new ErrorMessage('description', 'required', 'Es muss eine Description angegeben werden'),
  new ErrorMessage('date', 'required', 'Es muss ein Datum angegeben werden'),
  new ErrorMessage('startTime', 'required', 'Es muss eine Startzeit angegeben werden'),
  new ErrorMessage('endTime', 'required', 'Es muss eine Endzeit angegeben werden'),
  new ErrorMessage('course_id', 'required', 'Es muss ein zugehöriger Kurs ausgewählt werden'),
  new ErrorMessage('course_id', 'min', 'Es muss ein zugehöriger Kurs ausgewählt werden'),
  new ErrorMessage('level_id', 'required', 'Es muss ein Level ausgewählt werden'),
  new ErrorMessage('level_id', 'min', 'Es muss ein Level ausgewählt werden')
];
