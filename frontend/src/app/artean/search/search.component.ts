import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { ArteanService } from 'src/app/shared/artean.service';
import { saveAs } from 'file-saver';
import { ApplymentsService } from 'src/app/shared/applyments.service';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/shared/auth.service';


@Component({
  selector: 'app-search',
  templateUrl: './search.component.html',
  styleUrls: ['./search.component.scss']
})
export class SearchComponent implements OnInit {

  pageTitle = 'Buscador de ofertas';
  errorMessage: string;
  searchForm: FormGroup;
  isFormSubmitted: boolean = false;

  keyword = ''

  cvs : string[] 

  constructor(
    private fb: FormBuilder, 
    private arteanService:ArteanService ,
    private authService:AuthService ,
    private router: Router,
    private applymentsService: ApplymentsService
  ) { }

  ngOnInit(): void {
    this.authService.getState().subscribe(data=>{
      if(data != 1){
        alert("Cuenta no validada");
        this.authService.logout()
        this.router.navigate(['login'])
      }
  });

    this.searchForm = this.fb.group({
      keyword: '',
    });
  }

  search(){
    if (this.searchForm.valid) {
      if (this.searchForm.dirty) {
        this.isFormSubmitted = true;
        this.keyword = this.searchForm.value.keyword;
        this.arteanService.search(this.keyword).subscribe(
          data => {
            this.cvs = data;
            this.isFormSubmitted = false;
          } 
        )
      }
    }
  }


  loadCV(fileName) {
    this.applymentsService.loadCV(fileName).subscribe(data => {
      saveAs(data.file, fileName, { type: "application/pdf" });
    });
  }

}
