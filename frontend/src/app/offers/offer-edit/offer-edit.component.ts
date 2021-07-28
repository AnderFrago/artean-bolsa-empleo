import { HttpEventType } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Subscription } from 'rxjs';
import { AuthService } from 'src/app/shared/auth.service';
import { Offer } from 'src/app/shared/offer';
import { OfferService } from 'src/app/shared/offer.service';

@Component({
  selector: 'app-offer-edit',
  templateUrl: './offer-edit.component.html',
  styleUrls: ['./offer-edit.component.scss']
})
export class OfferEditComponent implements OnInit {


  pageTitle = 'Editar oferta';
  errorMessage: string;
  offerForm: FormGroup;

  offerId: number;
  offer: Offer;

  isFormSubmitted: boolean = false;


  uploadProgress: number;
  uploadSub: Subscription;
  fileName = '';
  requiredFileType: string;
  event: any;
  file: File;
  formData: FormData;

  constructor(private fb: FormBuilder,
    private activatedroute: ActivatedRoute,
    private router: Router,
    private offerService: OfferService,
    private authService: AuthService
    ) { }

  ngOnInit(): void {
    this.authService.getState().subscribe(data=>{
        if(data != 1){
          alert("Cuenta no validada");
          this.authService.logout()
          this.router.navigate(['login'])
        }
    });

    this.offerForm = this.fb.group({
      company: '',
      position: '',
      dueDate: Date.now,
      requirements: '',
      description: '',
    });

    // Read the offer Id from the route parameter
    this.offerId = parseInt(this.activatedroute.snapshot.params['id']);

    this.offerService.getOfferById(this.offerId).subscribe(data => {
      this.offer = data.offer;
      this.fileName = data.offer.original_name;
      this.offerForm.setValue({
        company: data.offer.company,
        position: data.offer.position,
        dueDate: data.offer.due_date,
        requirements: data.offer.minimum_requirements,
        description: data.offer.description
      });
    });
  }


  saveOffer(): void {
    this.isFormSubmitted = true;

    if (this.offerForm.valid && typeof this.file !== 'undefined') {
      //if (this.offerForm.dirty) {
     // this.offer = this.offerForm.value;
      this.offer.company = this.offerForm.value.company || this.offer.company
      this.offer.position = this.offerForm.value.position || this.offer.position
      this.offer.dueDate = this.offerForm.value.due_date || this.offer.dueDate
      this.offer.requirements = this.offerForm.value.minimum_requirements || this.offer.requirements
      this.offer.description = this.offerForm.value.description || this.offer.description

      this.offer.id = this.offerId;
      this.offer.owner = localStorage.getItem('u')
      this.offer.originalFileName = this.fileName

      this.offerService.updateOffer(this.offer)
        .subscribe(
          data => {
            // save file
            this.uploadSub = this.offerService.createOfferPDF(this.formData).subscribe(event => {
              if (this.event.type == HttpEventType.UploadProgress) {
                this.uploadProgress = Math.round(100 * (this.event.loaded / this.event.total));
              } else if (this.event.type == HttpEventType.Sent) {

                console.log("Upload finished");
                this.reset();
              }
            });

            this.onSaveComplete();
          },
          (error: any) => this.errorMessage = <any>error
        );

      // } else {
      //   this.onSaveComplete();
      //   this.errorMessage = 'Por favor, termina de insertar valores.';
      // }
    }else if(this.offerForm.valid) {
      this.offer.company = this.offerForm.value.company || this.offer.company
      this.offer.position = this.offerForm.value.position || this.offer.position
      this.offer.dueDate = this.offerForm.value.due_date || this.offer.dueDate
      this.offer.requirements = this.offerForm.value.minimum_requirements || this.offer.requirements
      this.offer.description = this.offerForm.value.description || this.offer.description

      this.offer.id = this.offerId;
      this.offer.owner = localStorage.getItem('u')
      this.offer.originalFileName = this.fileName

      this.offerService.updateOffer(this.offer)
        .subscribe(
          data => {
              this.onSaveComplete();
          },
          (error: any) => this.errorMessage = <any>error
        );
    } else if (typeof this.file !== 'undefined') {
      this.errorMessage = 'Por favor, corrije los errores de validación.';
      this.isFormSubmitted = false;

    }
  }

  onSaveComplete(): void {
    // Reset the form to clear the flags
    this.offerForm.reset();
    this.router.navigate(['']);
  }

  onFileSelected(event) {
    this.event = event;
    this.file = event.target.files[0];
    if (this.file) {
      this.fileName = this.file.name;
      this.formData = new FormData();
      this.formData.append("cv", this.file);

    }
  }

  cancelUpload() {
    this.uploadSub.unsubscribe();
    this.reset();
  }

  reset() {
    this.uploadProgress = null;
    this.uploadSub = null;
  }


}
