import { BrowserModule } from '@angular/platform-browser';
import { NgModule, LOCALE_ID } from '@angular/core';

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
import { registerLocaleData } from '@angular/common';
import localePt from '@angular/common/locales/pt';

registerLocaleData(localePt, 'pt');

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
  providers: [{ provide: LOCALE_ID, useValue: 'pt' }, EndpointService, ToastService],
  bootstrap: [AppComponent]
})
export class AppModule { }
