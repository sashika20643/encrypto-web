@extends('layouts.layout')

@section('content')

<div class="container">

    <div class="container-fluid py-4">
        <div class="row d-flex justify-content-between align-items-center">
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card p-2">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Total users</p>
                      <h5 class="font-weight-bolder mb-0">
                       {{$user}}
                        <span class="text-success text-sm font-weight-bolder">+55%</span>
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card p-2">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Total files</p>
                      <h5 class="font-weight-bolder mb-0">
                        {{$file}}
                        <span class="text-success text-sm font-weight-bolder">+3%</span>
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                      </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-capitalize font-weight-bold">Total size</p>
                      <h5 class="font-weight-bolder mb-0">
                        {{$size}}MB
                        <span class="text-danger text-sm font-weight-bolder">-2%</span>
                      </h5>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                      </div>

                  </div>
                </div>
              </div>
            </div>
          </div>



          <div class="row mt-5 d-flex justify-content-between align-items-center">
            <div class="col-lg-5 mb-lg-0 mb-4">
              <div class="card p-3">
                <div class="card-body p-3">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="d-flex flex-column h-100">
                        <p class="mb-1 pt-2 text-bold">Encrypto</p>
                        <h5 class="font-weight-bolder">Files</h5>
                        <p class="mb-5">

                        Storing your company's documents at your premises with higher security. 

Update, track and share your documents seamlessly. </p>
                        <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{route('files')}}">
                         View Files
                          <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                        </a>
                      </div>
                    </div>
                    <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                      <div class="bg-gradient-primary border-radius-lg h-100">
                        <img src="../assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                        <div class="position-relative d-flex align-items-center justify-content-center h-100">
                          <img class="w-100 position-relative z-index-2 pt-4" src="../assets/img/illustrations/rocket-white.png" alt="rocket">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-5 mb-lg-0 mb-4 ">
                <div class="card pt-3">
                  <div class="card-body pt-3">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="d-flex flex-column h-100">
                          <p class="mb-1 pt-2 text-bold">Encrypto</p>
                          <h5 class="font-weight-bolder">Access Given Files</h5>
                          <p class="mb-5"> Who gave the access of their files to you? 

Let's have a glance 👇🏻</p>
                          <a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="{{route('recivedfiles')}}">
                          Other Files
                            <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                          </a>
                        </div>
                      </div>
                      <div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
                        <div class="bg-gradient-primary border-radius-lg h-100">
                          <img src="../assets/img/shapes/waves-white.svg" class="position-absolute h-100 w-50 top-0 d-lg-block d-none" alt="waves">
                          <div class="position-relative d-flex align-items-center justify-content-center h-100">
                            <img class="w-100 position-relative z-index-2 pt-4" src="../assets/img/illustrations/rocket-dark.png" alt="rocket">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          </div>
        </div>



@endsection
