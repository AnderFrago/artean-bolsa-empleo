import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { CvNewComponent } from './cv-new/cv-new.component';
import { CvRoutingModule } from './cv-routing.module';
import { MatButtonModule } from '@angular/material/button';
import { MatIconModule } from '@angular/material/icon';

@NgModule({
  imports: [
    CommonModule,
    ReactiveFormsModule,
    CvRoutingModule,
    FormsModule,
    MatIconModule,
    MatButtonModule,
  ],
  exports: [],
  declarations: [CvNewComponent],
  providers: [],
})
export class CvModule {}
