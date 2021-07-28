import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { SearchComponent } from './search/search.component';
import { StudentsComponent } from './students/students.component';
import { ReactiveFormsModule } from '@angular/forms';
import { ArteanRoutingModule } from './artean-routing.module';
import {MatProgressSpinnerModule} from '@angular/material/progress-spinner';
import { StudentsStateComponent } from './students-state/students-state.component';
import { MatDialogModule } from '@angular/material/dialog';
import { MatRadioModule } from '@angular/material/radio';
import { EmployersStateComponent } from './employers-state/employers-state.component';
import { EmployersComponent } from './employers/employers.component';


@NgModule({
  declarations: [
    SearchComponent,
    StudentsComponent,
    EmployersComponent,
    StudentsStateComponent,
    EmployersStateComponent
  ],
  imports: [
    CommonModule,
    ReactiveFormsModule,
    ArteanRoutingModule,
    MatProgressSpinnerModule,
    MatDialogModule,
    MatRadioModule
  ]
})
export class ArteanModule { }
