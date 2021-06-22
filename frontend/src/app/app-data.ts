import { InMemoryDbService } from 'angular-in-memory-web-api';
import { Offer } from './shared/offer';
import { Cv } from './shared/cv';

import { OfferData } from './shared/offer-data';
import { CvData } from './shared/cv-data';

export class AppData implements InMemoryDbService {

  createDb(): { /*offers: Offer[],*/ cvs: Cv[] } {
  //  const offers = OfferData.offers;
    const cvs = CvData.cvs;

    return { /*offers,*/ cvs };
  }
}
