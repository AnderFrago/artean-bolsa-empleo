import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ApplymentsComponent } from './applyments.component';
import { ReactiveFormsModule } from '@angular/forms';
import { MatTableModule } from '@angular/material/table';
import { ApplymentsService } from '../shared/applyments.service';
import { ApplymentsRoutingModule } from './applyments-routing.module';
import { MatIconModule } from '@angular/material/icon';
import { MatButtonModule } from '@angular/material/button';
import { MatDialogModule } from '@angular/material/dialog';
import { MatRadioModule } from '@angular/material/radio';
import { ApplymentsStateComponent } from './applyments-state/applyments-state.component';


@NgModule({
  declarations: [
    ApplymentsComponent,
    ApplymentsStateComponent
  ],
  imports: [
    CommonModule,
    MatTableModule,
    ReactiveFormsModule,
    ApplymentsRoutingModule,
    MatIconModule,
    MatButtonModule,
    MatDialogModule,
    MatRadioModule
  ],
  providers: [
    ApplymentsService
  ]
})
export class ApplymentsModule { }
