<div id="view-modal" class="modal fade price-quote" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">View Book</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <!-- content goes here -->
                <form>
                    <div class="form-group">
                        <label class="col-form-label">ID:</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ $book->id}}" readonly class="form-control-plaintext">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Book Name:</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ $book->book_name }}" readonly class="form-control-plaintext">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label class="col-form-label">Book Type:</label>
                            <div class="col-sm-12">
                                <input type="text" value="" readonly class="form-control-plaintext">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="col-form-label">Province:</label>
                            <div class="col-sm-12">
                                <input type="text" value="" readonly class="form-control-plaintext">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="col-form-label">Distict:</label>
                            <div class="col-sm-12">
                                <input type="text" value="" readonly class="form-control-plaintext">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="col-form-label">Volume No:</label>
                            <div class="col-sm-12">
                                <input type="text" value="{{ $book->volume_no }}" readonly class="form-control-plaintext">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label class="col-form-label">Start Page No:</label>
                            <div class="col-sm-12">
                                <input type="text" value="{{ $book->start_page_no }}" readonly class="form-control-plaintext">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="col-form-label">End Page No:</label>
                            <div class="col-sm-12">
                                <input type="text" value="{{ $book->end_page_no }}" readonly class="form-control-plaintext">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="col-form-label">Total Pages:</label>
                            <div class="col-sm-12">
                                <input type="text" value="{{ $book->total_pages }}" readonly class="form-control-plaintext">
                            </div>
                        </div>
                        <div class="form-group col-sm-3">
                            <label class="col-form-label">Entered Pages:</label>
                            <div class="col-sm-12">
                                <input type="text" value="{{ $book->entered_pages }}" readonly class="form-control-plaintext">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Remarks:</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ $book->remarks }}" readonly class="form-control-plaintext">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Book Details:</label>
                        <div class="col-sm-12">
                            <input type="text" value="" readonly class="form-control-plaintext">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Created At:</label>
                            <div class="col-sm-12">
                                <input type="text" value="{{ $book->created_at }}" readonly class="form-control-plaintext">
                            </div>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="col-form-label">Updated At:</label>
                            <div class="col-sm-12">
                                <input type="text" value="{{ $book->updated_at }}" readonly class="form-control-plaintext">
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-12 margin-bottom-20 margin-top-20">
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<style>
.form-group>label {
    font-size: bold;
}
</style>