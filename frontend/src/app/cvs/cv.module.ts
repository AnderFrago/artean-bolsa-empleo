import { CommonModule } from '@angular/common';
import { NgModule } from '@angular/core';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { CvItemComponent } from './cv-item/cv-item.component';
import { CvListComponent } from './cv-list/cv-list.component';
import { CvNewComponent } from './cv-new/cv-new.component';
import { CvDetailComponent } from './cv-detail/cv-detail.component';
import { CvRoutingModule } from './cv-routing.module';


@NgModule({
    imports: [
        CommonModule,
        ReactiveFormsModule,
        CvRoutingModule,
        FormsModule
    ],
    exports: [
        CvListComponent
    ],
    declarations: [
        CvItemComponent,
        CvListComponent,
        CvNewComponent,
        CvDetailComponent
    ],
    providers: [],
})
export class CvModule { }
