import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CategoriaComponent } from './categoria/categoria.component';
import { HomeComponent } from './home/home.component';
import { ItemComponent } from './categoria/item/item.component';


const routes: Routes = [
  { path: 'home', component: HomeComponent },
  { path: 'categoria', component: CategoriaComponent },
  { path: 'categoria/add', component: ItemComponent },
  { path: 'categoria/edit/:id', component: ItemComponent },
  { path: '',   redirectTo: '/home', pathMatch: 'full' },
];

@NgModule({
  imports: [RouterModule.forRoot(routes,  { useHash: true })],
  exports: [RouterModule]
})
export class AppRoutingModule { }
