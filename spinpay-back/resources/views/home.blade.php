@include('layouts.header')

@push('title')
  <title>SpinPay | P2P Lending Platform</title>
@endpush


@include('layouts.navbar')   

     <section class="jumbotron-fluid section-1">
           <div class="container text-center div-1">
             <div class="main-head" style="margin-top:140px">
                 india's no1 most trusted p2p lending platform
             </div>
               <div class="join-btn-container">
                 <a href="{{url('/register/userinfo')}}">
                  <button class="join-btn">join now</button>
                 </a>
               </div>
           </div>
     </section>


    
    <section class="jumbotron-fluid section-1">
          <div class="div-2 wow fadeInUpBig" data-wow-delay="0s">
              <div class="section-1-content-container">
                <div class="section-1-content-container-1">
                  <div class="sub-head sub-head-1-color">
                    what is it?
                  </div>
                  <div class="sub-content">
                     <span style="color:#3EA977">Peer to Peer lending, also known as P2P Lending, is a financial innovation which connects verified borrowers seeking unsecured personal loans with investors looking to earn higher returns on their investments.</span>
                     <span style="color:#0074A7">Peer to Peer Lending is already a hugely successful model for alternate financing across the globe.</span>
                  </div>
             </div>
             <div class="text-center section-1-content-container-1">
              <img class="fade-left" src="{{url('images/borrower-icon-4.jpg')}}" alt="">
            </div>
            
              </div>
          </div>
    </section>
    {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
      <a style="color:white" class="dropdown-item" href="{{ route('logout') }}"
         onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
      </form>
  </div> --}}
    <div class="modal fade" id="join-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content join-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><strong>join today</strong></h5>
                    
                    <button style="border:none;background:none;color:white" type="button" data-bs-dismiss="modal"
                        aria-label="Close">x</button>
                </div>
                <div class="modal-body">
                    <div class="join-modal-body-container">
                      <div class="left-modal-body">
                        <div class="modal-body-content" >
                                as a lender
                        </div>
                      </div>
                      <div class="right-modal-body">
                        <div class="modal-body-content">
                                as a borrower
                        </div>
                      </div>
                    </div>
                </div>
              
            </div>
        </div>
    </div>
    <section class="jumbotron-fluid section-2">
      <div class="div-2" data-wow-delay="0s">
          <div class="section-1-content-container">
            <div class="section-1-content-container-1 wow slideInLeft">
              <div class="sub-head sub-head-2-color">
                how it works?
              </div>
              <div class="sub-content">
                 <span style="color:black">for lenders -</span><span style="color:rgb(233, 225, 225)"> Lenders have to follow a simple registration process and provide the required documents as mentioned on our site. Once the verification is complete, the lender has pre-funded the Lender’s Escrow account with the amount he wishes to invest; he can start investing. He can see all loan requests on his dashboard and and can choose <a href="#" style="text-decoration:none;color:0074A7">learn more</a></span><br>
                 <span style="color:black">for lenders -</span><span style="color:rgb(233, 225, 225)"> Borrowers have to follow a simple registration process and provide the required documents as mentioned on our site. As part of the verification process, the team gets in touch with the prospective borrowers. <a href="#" style="text-decoration:none;color:0074A7">learn more</a></span>
                 
              </div>
         </div>
         <div class="text-center section-1-content-container-1 wow slideInRight">
          <img class="fade-left" src="{{url('images/hands.jpg')}}" alt="" id="hands-img">
        </div>
        
          </div>
      </div>
</section>

@include('layouts.jsfiles')
@include('layouts.footer')