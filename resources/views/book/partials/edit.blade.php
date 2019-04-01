<div class="modal fade" id="edit-book-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Edit Book</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <div id='error_update_div' class='alert alert-danger d-none'></div>
            <form id='edit-book-form'>
                {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $id }}" />
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="control-label" for="title">Book Name</label>
                        <input type="text" name="book_name" value="{{ $book->book_name }}" class="form-control" data-error="Please enter book name." required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="control-label" for="title">Book Keywords</label>
                        <input type="text" name="keywords" value="{{ $book->keywords }}" class="form-control" data-error="Please enter book keywords." />
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="control-label" for="title">Book Type</label>
                        <select class="form-control" name="book_type_id" data-error="Please enter description." required>
                            <option label="Select Option"></option>
                            @foreach($book_types as $book_type)
                                @if ($book_type->id == $book->book_type_id)
                                    <option value="{{ $book_type->id }}" selected>{{ $book_type->name }}</option>
                                @else
                                    <option value="{{ $book_type->id }}">{{ $book_type->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label" for="title">Province</label>
                        <select class="form-control" name="province_id" data-error="Please select province." required>
                            <option label="Select Option"></option>
                            @foreach($provinces as $province)
                                @if ($province->id == $book->province_id)
                                    <option value="{{ $province->id }}" selected>{{ $province->name }}</option>
                                @else
                                    <option value="{{ $province->id }}">{{ $province->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label" for="title">District</label>
                        <select class="form-control" name="district_id" data-error="Please select district." >
                            <option label="Select Option"></option>
                            @foreach($districts as $district)
                                @if ($district->id == $book->district_id)
                                    <option value="{{ $district->id }}" selected>{{ $district->name }}</option>
                                @else
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label" for="title">Volume No</label>
                        <input type="text" name="volume_no" value="{{ $book->volume_no }}" class="form-control" data-error="Please enter Volume No." required />
                        <div class="help-block with-errors"></div>
                    </div>    
                </div>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label class="control-label" for="title">Start Page No</label>
                        <input type="text" name="start_page_no" value="{{ $book->start_page_no }}" onChange="calculateTotalPages(this)" class="form-control" data-error="Please enter Start Page No." required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label" for="title">End Page No</label>
                        <input type="text" name="end_page_no" value="{{ $book->end_page_no }}" onChange="calculateTotalPages(this)" class="form-control" data-error="Please enter End Page No." required />
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group col-md-3">
                        <label class="control-label" for="title">Total Pages</label>
                        <input type="text" name="total_pages" value="{{ $book->total_pages }}" class="form-control" disabled/>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label" for="title">Book Year</label>
                        <input type="text" name="book_year" value="{{ $book->book_year }}" class="form-control" data-error="Please enter value" required />
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label" for="title">Book Details</label>
                    <div class="form-control">
                    @foreach($book_details as $book_detail)
                        <div class="form-check form-check-inline">
                            {{ $book->book_detail_id }}
                            @if ($book_detail['key'] == $book->book_detail_id)
                                <input class="form-check-input" checked name="book_details" type="checkbox" value="{{ $book_detail['key'] }}">
                            @else
                                <input class="form-check-input" name="book_details" type="checkbox" value="{{ $book_detail['key'] }}">
                            @endif
                            
                            <label class="form-check-label">{{ $book_detail['value'] }}</label>
                        </div>
                    @endforeach
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="message-text" class="control-label">Remarks</label>
                    <textarea class="form-control" name="remarks">{{ $book->remarks }}</textarea>
                </div>
                

                <div class="form-group">
                    <button type="submit" class="btn btn-success" onclick="update_data({{ $book->id }});"> Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>

</div>

