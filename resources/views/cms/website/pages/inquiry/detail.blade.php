@extends('cms.layouts.master')

@section('content')
    <main>
        <div class="container-fluid site-width">
            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Inquiry Detail</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{route('website.page.inquiries')}}" class="btn btn-primary float-right">←
                                        Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Your Name"
                                                   value="{{$inquiry->name}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email"
                                                   placeholder="Email Address" value="{{$inquiry->email}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="subject" placeholder="Subject"
                                                   value="{{$inquiry->subject}}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="phone"
                                                   placeholder="Phone Number" value="{{$inquiry->phone}}">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control"
                                                      placeholder="Write here message">{{$inquiry->message}}</textarea>
                                        </div>
                                        <button type="button" class="btn btn-secondary btn-sm"
                                                data-toggle="modal" data-target="#guestModal">
                                            Submit Answer
                                        </button>

                                        <div class="modal fade" id="guestModal" data-backdrop="static"
                                             data-keyboard="false" tabindex="-1"
                                             aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="guestModalTitle">{{$inquiry->subject}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form id="form" method="POST"
                                                          action="{{route('website.page.inquiries.submit-answer',['inquiryId'=>$inquiry->id])}}">
                                                    <div class="modal-body">
                                                        <div class="form-row">
                                                            <input type="hidden" name="inquiry_id" value="{{$inquiry->id}}">
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-12">
                                                                <label for="your_email">Message <span
                                                                            class="required-modal-class">*</span></label>
                                                                <textarea class="form-control" name="message"
                                                                          placeholder="Write here message" rows="6">{{old('message')}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close
                                                            </button>
                                                            <button type="submit" class="btn btn-primary">Submit
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END: Card DATA-->
        </div>
    </main>
@endsection

@push('scripts')
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/js/sweetalert.min.js"></script>
    <script>
        const form = document.querySelector('#form');

        if (form) {
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                const inquiryId = $("[name='inquiry_id']").val().trim();
                const message = $("[name='message']").val().trim();

                if (inquiryId === '' || message === '') {
                    $(".required-modal-class:first").addClass('text-danger');
                    return false;
                }
                axios.post(`/admin/website/pages/inquiries/submit-answer`, {
                    inquiryId,
                    message
                }).then(function (response) {
                    swal({
                        title: response.data.msg,
                        icon: "success",
                        closeOnClickOutside: false
                    }).then((successBtn) => {
                        if (successBtn) {
                            $("#inquiry_id,#message").val('');
                            $("#guestModal").removeClass("fade").modal("hide");
                            location.href="/admin/website/pages/inquiries";
                        }
                    });
                }).catch(error => {
                    console.clear();
                });
            });
        }

    </script>
@endpush