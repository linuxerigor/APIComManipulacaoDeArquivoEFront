import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Categoria } from './categoria';
import { take, tap } from 'rxjs/operators';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class EndpointService {

  private url = '/api';
  public categorias: any;

  itemedit: Categoria;

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type':  'application/json'
    })
  };

  constructor(private http: HttpClient) { }

  getcategorias(q = null){
    if (q){
      return this.http.post<Categoria>(this.url + '/categoria/search', q, this.httpOptions).pipe(
        take(1),
        tap((s) => this.categorias = s)
      );
    }else{
      return this.http.get<Categoria>(this.url + '/categoria').pipe(
        take(1),
        tap((s) => this.categorias = s)
      );
    }
  }

  addcategoria(data: Categoria){
    return this.http.post<Categoria>(this.url + '/categoria/add', data, this.httpOptions);
  }

  editcategoria(id: number, data: Categoria){
    return this.http.post<Categoria>(this.url + '/categoria/edit/' + id, data, this.httpOptions);
  }

  deletecategoria(id: number){
    return this.http.get<Categoria>(this.url + '/categoria/delete/' + id);
  }


  memorised(id) {
    if(!this.categorias)
      return null;
    return this.categorias.filter( (el) => el.id == id )[0];
  }

}
