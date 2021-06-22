import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CvDetailComponent } from './cv-detail/cv-detail.component';
import { CvListComponent } from './cv-list/cv-list.component';
import { CvNewComponent } from './cv-new/cv-new.component';


const routes: Routes = [
  {
    path: '',
    component: CvListComponent
  },
  {path: ':id/new', component: CvNewComponent},
  {path: ':id', component: CvDetailComponent},
  {path: ':id/edit', component: CvListComponent}
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class CvRoutingModule {}