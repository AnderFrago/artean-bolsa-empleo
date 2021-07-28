import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { AuthGuard } from '../shared/auth-guard.service';
import { RouterModule, Routes } from '@angular/router';
import { SearchComponent } from './search/search.component';
import { StudentsComponent } from './students/students.component';
import { EmployersComponent } from './employers/employers.component';


const routes: Routes = [
  {
    path: '',
    component: SearchComponent
  },
   { path: 'artean/students', component: StudentsComponent, canActivate: [AuthGuard] },
   { path: 'artean/employers', component: EmployersComponent, canActivate: [AuthGuard] }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class ArteanRoutingModule { }
