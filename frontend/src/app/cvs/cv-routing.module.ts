import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CvNewComponent } from './cv-new/cv-new.component';


const routes: Routes = [
  { path: ':id/new', component: CvNewComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CvRoutingModule { }