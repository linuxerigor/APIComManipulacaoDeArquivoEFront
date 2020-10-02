import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { CategoriaComponent } from './categoria/categoria.component';
import { HomeComponent } from './home/home.component';
import { EndpointService } from './endpoint.service';
import { HttpClientModule } from '@angular/common/http';
import { ItemComponent } from './categoria/item/item.component';
import { ReactiveFormsModule } from '@angular/forms';
import { ToastService } from './toast.service';
import { ToastsContainer } from './toasts-container.component';

@NgModule({
  declarations: [
    AppComponent,
    ToastsContainer,
    CategoriaComponent,
    HomeComponent,
    ItemComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    ReactiveFormsModule,
    AppRoutingModule,
    NgbModule
  ],
  providers: [EndpointService, ToastService],
  bootstrap: [AppComponent]
})
export class AppModule { }
