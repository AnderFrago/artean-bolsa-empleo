import { Component, Input, OnInit } from '@angular/core';
import { Cv } from 'src/app/shared/cv';

@Component({
  selector: 'app-cv-item',
  templateUrl: './cv-item.component.html',
  styleUrls: ['./cv-item.component.scss']
})
export class CvItemComponent implements OnInit {

  @Input() cv: Cv;

  constructor() { }

  ngOnInit(): void {
    console.log(this.cv);
    
  }

}
