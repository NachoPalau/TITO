import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PgProdComponent } from './pg-prod.component';

describe('PgProdComponent', () => {
  let component: PgProdComponent;
  let fixture: ComponentFixture<PgProdComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [PgProdComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(PgProdComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
