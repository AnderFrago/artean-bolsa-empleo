import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { ApplymentsComponent } from './applyments.component';



const routes: Routes = [
  { path: ':id/manage', component: ApplymentsComponent },
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ApplymentsRoutingModule { }