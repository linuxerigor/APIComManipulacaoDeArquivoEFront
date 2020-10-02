import { Component, OnInit } from '@angular/core';
import { FormControl } from '@angular/forms';
import { EndpointService } from 'src/app/endpoint.service';
import { take } from 'rxjs/operators';
import { ToastService } from 'src/app/toast.service';
import { ActivatedRoute, Router, RouterModule } from '@angular/router';

@Component({
  selector: 'app-add',
  templateUrl: './item.component.html',
  styleUrls: ['./item.component.sass']
})
export class ItemComponent implements OnInit {

  name = new FormControl('');

  loading = false;

  constructor(private endpoint: EndpointService,
              private router: Router,
              private route: ActivatedRoute,
              public toastService: ToastService) { }

  ngOnInit(): void {

    let id = this.route.snapshot.paramMap.get('id');
    let value = this.endpoint.passing(false);
    if(value){
      console.log(value);
      this.name.setValue(value.name);
    }

  }

  salvar(){
      this.loading = true;
      this.endpoint.addcategoria(this.name.value).pipe(take(1)).subscribe(
        (result: any) => {
          console.log(result);
          this.loading = false;
          if (result.success){
            this.toastService.show(result.success, { classname: 'bg-success text-light', delay: 10000 });
            this.router.navigate(['/categoria']);
          }else{
            this.toastService.show(result.error, { classname: 'bg-danger text-light', delay: 15000 });
          }
        }
      );

  }

}
