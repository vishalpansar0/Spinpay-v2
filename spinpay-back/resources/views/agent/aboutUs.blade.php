
@include('layouts.header')
<div class="navbar fixed-top" id="nav" style="background-color:black">
  <div class="container">
    <div class="logo-container">
      <a href="{{url('/')}}" style="text-decoration:none;color:white">SpinPay</a>
    </div>
    <div class="menu-container">
      <h4><a href="/signin">login</a></h4>
      {{-- <form action="{{ url('/logout') }}" method="post">
       @csrf
       <button>login</button></form> --}}
   </div>
  </div>
</div>
<div class="container" style="margin-top:120px">
<h1 style='text-align: center'>About Us</h1><br>
<div style='text-align: center'>
    <h5>We created this website for any individuals to obtain loans directly from other individuals, cutting out the financial institution as the middleman.</h5>
    <h5>Our website connects borrowers directly to lenders. The site sets the rates and terms and enables the transactions.</h5>
    <h5>Our motive is lenders who are individual investors want to get a better return on their cash savings than a bank savings account. And borrowers who need instant money.</h5>
</div>


<section class="team text-center py-5">
    <div class="container">
      <div class="header my-5">
        <h1>Meet our Team </h1>
      </div>
      <div class="row">
        <div class="col-md-6 col-lg-3">
          <div class="img-block mb-5">
            <img style="min-width:310px" src="https://lh3.googleusercontent.com/KGU4TqU3aBTpQI7S4qMxTCdJqJmgXjledEtT691ai6faAbtXhUu2w9zR3zAGoeBr9X5BLNTm_W34Z88-fx20CtymxiaXKGj73dziOTbXHmwLwWVEmW4nziFIfLYSRsjUFmAxCL9t_olBeI4LlgNMhgFf4T1UEE0KUkpny-LZf5Pqvqd_ZJydniWfLwYigL6Hz5I5e0lp7226tE_W6SQIdaNCA2-MXTowYM28gjmese80sN6fZXVtbHZIrVTv7psEofdyfqdGbJ4zmguaiNqHlMBKu9MOQXqaeqaGOREhWvAaJTRmovZuNPilytDI64CF3myNY0oixR4N8JsuZYaoA1LEB3CScMqL-eZ1ZwnJC6kzmlcGjCRcmIeZQkr8cvOP0lNl0TmbMkvCSzPdtljupNxU3ILPO7oyl8BhIWLAnQufxX7Ricd8WrBhstmOIQf49mbqxV-LpI0NY2Lfrw8QJlkE9fwaSFUOxqU__QqhYleljW1sDbIN9xmjPNNbWWvHfg_6WMn_32salaYL4DTWb5GLSN50lJG6LvH_s8xldmXQVIwoN1RTpIdCINqxyAPpg3TAfpQvMHTXk8GGNWNObYoPJANiJlrI_QepdiAkZPFrvP4ih_4uuPuXvmyxLn8jJ391IBMaxnMlyw26oqrlhXNcZOg_eHMmlpI3jWHCVSzejCxfSH2XnNuvIV4xkhb49A3AwSadm1d7G6uhRAQc7ZB48jshRdhnS8RrEM_ssV3eMSJPvZvud1O05k8=w425-h426-no?authuser=0" class="img-fluid  img-thumbnail rounded-circle" alt="image1">
            <div class="content mt-2">
              <h4>Vishal Sharma</h4>
              <p class="text-muted">ASE at mPokket</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3 ">
          <div class="img-block mb-5">
            <img src="https://lh3.googleusercontent.com/Dez5eabyhvY5wDwPa1m74cE-taFH_jwq8lOKa4thgKhsVREFvhznnBvrOzQQiCXz3WHEsiTgl0MIzSZW4121b0b65VZfHherY5Bh_WkQd_A6Vvc70ovmk_Ymty88YvhvwgISO0bnDIL3X5ptJ1Gg7eU-F81WVyFq8Rw0uoGLF9RvUvoRiLIzuWouEsXNU4ZUVg86ss420drTQCKYqfvpURcDpzFyc2xbOIVc17HtrlVDrX-d9HRe2qguK9y5XsuWMTbTf7PZsjdnZ3-d5PB6Dt60tly0Ft_kDWHNvm7NLvWYhGabl_kKa685VrQsaIRoaWCSWr1R6EkjlHVZGdXaGzenKgGCcJBa5TlFBDEHD_IGmwzPjwGz5g41EWKQQIqDURtxrPUfhZkidWZ7WvlZauKyN9uGFvTOFzbHeBsyMybuQ8XwuA_E8MjOCWBJakRo6UtvVry596j-9m9Cxu9A-PEDP1_OJmVVXeJIxGfzTFb-fX0KdQOIQyn1wAkasDsPARzCPB40hLuLexYwVaLAJfgPPk0wDEiTcqS19cHFjnJ6jQ2HlJ2UcCP7Lv9DiMycGMVKRrR8WowOOLywPIXDD5S15ehJpP5BqWUTegn74GNJr4M_OZkqfk4BngRjPmb1UEWejTpOQ03HZLRds8XMQuhiXdGkIlnnrT3UKJkxeMrvHjsZTTDQkSMKi-UMGyNW3zceDt3k86miiM1teT0RH9ZxGQCHcDowUsojrkSoZAA9t-kwbzrWW46Oabo=s811-no?authuser=0" class="img-fluid  img-thumbnail rounded-circle" alt="image1">
            <div class="content mt-2">
              <h4>Sathwik</h4>
              <p class="text-muted">ASE at mPokket</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="img-block mb-5">
            <img src="https://lh3.googleusercontent.com/Ag2nVUHI7iYOahxp6lwByDn3r0KpyAqDv3a6WxkSv4qFRe-3gvdJapwzVswv1XD0acj0285BgBYUceew5rZ05nxhQNpURRrewZzS6Z2zri5TdvFu2Lz0sQXWKILEv2vs3BTVFnpbACKbo4l_wacAfGsYuwaQ_4lgmI4XApxZPa2xNmxETWt_R-i8BvFYSY0BaPtpaJXUvJRFVJmbyi6NcNSZEeOqu62iQavGBPm26dHVmeOIfZfr4Jm1pHrtGqKho-7qsTBKkNoBH9KrXLhTHDmnYHXmDPa4XAx96z_5j8SaPol4gGfuEFd7gEVgM5TmuHwngIb2RzzzzVCnYGRQhNgk8S-dpbrnSEITWq9bGKqe2lwsEwUnITJPE0cs6_EXshr86OrO26uEsMHkGUVoXDtR8PDFoOZcq91EyZ0A6xXvjRBmVWfMNmR9cSjVdZtpy_VACZPFaggbbl_k7J4aq34BLky1mJiCAQx7es9F3Baerp1ZcK3xcMUzZfhLIX3ZoBZ2RKZVWv12aVWjr6yAFMnrm1txBRWvFodCk3dHn69EmLdKHJDeJCeL02EXS9Ctssu5HqLonBGukVVQs76ilxtFAc-0GARJ6a1XBXyoXaaB1H63VfLFlvZ28hW9TUX0ZKJA2rEppuzRPlpvcRuDVCOzXHlfCXcVkZSCbgSOFGD73kJPxr9BvuYAagildBFI1isi5WPsVCpCtzAzmJ-cQttkbrAuO-3QsNdoyLwIsM-bDXjO73cermNNayA=s640-no?authuser=0" class="img-fluid  img-thumbnail rounded-circle" alt="image1">
            <div class="content mt-2">
              <h4>Abhishek Borana</h4>
              <p class="text-muted">ASE at mPokket</p>
            </div>
          </div>
        </div>
        <div class="col-md-6 col-lg-3">
          <div class="img-block mb-5">
            <img src="https://lh3.googleusercontent.com/aQzoStmSHIhbfsE_yVSjPWsI2ptYqOe_psvul-TEUvRWrO-ovlU88qHOFeZpBMQy9KfJjQaD9miead_koAjn-XPQbfGpVqHOTfPo9SEQcJXsViX4dCHdtQ_Ejz1CsDjjySls5C-pYjGB5b0_SHkzsT-mWr6x30O-41Az37r3Y5LXOAo-7xnISfuqxhyTUh9HIpdyoqpI0BRuGEpNIY8J7le87Ib4aGmvKiWyvwNUJ2VBDMlEa97-uKVYTU8-tAuTQ8wTjYh38zbXvgCNIDO1q8SZJlhRFre1rXyzq_lDPzPtShIbV0kXDOgBqjQHoECdlIpDtg58lA5G2gzx3c5onJotFbypHSpdjLkj4jlW50Y9QkwZEDLdTv6Lwr7P5MPKaBorZobmWRspHxBkoLiFJ1JVIvBXfZzuvLv0A_1rVrUkPcvus8PuG1YGzh0IcAAG1rUbIqFitDB8RiB2yYCeknxEkT6L74Fd3gfbr24Ia1e0gMRUGQlfkuTixYH3Bu_N2Qt2Cq-KKgDoFBmqzredude7d1k_KdtCxxGyidnVSomiDdDPQN4MYuDpqXM-nPMipTCVRZyKVytAVW7KYjMcD0s85L_952bDYp5o1Y5LYEdn9h-QpHH7FBn_FGfRjxtN4zalziCmW76XY73PbuPkUvzyiZM8UFsIwsZSIu2N2eAQys9EjkdF5TRAiVtbuzlrAE0uNAwxsWK0sGspzURux0VNmTmvmh_hI02z4aXcRXzQdvhiiaTUlE1hf98=w639-h640-no?authuser=0" class="img-fluid  img-thumbnail rounded-circle" alt="image1">
            <div class="content mt-2">
              <h4>Arvind Maurya</h4>
              <p class="text-muted">ASE at mPokket</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
