import { Component, Inject, OnInit } from '@angular/core';
import { MatDialogRef, MAT_DIALOG_DATA } from '@angular/material/dialog';

@Component({
  selector: 'app-alerts',
  templateUrl: './alerts.component.html',
  styleUrls: ['./alerts.component.scss']
})
export class AlertsComponent implements OnInit {

  item ='';
  type = "info" || "error";
  constructor(
    @Inject(MAT_DIALOG_DATA)
    private data: any,
  ) { }

  ngOnInit(): void {
    this.item = this.data.item;
    this.type = this.data.type;
  }

}
