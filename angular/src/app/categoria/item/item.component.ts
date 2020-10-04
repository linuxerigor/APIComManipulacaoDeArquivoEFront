import { Component, OnInit } from '@angular/core';
import { FormControl, Validators } from '@angular/forms';
import { EndpointService } from 'src/app/endpoint.service';
import { take } from 'rxjs/operators';
import { ToastService } from 'src/app/toast.service';
import { ActivatedRoute, Router, RouterModule } from '@angular/router';
import { Categoria } from '../../categoria';

@Component({
  selector: 'app-add',
  templateUrl: './item.component.html',
  styleUrls: ['./item.component.sass']
})
export class ItemComponent implements OnInit {

  name = new FormControl('', [ Validators.required, Validators.minLength(1) ]);
  loading = false;
  setid = null;
  itemselected: Categoria;

  constructor(private endpoint: EndpointService,
              private router: Router,
              private route: ActivatedRoute,
              public toastService: ToastService) { }

  ngOnInit(): void {

    const id: string = this.route.snapshot.paramMap.get('id');
    if (id){
      this.itemselected = this.endpoint.memorised(id);

      if (!this.itemselected) {
        this.router.navigate(['/categoria']);
      }

      this.name.setValue(this.itemselected.name);

    }

  }

  salvarorchange(){
      this.loading = true;

      if (this.itemselected){
        this.endpoint.editcategoria(this.itemselected.id,this.name.value).pipe(take(1)).subscribe(
          (result: any) => {
            this.loading = false;
            if (result.success){
              this.toastService.show(result.success, { classname: 'bg-success text-light', delay: 5000 });
              this.router.navigate(['/categoria']);
            }else{
              this.toastService.show(result.error, { classname: 'bg-danger text-light', delay: 5000 });
            }
          }
        );

      }else{
          this.endpoint.addcategoria(this.name.value).pipe(take(1)).subscribe(
            (result: any) => {
              this.loading = false;
              if (result.success){
                this.toastService.show(result.success, { classname: 'bg-success text-light', delay: 5000 });
                this.router.navigate(['/categoria']);
              }else{
                this.toastService.show(result.error, { classname: 'bg-danger text-light', delay: 5000 });
              }
            }
          );
      }

  }

}
