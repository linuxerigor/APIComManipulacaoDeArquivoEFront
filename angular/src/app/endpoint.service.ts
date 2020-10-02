import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Categoria } from './categoria';

@Injectable({
  providedIn: 'root'
})
export class EndpointService {

  private url = '/api';

  itemedit: Categoria;

  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type':  'application/json'
    })
  };

  constructor(private http: HttpClient) { }

  getcategorias(){
    return this.http.get<Categoria>(this.url + '/categoria');
  }

  addcategoria(data: Categoria){
    return this.http.post<Categoria>(this.url + '/categoria/add', data, this.httpOptions);
  }


  passing(data){
      if(data)
        this.itemedit = data;
      else
        return this.itemedit;
  }

}
