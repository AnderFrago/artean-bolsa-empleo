import { HttpClient, HttpEventType } from '@angular/common/http';
import { Component, Input, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { Subscription } from 'rxjs';
import { finalize } from 'rxjs/operators';
import { AuthService } from 'src/app/shared/auth.service';
import { MatDialog } from '@angular/material/dialog';

import { CvService } from 'src/app/shared/cv.service';
import { ToastrService } from 'ngx-toastr';

@Component({
  selector: 'app-cv-new',
  templateUrl: './cv-new.component.html',
  styleUrls: ['./cv-new.component.scss'],
})
export class CvNewComponent implements OnInit {
  pageTitle = 'Subir CV';

  fileName = '';

  @Input()
  requiredFileType: string;
  uploadProgress: number;
  uploadSub: Subscription;
  isLoading:boolean = false;

  constructor(
    private http: HttpClient,
    private cvService: CvService,
    private authService: AuthService,
    private router: Router,
    public dialog: MatDialog,
    private toastrService: ToastrService
  ) {}

  ngOnInit(): void {
    this.authService.getState().subscribe((data) => {
      if (data != 1) {
        this.toastrService.warning(
          'La cuenta debe ser validada por el administrador de Artean',
          'Cuenta no validada'
        );
        this.authService.logout();
        this.router.navigate(['/login']);
      }
    });
  }

  onFileSelected(event) {
    const file: File = event.target.files[0];

    if (file) {
      this.fileName = file.name;
      const formData = new FormData();
      formData.append('cv', file);
      this.isLoading = true;
      this.uploadSub = this.cvService.createCV(formData).subscribe((event) => {
        if (event.type == HttpEventType.UploadProgress) {
          this.uploadProgress = Math.round(100 * (event.loaded / event.total));
        } else if (event.type == HttpEventType.Sent) {
          //console.log('Upload finished');
          this.toastrService.warning(
            'Se ha almacenado el CV',
            'CV actualizado'
          );
          this.isLoading = false;
          this.reset();
        }
      });
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
