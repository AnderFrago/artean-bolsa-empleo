import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { CvNewComponent } from './cv-new/cv-new.component';
import { CvRoutingModule } from './cv-routing.module';
import { MatIconModule } from '@angular/material/icon';


@NgModule({
    imports: [
        CommonModule,
        ReactiveFormsModule,
        CvRoutingModule,
        FormsModule,
        MatIconModule
    ],
    exports: [
    ],
    declarations: [
        CvNewComponent
    ],
    providers: [],
})
export class CvModule { }
