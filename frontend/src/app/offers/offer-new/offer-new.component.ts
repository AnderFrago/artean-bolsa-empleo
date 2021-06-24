import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Offer } from 'src/app/shared/offer';
import { OfferService } from 'src/app/shared/offer.service';

@Component({
  selector: 'app-offer-new',
  templateUrl: './offer-new.component.html',
  styleUrls: ['./offer-new.component.scss']
})
export class OfferNewComponent implements OnInit {

  pageTitle = 'Nueva oferta';
  errorMessage: string;
  offerForm: FormGroup;

  offerId:number;
  offer: Offer;

  isFormSubmitted:boolean=false;

  constructor(private fb: FormBuilder,
    private activatedroute: ActivatedRoute,
    private router: Router,
    private offerService: OfferService) {  }

  ngOnInit(): void {
    this.offerForm = this.fb.group({
      company: '',
      position: '',
      dueDate: Date.now,  
      requirements: '',
      description: '',     
    });

    // Read the offer Id from the route parameter
    this.offerId = parseInt(this.activatedroute.snapshot.params['id']);
  }

  saveOffer(): void {
    this.isFormSubmitted=true;

    if (this.offerForm.valid) {
      if (this.offerForm.dirty) {
        this.offer = this.offerForm.value;
        this.offer.id = this.offerId;
        
        this.offerService.createOffer(this.offer)
          .subscribe(
            () => this.onSaveComplete(),
            (error: any) => this.errorMessage = <any>error
          );
        
      } else {
         this.onSaveComplete();
        this.errorMessage = 'Por favor, termina de insertar valores.';
      }
     } else {
       this.errorMessage = 'Por favor, corrije los errores de validación.';
       this.isFormSubmitted = false;
    }
  }

  onSaveComplete(): void {
    // Reset the form to clear the flags
    this.offerForm.reset();
    this.router.navigate(['']);
  }
  
}
