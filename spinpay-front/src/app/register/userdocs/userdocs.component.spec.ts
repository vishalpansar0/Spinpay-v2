import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UserdocsComponent } from './userdocs.component';

describe('UserdocsComponent', () => {
  let component: UserdocsComponent;
  let fixture: ComponentFixture<UserdocsComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ UserdocsComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(UserdocsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
