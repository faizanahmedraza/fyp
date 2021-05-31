@extends('frontend.layouts.master')

@section('content')
    <main>
        <div class="container-fluid site-width">
            <!-- START: Breadcrumbs-->
            <div class="row">
                <div class="col-12  align-self-center">
                    <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    </div>
                </div>
            </div>
            <!-- END: Breadcrumbs-->

            <!-- START: Card Data-->
            <div class="row">
                <div class="col-12 mt-3">
                    <div class="card">
                        <div class="card-header  justify-content-between align-items-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title">Claim For Scoloarship</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ Session::get('success') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-12">
                                        <form action="/student/claim-for-scoloarship" method="POST">
                                            @csrf
                                            @if($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="year">Student Id <span class="required-class">*</span></label>
                                                    <input type="text" class="form-control rounded" id="student_id"
                                                           name="student_id" placeholder="Enter Student Id"
                                                           value="{{ old('student_id') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="fullname">Full Name <span
                                                                class="required-class">*</span></label>
                                                    <input type="text" class="form-control rounded" id="fullname"
                                                           name="fullname" placeholder="Enter Full Name"
                                                           value="{{ old('fullname') }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="matric_board">Matric Board <span
                                                                class="required-class">*</span></label>
                                                    <input type="matric_board" class="form-control rounded"
                                                           id="matric_board"
                                                           name="matric_board" placeholder="Enter Matric Board"
                                                           value="{{ old('matric_board') }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="marks_in_matric">Marks in Matric </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="marks_in_matric" name="marks_in_matric"
                                                           placeholder="Enter Marks in Matric"
                                                           value="{{ old('marks_in_matric') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="current_city">Current City Name </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="current_city" name="current_city"
                                                           placeholder="Enter Current City Name"
                                                           value="{{ old('current_city') }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="beneficary_name">Your Beneficiary Name </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="beneficary_name" name="beneficary_name"
                                                           placeholder="Enter Your Beneficiary Name"
                                                           value="{{ old('beneficary_name') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="beneficary_iban_number">Your Beneficiary's 24 Digits
                                                        IBAN number </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="beneficary_iban_number" name="beneficary_iban_number"
                                                           placeholder="Enter Your Beneficiary's 24 Digits IBAN number"
                                                           value="{{ old('beneficary_iban_number') }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="beneficary_bank">Your Beneficiary Bank Name </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="beneficary_bank" name="beneficary_bank"
                                                           placeholder="Enter Your Beneficiary Bank Name"
                                                           value="{{ old('beneficary_bank') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="beneficary_cnic">Your Beneficiary's CNIC Number </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="beneficary_cnic" name="beneficary_cnic"
                                                           placeholder="Enter Your Beneficiary's CNIC Number"
                                                           value="{{ old('beneficary_cnic') }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="cnic_number">Your CNIC Number / Form 'B' </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="cnic_number" name="cnic_number"
                                                           placeholder="Enter Your CNIC Number / Form 'B'"
                                                           value="{{ old('cnic_number') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="mobile_number">Your Mobile Number </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="mobile_number" name="mobile_number"
                                                           placeholder="Enter Your Mobile Number"
                                                           value="{{ old('mobile_number') }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="whatsapp_number">Your WhatsApp Number </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="whatsapp_number" name="whatsapp_number"
                                                           placeholder="Enter Your WhatsApp Number"
                                                           value="{{ old('whatsapp_number') }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email_address">Your Email Address </label>
                                                    <input type="text" class="form-control rounded allowNumberOnly"
                                                           id="email_address" name="email_address"
                                                           placeholder="Enter Your Email Address"
                                                           value="{{ old('email_address') }}">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="goals">Short & Long Term Goals </label>
                                                    <textarea name="goals" class="form-control"
                                                              placeholder="Enter Short & Long Term Goals"
                                                              rows="2">{{ old('goals') }}</textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="suggestion">Your Suggestions </label>
                                                    <textarea name="suggestion" class="form-control"
                                                              placeholder="Enter Your Suggestions"
                                                              rows="2">{{ old('suggestion') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="your_contribution">Your Role For Dalda
                                                        Foundation </label>
                                                    <textarea name="your_contribution" class="form-control"
                                                              placeholder="Enter Your Role For Dalda Foundation"
                                                              rows="2">{{ old('your_contribution') }}</textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="contact">Are you interested in achieving international
                                                        scholarships ? </label><br>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="checkbox" name="international_scolarship"
                                                               class="custom-control-input"
                                                               id="international_scolarship_yes" value="yes" {{ old("international_scolarship") == 'yes' ? 'checked' : '' }}>
                                                        <label class="custom-control-label checkbox-primary outline"
                                                               for="international_scolarship_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="checkbox" name="international_scolarship"
                                                               class="custom-control-input"
                                                               id="international_scolarship_no" value="no" {{ old("international_scolarship") == 'no' ? 'checked' : '' }}>
                                                        <label class="custom-control-label checkbox-primary outline"
                                                               for="international_scolarship_no">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="checkbox" name="international_scolarship"
                                                               class="custom-control-input"
                                                               id="international_scolarship_may" value="maybe" {{ old("international_scolarship") == 'maybe' ? 'checked' : '' }}>
                                                        <label class="custom-control-label checkbox-primary outline"
                                                               for="international_scolarship_may">May be</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="cnic">Are you ready to take standardized tests such as
                                                        GRE/GMAT/LSAT ? </label>
                                                    <br>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="checkbox" name="standarized_test"
                                                               class="custom-control-input" id="standarized_test_yes" value="yes" {{ old("standarized_test") == 'yes' ? 'checked' : '' }}>
                                                        <label class="custom-control-label checkbox-primary outline"
                                                               for="standarized_test_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="checkbox" name="standarized_test"
                                                               class="custom-control-input" id="standarized_test_no" value="no" {{ old("standarized_test") == 'no' ? 'checked' : '' }}>
                                                        <label class="custom-control-label checkbox-primary outline"
                                                               for="standarized_test_no">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="checkbox" name="standarized_test"
                                                               class="custom-control-input" id="standarized_test_may" value="maybe" {{ old("standarized_test") == 'maybe' ? 'checked' : '' }}>
                                                        <label class="custom-control-label checkbox-primary outline"
                                                               for="standarized_test_may">May be</label>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-6">
                                                    <label for="contact">Are you ready to take English ability test such
                                                        as IELTS/TOEFL/PTE/PVT/ITEP/DUOLINGO ? </label><br>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="checkbox" name="english_ability_test"
                                                               class="custom-control-input"
                                                               id="english_ability_test_yes" value="yes" {{ old("english_ability_test") == 'yes' ? 'checked' : '' }}>
                                                        <label class="custom-control-label checkbox-primary outline"
                                                               for="english_ability_test_yes">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="checkbox" name="english_ability_test"
                                                               class="custom-control-input"
                                                               id="english_ability_test_no" value="no" {{ old("english_ability_test") == 'no' ? 'checked' : '' }}>
                                                        <label class="custom-control-label checkbox-primary outline"
                                                               for="english_ability_test_no">No</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="checkbox" name="english_ability_test"
                                                               class="custom-control-input"
                                                               id="english_ability_test_may" value="maybe" {{ old("english_ability_test") == 'maybe' ? 'checked' : '' }}>
                                                        <label class="custom-control-label checkbox-primary outline"
                                                               for="english_ability_test_may">May be</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="share_any">Anything you want to share with Dalda
                                                        Foundation
                                                        ? </label>
                                                    <textarea name="share_any" class="form-control"
                                                              placeholder="Enter Your Suggestions"
                                                              rows="2">{{ old('share_any') }}</textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Student Photo <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                                        <input type="file" name="student_photo" class="form-control"
                                                               accept=".jpg, .jpeg, .png"
                                                               value="{{ old('student_photo') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Matric Mark Sheet Photo <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                                        <input type="file" name="marksheet_photo" class="form-control"
                                                               accept=".jpg, .jpeg, .png"
                                                               value="{{ old('marksheet_photo') }}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Beneficiary CNIC Photo <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                                        <input type="file" name="beneficary_cnic_photo"
                                                               class="form-control"
                                                               accept=".jpg, .jpeg, .png"
                                                               value="{{ old('beneficary_cnic_photo') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Father/Mother CNIC Photo <span class="required-class">*</span></label>
                                                    <div class="input-group">
                                                        <input type="file" name="parent_cnic_photo" class="form-control"
                                                               accept=".jpg, .jpeg, .png"
                                                               value="{{ old('parent_cnic_photo') }}">
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </form>
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
    <script>
        $(".allowNumberOnly").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    </script>
@endpush