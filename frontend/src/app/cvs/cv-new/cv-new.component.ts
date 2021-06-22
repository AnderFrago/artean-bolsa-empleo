// info: https://ng-run.com/edit/RIr1e70TUjU5iYMb5ejX?open=app%2Fapp.component.html
import { Component, OnInit } from '@angular/core';
import { FormArray, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Cv } from 'src/app/shared/cv';
import { CvService } from 'src/app/shared/cv.service';

@Component({
  selector: 'app-cv-new',
  templateUrl: './cv-new.component.html',
  styleUrls: ['./cv-new.component.scss']
})
export class CvNewComponent implements OnInit {

  pageTitle = 'Nuevo CV';
  errorMessage: string;
  public cvForm: FormGroup;

  cvId: number;
  cv: Cv;


  constructor(private fb: FormBuilder,
    private activatedroute: ActivatedRoute,
    private router: Router,
    private cvService: CvService) { }

  ngOnInit(): void {
    this.cvForm = this.fb.group({
      workExperiences: this.fb.array([]),
      studies: this.fb.array([]),
      languages: this.fb.array([]),
      otherKnowledges: this.fb.array([])

    });

    // Read the cv Id from the route parameter
    this.cvId = parseInt(this.activatedroute.snapshot.params['id']);
  }


  get workExperiences() {
    return this.cvForm.get('workExperiences') as FormArray;
  }
  createWorkExperience() {
    return this.fb.group({
      position: ['', [Validators.required, Validators.minLength(3)]],
      employer: ['', [Validators.required, Validators.minLength(3)]],
      location: ['', [Validators.required, Validators.minLength(3)]],
      duties: ['', [Validators.required, Validators.minLength(3)]],
      startDate: ['', [Validators.required, Validators.minLength(3)]],
      endDate: ['', [Validators.required, Validators.minLength(3)]],
     });
  }
  addWorkExperience() {
    this.workExperiences.push(this.createWorkExperience());
  }
  deleteWorkExperience(i: number) {
    if (this.workExperiences.length !== 1) {
      this.workExperiences.removeAt(i);
    }
  }


  get studies() {
    return this.cvForm.get('studies') as FormArray;
  }
  createStudies() {
    return this.fb.group({
      title: '',
      description: '',
      category: '',
      level: '',
      center: '',
      startDate: '',
      endDate: '',
     });
  }
  addStudies() {
    this.studies.push(this.createStudies());
  }
  deleteStudies(i: number) {
    if (this.studies.length !== 1) {
      this.studies.removeAt(i);
    }
  }

  get languages() {
    return this.cvForm.get('languages') as FormArray;
  }
  createLanguages() {
    return this.fb.group({
      title: '',
      name: ''
     });
  }
  addLanguages() {
    this.languages.push(this.createLanguages());
  }
  deleteLanguages(i: number) {
    if (this.languages.length !== 1) {
      this.languages.removeAt(i);
    }
  }

  get otherknowledges() {
    return this.cvForm.get('otherknowledges') as FormArray;
  }
  createOtherknowledges() {
    return this.fb.group({
      name: '',
      title: '',
      description: ''
     });
  }
  addOtherKnowledges() {
    this.otherknowledges.push(this.createOtherknowledges());
  }
  deleteOtherKnowledges(i: number) {
    if (this.otherknowledges.length !== 1) {
      this.otherknowledges.removeAt(i);
    }
  }
  
  saveCv(): void {

   // if (this.cvForm.valid) {
      // if (this.cvForm.dirty) {
        this.cv = this.cvForm.value;
        this.cv.id = this.cvId;

        this.cvService.createCv(this.cv)
          .subscribe(
            () => this.onSaveComplete(),
            (error: any) => this.errorMessage = <any>error
          );

      // } else {
      //   // this.onSaveComplete();
      //   this.errorMessage = 'Por favor, termina de insertar valores.';
      // }
    // } else {
    //   this.errorMessage = 'Por favor, corrije los errores de validación.';
    //   // this.isFormSubmitted = false;
    // }
  }

  onSaveComplete(): void {
    // Reset the form to clear the flags
    this.cvForm.reset();
    this.router.navigate(['cvs']);
  }

}
