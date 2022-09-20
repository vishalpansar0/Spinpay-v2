import { ComponentFixture, TestBed } from '@angular/core/testing';

import { BorrowwerSidebarComponent } from './borrowwer-sidebar.component';

describe('BorrowwerSidebarComponent', () => {
  let component: BorrowwerSidebarComponent;
  let fixture: ComponentFixture<BorrowwerSidebarComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ BorrowwerSidebarComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(BorrowwerSidebarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
