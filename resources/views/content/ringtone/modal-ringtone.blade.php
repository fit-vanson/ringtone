<!-- Add Modal -->
<div class="modal fade" id="RingtoneModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body px-sm-5 pb-5">
        <div class="text-center mb-2">
          <h1 class="mb-1 exampleModalLabel">Add New</h1>
        </div>
          <form method="post" action="{{route('ringtones.create')}}" enctype="multipart/form-data"
                class="dropzone" id="RingtoneForm">
              @csrf
              <div class="col-md-12">
                  <label class="form-label">Category</label>
                  <select class="form-select" id="select_category" name="select_category[]" required >
                      @foreach($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                      @endforeach
                  </select>
              </div>
          </form>
      </div>
    </div>
  </div>
</div>
<!--/ Add  Modal -->

<!-- Edit Modal -->
<div class="modal fade" id="EditRingtoneModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-sm-5 pb-5">
                <div class="text-center mb-2">
                    <h1 class="mb-1 exampleModalLabel">Edit Ringtone</h1>
                </div>
                <form class="row" id="editRingtoneForm" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id_edit" value="">
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="ringtone_name"  name="ringtone_name" />
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="basicInput">View Count</label>
                            <input type="text" class="form-control" id="ringtone_viewCount"  name="ringtone_viewCount" />
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="mb-1">
                            <label class="form-label" for="basicInput">Like Count</label>
                            <input type="text" class="form-control" id="ringtone_likeCount"  name="ringtone_likeCount" />
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Category</label>
                        <select class="form-select" id="select_category_edit" name="select_category[]" required >
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <div class="d-flex align-items-center mt-1">
                            <div class="form-check form-switch form-check-primary">
                                <input type="checkbox" class="form-check-input" id="feature" name="feature" />
                                <label class="form-check-label" for="feature">
                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                </label>
                            </div>
                            <label class="form-check-label fw-bolder" for="feature">Feature</label>
                        </div>

                        <div class="d-flex align-items-center mt-1">
                            <div class="form-check form-switch form-check-primary">
                                <input type="checkbox" class="form-check-input" id="set_as_premium" name="set_as_premium"  />
                                <label class="form-check-label" for="set_as_premium">
                                    <span class="switch-icon-left"><i data-feather="check"></i></span>
                                    <span class="switch-icon-right"><i data-feather="x"></i></span>
                                </label>
                            </div>
                            <label class="form-check-label fw-bolder" for="set_as_premium">Premium</label>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-success" id="submitButton" value="update">Update</button>
                        <button type="reset" class="btn btn-outline-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Edit  Modal -->


