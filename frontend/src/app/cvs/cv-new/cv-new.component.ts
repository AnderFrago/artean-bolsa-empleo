import { HttpClient, HttpEventType } from '@angular/common/http';
import { Component, Input, OnInit } from '@angular/core';
import { Subscription } from 'rxjs';
import { finalize } from 'rxjs/operators';

import { CvService } from 'src/app/shared/cv.service';


@Component({
  selector: 'app-cv-new',
  templateUrl: './cv-new.component.html',
  styleUrls: ['./cv-new.component.scss']
})
export class CvNewComponent {
  pageTitle = "Subir CV";

  fileName = '';

  @Input()
  requiredFileType: string;
  uploadProgress: number;
  uploadSub: Subscription;


  constructor(private http: HttpClient, private cvService: CvService) { }

  onFileSelected(event) {
    const file: File = event.target.files[0];

    if (file) {
      this.fileName = file.name;
      const formData = new FormData();
      formData.append("cv", file);

      this.uploadSub = this.cvService.createCV(formData).subscribe(event => {
        if (event.type == HttpEventType.UploadProgress) {
          this.uploadProgress = Math.round(100 * (event.loaded / event.total));
        } else if (event.type == HttpEventType.Sent) {
          console.log("Upload finished");
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
