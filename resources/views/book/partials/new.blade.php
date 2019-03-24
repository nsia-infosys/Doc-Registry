 <!-- Create Book Modal -->
 <div class="modal fade" id="create-book-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Create Book</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label class="control-label" for="title">Book Name</label>
                    <input type="text" name="book_name" class="form-control" data-error="Please enter book name." required />
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Book Type:</label>
                    <select class="form-control" name="book_type" data-error="Please enter description." required>
                        <option label="Select Option"></option>
                        @foreach($book_types as $book_type)
                            <option value="{{ $book_type->id }}">{{ $book_type->name }}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Province:</label>
                    <select class="form-control" name="province" data-error="Please select province." required>
                        <option label="Select Option"></option>
                        @foreach($provinces as $province)
                            <option value="{{ $province->id }}">{{ $province->name }}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">District:</label>
                    <select class="form-control" name="district" data-error="Please select district." >
                        <option label="Select Option"></option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}">{{ $district->name }}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Volume No</label>
                    <input type="text" name="volume_no" class="form-control" data-error="Please enter Volume No." required />
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="title">Start Page No</label>
                    <input type="text" name="volume_no" class="form-control" data-error="Please enter Volume No." required />
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">End Page No</label>
                    <input type="text" name="volume_no" class="form-control" data-error="Please enter Volume No." required />
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Total Pages</label>
                    <input type="text" name="volume_no" class="form-control" data-error="Please enter Volume No." />
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                    <label class="control-label" for="title">Entered Pages</label>
                    <input type="text" name="entered_pages" class="form-control" data-error="Please enter value" required />
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label for="message-text" class="control-label">Remarks</label>
                    <textarea class="form-control" name="remarks"></textarea>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Book Details</label>
                    <div class="form-control">
                    @foreach($book_details as $book_detail)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" value="{{ $book_detail['key'] }}">
                            <label class="form-check-label">{{ $book_detail['value'] }}</label>
                        </div>
                    @endforeach
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn crud-submit btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>