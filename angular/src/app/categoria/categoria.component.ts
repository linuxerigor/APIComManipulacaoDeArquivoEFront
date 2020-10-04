import { Time } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { EndpointService } from '../endpoint.service';
import { Categoria } from '../categoria';
import { take } from 'rxjs/operators';
import { Router } from '@angular/router';
import { ToastService } from '../toast.service';
import { FormControl } from '@angular/forms';

@Component({
  selector: 'app-categoria',
  templateUrl: './categoria.component.html',
  styleUrls: ['./categoria.component.sass']
})
export class CategoriaComponent implements OnInit {

  categorias: Categoria;
  loading = false;

  searchfield = new FormControl('');

  constructor(private endpoint: EndpointService,
              public toastService: ToastService,
              private router: Router) { }

  ngOnInit(): void {
    this.fillCategorias();
  }

  fillCategorias(q = null){
    this.loading = true;
    this.endpoint.getcategorias(q).pipe(take(1)).subscribe(
      (data: Categoria) => {
        this.categorias = data;
        this.loading = false;
      }
    );
  }

  onEdit(item){
      this.router.navigate(['/categoria/edit/', item.id]);
  }

  onDelete( id: number ){

    this.loading = true;

    this.endpoint.deletecategoria(id).pipe(take(1)).subscribe(
      (result: any) => {
        this.loading = false;
        if (result.success){
          this.toastService.show(result.success, { classname: 'bg-success text-light', delay: 5000 });
          this.fillCategorias();
        }else{
          this.toastService.show(result.error, { classname: 'bg-danger text-light', delay: 5000 });
        }
      }
    );
  }

  onSearch(){
    this.fillCategorias(this.searchfield.value);
  }

}
