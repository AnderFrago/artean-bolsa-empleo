import { Component, EventEmitter, Inject, Input, OnInit, Output } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';
import { CVState } from 'src/app/shared/cv';
import { MatRadioButton, MatRadioGroup } from '@angular/material/radio';
import { FormBuilder, Validators } from '@angular/forms';
import { ApplymentsService } from 'src/app/shared/applyments.service';


@Component({
  selector: 'app-applyments-state',
  templateUrl: './applyments-state.component.html',
  styleUrls: ['./applyments-state.component.scss']
})
export class ApplymentsStateComponent implements OnInit {

  isSet = false;
  stateForm: any;
  state: CVState


  constructor(
    @Inject(MAT_DIALOG_DATA)
    private data: any,
    public fb: FormBuilder,
    private applymentsService: ApplymentsService,
    private dialogRef: MatDialogRef<ApplymentsStateComponent>
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
          this.state = CVState.Reading;
          break;
        case 2:
          this.state = CVState.ContinueProcess
          break;
        case 3:
          this.state = CVState.Discard
          break;
        case 4:
          this.state = CVState.Selected
          break;
        default:
          this.state = CVState.Waiting
          break;
      }

      this.applymentsService.updateApplymentState(this.data.offerId, this.state, this.data.studentname).subscribe(data => {
        console.log(data);
        this.dialogRef.close();
      })


    }

  }
}
