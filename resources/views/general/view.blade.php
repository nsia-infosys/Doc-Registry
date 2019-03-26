@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row cols-container">
        <div class="col-sm-6 books-column">
            <div class="card">
                <div class="card-header text-center">
                    Books
                </div>
                <ul class="list-group list-group-flush">
                <li onclick="loadPrevBooks()" class="list-group-item text-center"><span class="oi oi-arrow-circle-top"></span></li>
                    @foreach($books as $book)
                        @if($book->id == $id)
                            <li record-id="{{ $book->id }}" onclick="fetchPages({{ $book->id }})" class="list-group-item bg-info">{{ $book->id . ' - ' . $book->book_name . ' - ' . $book->volume_no}}</li>
                        @else
                            <li record-id="{{ $book->id }}" onclick="fetchPages({{ $book->id }})" class="list-group-item">{{ $book->id . ' - ' . $book->book_name . ' - ' . $book->volume_no}}</li>
                        @endif
                    @endforeach
                    <li onclick="loadNextBooks()" class="list-group-item text-center"><span class="oi oi-arrow-circle-bottom"></span></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-6 pages-column">
            <div class="card">
                <div class="card-header text-center">
                    Pages
                </div>

                <div class="text-center">
                    <div class="spinner-grow text-info m-5 hidden" style="width: 3rem; height: 3rem; display: none;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="pages-list"></div>
            </div>
        </div>
        <div class="col-sm-6 page-details-column d-none">
            <div class="card">
                <div class="card-header text-center">
                    Page Details
                </div>

                <div class="text-center">
                    <div class="spinner-grow text-info m-5 hidden" style="width: 3rem; height: 3rem; display: none;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="page-details"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function changeURL(url)
    {
        var new_url="/main/"+url;
        window.history.pushState("data","Title",new_url);
        document.title=url;
    }

    function adjustColumns() {
        var colsContainerEl = $(".cols-container");
        var totalCols = $(".cols-container>div:visible").length;

        if(totalCols == 2) {
            $(".books-column").removeClass("col-sm-6").addClass("col-sm-6");
            $(".pages-column").removeClass("col-sm-6").addClass("col-sm-6");
            // $(".page-details-column").removeClss("col-sm-6").addClass("col-sm-6");
        } else if(totalCols == 3) {
            $(".books-column").removeClass("col-sm-6").addClass("col-sm-2");
            $(".pages-column").removeClass("col-sm-6").addClass("col-sm-2");
            $(".page-details-column").removeClass("col-sm-6").addClass("col-sm-8");
        }
    }

    function fetchPage(pageId) {
        console.log("Page ID: " + pageId);

        $(".page-details", ".page-details-column").empty();
        $(".spinner-grow", ".page-details-column").show();

        $(".page-details-column").removeClass("d-none");
        adjustColumns()

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url : "{!! url('/pages'); !!}/" + pageId,
            type: "GET"
        }).done(function (data) {
            $(".spinner-grow", ".page-details-column").hide();

            var pageDetailsDiv = $(".page-details", ".page-details-column");

            
        }).fail(function () {
            $(".spinner-grow", ".page-details-column").hide();
            alert('Data could not be loaded.');
        });
    }

    function fetchPages(bookId) {
        console.log("Book ID: " + bookId);

        $(".pages-list", ".pages-column").empty();
        $(".spinner-grow", ".pages-column").show();

        //hide page detials div
        $(".page-details-column").addClass("d-none");
        adjustColumns();

        //remove the highlight from all and add to clicked item
        $(".list-group-item", ".books-column").removeClass("bg-info");
        $(".list-group-item[record-id='" + bookId + "']", ".books-column").addClass("bg-info");

        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url : "{!! url('/books'); !!}/" + bookId + "/pages",
            type: "GET"
        }).done(function (data) {
            changeURL(bookId);
            $(".spinner-grow", ".pages-column").hide();

            var pagesListDiv = $(".pages-list", ".pages-column");

            var startPageNo = data.book.start_page_no;
            var endPageNo = data.book.end_page_no;

            for (let i = startPageNo; i <= endPageNo; i++) {
                var inlineDiv = $("<div>").addClass("form-check form-check-inline");
                var radioEl = $("<input type='radio' name='page' onclick='fetchPage(" + i +")'>").addClass("form-check-input");
                var labelEl = $("<label>").text(i).addClass("form-check-label");

                $(radioEl).appendTo(inlineDiv)
                $(labelEl).appendTo(inlineDiv)
                $(inlineDiv).appendTo(pagesListDiv)
            }

            // $('#list-table').html(data);
            // location.hash = page;
        }).fail(function () {
            $(".pages-spinner").hide();
            alert('Data could not be loaded.');
        });
    }

    $(document).ready(function () {
        $(".bg-info", ".books-column").trigger("click");
    });

</script>
@endsection