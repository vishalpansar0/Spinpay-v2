import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AadharComponent } from './aadhar.component';

describe('AadharComponent', () => {
  let component: AadharComponent;
  let fixture: ComponentFixture<AadharComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AadharComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AadharComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
