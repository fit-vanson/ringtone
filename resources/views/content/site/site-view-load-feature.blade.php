@extends('layouts/contentLayoutMaster')

@section('title', 'Site View - Load Feature')

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(('vendors/css/animate/animate.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(('vendors/css/extensions/sweetalert2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(('vendors/css/tables/datatable/buttons.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(('vendors/css/tables/datatable/rowGroup.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(('vendors/css/extensions/toastr.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(('css/base/plugins/extensions/ext-component-sweet-alerts.css')) }}">
  <link rel="stylesheet" href="{{ asset(('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<section class="app-user-view-account">
  <div class="row">
    <!-- User Sidebar -->
  @include('content.site.site-info')
    <!--/ User Sidebar -->

    <!-- User Content -->
    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
      <!-- User Pills -->
      <ul class="nav nav-pills mb-2">
        <li class="nav-item">
          <a class="nav-link " href="{{asset('admin/site/view/'.$site->web_site)}}">
            <i data-feather="folder" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Categories</span></a
          >
        </li>
        <li class="nav-item">
          <a class="nav-link"  href="{{asset('admin/site/view/'.$site->web_site.'/block-ips')}}">
            <i data-feather="lock" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Block Ips</span>
          </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/site/view/'.$site->web_site.'/home')}}">
            <i data-feather="home" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Web Home</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/site/view/'.$site->web_site.'/policy')}}">
                <i data-feather="file-text" class="font-medium-3 me-50"></i><span class="fw-bold">Policy</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{asset('admin/site/view/'.$site->web_site.'/feature-images')}}">
                <i data-feather="image" class="font-medium-3 me-50"></i><span class="fw-bold">Feature Images</span>
            </a>
        </li>

          <li class="nav-item">
              <a class="nav-link active"  href="{{asset('admin/site/view/'.$site->web_site.'/load-feature')}}">
                  <i data-feather="loader" class="font-medium-3 me-50"></i>
                  <span class="fw-bold">Load Feature</span>
              </a>
          </li>
      </ul>
      <!--/ User Pills -->

      <!-- Categories table -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Load Feature</h4>
            </div>
{{--            @dd($site->load_view_by)--}}
            <div class="card-body">
                <p class="card-text mb-0 ">
                    Load Home Features
                </p>
                <div class="demo-inline-spacing justify-content-center">
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="load_home_features"
                            value="0"
                            <?=
                                $site->load_home_features == 0 ?'checked' : '';
                            ?>

                        />
                        <label class="form-check-label" for="random">Random</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="load_home_features"
                            value="1"
                        <?=
                            $site->load_home_features == 1 ?'checked' : '';
                            ?>
                        />
                        <label class="form-check-label" for="manual">Manual</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name ="load_home_features"
                            value="2"
                        <?=
                            $site->load_home_features == 2 ?'checked' : '';
                            ?>
                        />
                        <label class="form-check-label" for="most_view">Most View</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name ="load_home_features"
                            value="3"
                        <?=
                            $site->load_home_features == 3 ?'checked' : '';
                            ?>
                        />
                        <label class="form-check-label" for="feature_wallpaper">Feature Wallpaper</label>
                    </div>
                </div>
                <br>
                <p class="card-text mb-0">
                    Load Wallpapers
                </p>
                <div class="demo-inline-spacing justify-content-center">
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="load_wallpapers"
                            value="0"
                        <?=
                            $site->load_wallpapers == 0 ?'checked' : '';
                            ?>

                        />
                        <label class="form-check-label" for="random">Random</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name="load_wallpapers"
                            value="1"
                        <?=
                            $site->load_wallpapers == 1 ?'checked' : '';
                            ?>
                        />
                        <label class="form-check-label" for="manual">Most Like</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name ="load_wallpapers"
                            value="2"
                        <?=
                            $site->load_wallpapers == 2 ?'checked' : '';
                            ?>
                        />
                        <label class="form-check-label" for="most_view">Most View</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name ="load_wallpapers"
                            value="3"
                        <?=
                            $site->load_wallpapers == 3 ?'checked' : '';
                            ?>
                        />
                        <label class="form-check-label" for="feature_wallpaper">Feature Wallpaper</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input
                            class="form-check-input"
                            type="radio"
                            name ="load_wallpapers"
                            value="4"
                        <?=
                            $site->load_wallpapers == 4 ?'checked' : '';
                            ?>
                        />
                        <label class="form-check-label" for="feature_wallpaper">Sort ABC</label>
                    </div>
                </div>
            </div>
        </div>
      <!-- /Categories table -->
    </div>
    <!--/ User Content -->
  </div>
</section>
@include('content.site.modal_add_site_block_ips')
@include('content.blockip.modal-block-ip')
@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{asset('js/scripts/components/components-navs.js')}}"></script>
  <script src="{{ asset(('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>
  <script src="https://cdn.datatables.net/plug-ins/1.10.21/dataRender/datetime.js"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script>
      $(function () {
          $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          var url = window.location.pathname;

          $('input[type=radio]').on('change', function() {
              var val = $(this).val();
              var name = $(this).attr('name');
              console.log(val, name)
              $.ajax({
                  type: "get",
                  url: url +'/update?'+name+'='+val,
                  {{--url: '{{asset('admin/site/view')}}/'+site_id +'/update?load_feature='+target.value,--}}
                  // url: '../'+ id + "/change-ads",
                  success: function (data) {
                      $(".site_load_wallpapers").load(" .site_load_wallpapers");
                      $(".site_load_home_features").load(" .site_load_home_features");
                      toastr['success']('', data.success, {
                          showMethod: 'fadeIn',
                          hideMethod: 'fadeOut',
                          timeOut: 2000,
                      });
                  },
                  error: function (data) {
                  }
              });
          });


          {{--document.body.addEventListener('change', function (e) {--}}
          {{--    let target = e.target;--}}
          {{--    let var2 = this.name;--}}

          {{--    $.ajax({--}}
          {{--        type: "get",--}}
          {{--        url: url +'/update?load_feature='+target.value,--}}
          {{--        --}}{{--url: '{{asset('admin/site/view')}}/'+site_id +'/update?load_feature='+target.value,--}}
          {{--        // url: '../'+ id + "/change-ads",--}}
          {{--        success: function (data) {--}}
          {{--            $(".site_load_feature").load(" .site_load_feature");--}}
          {{--            toastr['success']('', data.success, {--}}
          {{--                showMethod: 'fadeIn',--}}
          {{--                hideMethod: 'fadeOut',--}}
          {{--                timeOut: 2000,--}}
          {{--            });--}}
          {{--        },--}}
          {{--        error: function (data) {--}}
          {{--        }--}}
          {{--    });--}}
          {{--});--}}

      });
  </script>

@endsection
