<div class="modal fade" id="edit-book" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Edit Book</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        </div>
        <div class="modal-body">
            <form data-toggle="validator" action="/item-ajax/14" method="put">
                <div class="form-group">
                    <label class="control-label" for="title">Title:</label>
                    <input type="text" name="title" class="form-control" data-error="Please enter title." required />
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <label class="control-label" for="title">Description:</label>
                    <textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
                </div>
            </form>


        </div>
    </div>
    </div>
</div>