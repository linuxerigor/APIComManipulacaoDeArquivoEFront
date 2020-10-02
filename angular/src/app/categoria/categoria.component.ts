import { Time } from '@angular/common';
import { Component, OnInit } from '@angular/core';
import { EndpointService } from '../endpoint.service';
import { Categoria } from '../categoria';
import { take } from 'rxjs/operators';
import { Router } from '@angular/router';

@Component({
  selector: 'app-categoria',
  templateUrl: './categoria.component.html',
  styleUrls: ['./categoria.component.sass']
})
export class CategoriaComponent implements OnInit {

  categorias: Categoria;
  loading = false;

  constructor(private endpoint: EndpointService,
              private router: Router) { }

  ngOnInit(): void {
    this.loading = true;

    this.endpoint.getcategorias().pipe(take(1)).subscribe(
      (data: Categoria) => {
        this.categorias = data;
        this.loading = false;
      }
    );

  }

  edit(item){
    console.log(item);
      this.endpoint.passing(item);
      this.router.navigate(['/categoria/edit/', item.id]);

  }

}
