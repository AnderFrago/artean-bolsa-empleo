import { HttpEventType } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Subscription } from 'rxjs';
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
    private offerService: OfferService) { }

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
    this.isFormSubmitted = true;

    if (this.offerForm.valid && typeof this.file !== 'undefined') {
      if (this.offerForm.dirty) {
        this.offer = this.offerForm.value;
        this.offer.id = this.offerId;
        this.offer.owner = localStorage.getItem('u')
        this.offer.originalFileName = this.fileName

        this.offerService.createOffer(this.offer)
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

      } else {
        this.onSaveComplete();
        this.errorMessage = 'Por favor, termina de insertar valores.';
      }
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
