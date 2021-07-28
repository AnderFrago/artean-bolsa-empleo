import { Component, EventEmitter, Inject, Input, OnInit, Output } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { UserState } from 'src/app/shared/user';
import { MatRadioButton, MatRadioGroup } from '@angular/material/radio';
import { FormBuilder, Validators } from '@angular/forms';
import { ArteanService } from 'src/app/shared/artean.service';


@Component({
  selector: 'app-employers-state',
  templateUrl: './employers-state.component.html',
  styleUrls: ['./employers-state.component.scss']
})
export class EmployersStateComponent implements OnInit {

  isSet = false;
  stateForm: any;
  state: UserState


  constructor(
    @Inject(MAT_DIALOG_DATA)
    private data: any,
    public fb: FormBuilder,
    private arteanService: ArteanService,
    private dialogRef: MatDialogRef<EmployersStateComponent>
  ) { }


  ngOnInit(): void {
    this.stateForm = this.fb.group({
      state: [this.data.numstate, [Validators.required]]
    })
  }



  get myForm() {
    return this.stateForm.get('state');
  }

  onSubmit() {
    this.isSet = true;
    if (!this.stateForm.valid) {
      return false;
    } else {
      console.log(JSON.stringify(this.stateForm.value))
      let newnumstate = parseInt(this.stateForm.value.state);

      switch (newnumstate) {
        case 1:
          this.state = UserState.Validated;
          break;
        case 2:
          this.state = UserState.Rejected
          break;       
        default:
          this.state = UserState.Waiting
          break;
      }

      this.arteanService.updateEmployerState( this.data.employername,  this.state).subscribe(data => {
         console.log(data);
         this.dialogRef.close();
       })


    }

  }

  
}
