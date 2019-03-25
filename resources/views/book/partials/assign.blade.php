 <!-- Create Book Modal -->
 <div class="modal fade" id="assign-book-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Assign Book</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-group">
                    <label class="control-label" for="title">Book Name</label>
                    <input type="text" id="book_name" class="form-control" data-error="Please enter book name."  disabled/>
                    <input type="hidden" id="id" name="id" class="form-control"/>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Assign To:</label>
                    <select class="form-control" name="assignee" data-error="Please select assignee." required>
                        <option label="Select Option"></option>
                        @foreach($assignees as $assignee)
                            <option value="{{ $assignee->id }}">{{ $assignee->name }}</option>
                        @endforeach
                    </select>
                    <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn crud-submit btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>