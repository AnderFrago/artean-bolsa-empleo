import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Cv } from 'src/app/shared/cv';
import { CvService } from 'src/app/shared/cv.service';

@Component({
  selector: 'app-cv-detail',
  templateUrl: './cv-detail.component.html',
  styleUrls: ['./cv-detail.component.scss']
})
export class CvDetailComponent implements OnInit {

  cv: Cv;
  prodId: number;

  constructor(private activatedroute: ActivatedRoute, private router: Router, private cvService: CvService) {}

  ngOnInit() {
    this.prodId = parseInt(this.activatedroute.snapshot.params['id']);
    this.cvService.getCvById(this.prodId).subscribe(
      (data: Cv) => this.cv = data
    );
  }
  goEdit():void{
    this.router.navigate(['/cvs', this.prodId, 'edit']);
  }
  onBack(): void {
    this.router.navigate(['']);
  }

}
