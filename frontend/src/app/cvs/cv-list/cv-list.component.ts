import { Component, OnInit } from '@angular/core';
import { Cv } from 'src/app/shared/cv';
import { CvService } from 'src/app/shared/cv.service';

@Component({
  selector: 'app-cv-list',
  templateUrl: './cv-list.component.html',
  styleUrls: ['./cv-list.component.scss']
})
export class CvListComponent implements OnInit {
  cvs: Cv[]=[];
  constructor(private cvService: CvService) { }

  ngOnInit() {
   this.cvService.getCvs().subscribe(
    (data: Cv[]) => this.cvs = data
   );
  }
}