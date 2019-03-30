<div id="view-modal" class="modal fade price-quote" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">View Book</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
              <!-- content goes here -->
                <div class="row">
                        <div class="col-md-6 col-sm-6">

                                <table class="table">
                                    <tr><th >ID:</th><td>{{ $book->id }}</td></tr>
                                    <tr><th >Book Name:</th><td>{{ $book->book_name }}</td></tr>
                                    <tr><th >Book Type ID:</th><td>{{ $book->book_type_id }}</td></tr>
                                    <tr><th >Province ID:</th><td>{{ $book->province_id }}</td></tr>
                                    <tr><th >District ID:</th><td>{{ $book->district_id }}</td></tr>
                                    <tr><th >Created At:</th><td>{{ $book->created_at }}</td></tr>
                                </table>
                        </div>
                        <div class="col-md-6 col-sm-6">
                                <table class="table">
                                    <tr><th> Volume No:</th><td>{{ $book->volume_no }}</td></tr>
                                    <tr><th >Start Page </th><td>{{ $book->start_page_no }}</td></tr>
                                    <tr><th >End Page </th><td>{{ $book->end_page_no }}</td></tr>
                                    <tr><th >Total Pages </th><td>{{ $book->total_pages }}</td></tr>
                                    <tr><th >Book Year </th><td>{{ $book->book_year }}</td></tr></tr>
                                    <tr><th >Updated At </th><td>{{ $book->updated_at }}</td></tr></tr>
                                </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <table class="table">
                                    <tr><th style="width:100px">keywords: </th><td>{{ $book->keywords }}</td></tr>
                            </table>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <table class="table">
                                    <tr><th style="width:100px">Remarks: </th><td>{{ $book->remarks }}</td></tr>
                            </table>
                        </div>
                        
                    </div>
                </div>

                    <div class="clearfix"></div>
                    <div class="col-md-12 margin-bottom-20 margin-top-20" style="margin-bottom:20px;margin-top:20px">
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