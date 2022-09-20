import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BorrowwerDashboardComponent } from './borrowwer-dashboard.component';

describe('BorrowwerDashboardComponent', () => {
  let component: BorrowwerDashboardComponent;
  let fixture: ComponentFixture<BorrowwerDashboardComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BorrowwerDashboardComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(BorrowwerDashboardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
