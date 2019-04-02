@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row cols-container">
        <div id='books' class="col-sm-6 books-column">
            <div class="card">
                <div class="card-header text-center">
                    Books
                </div>
                <div id='ulList'>
                    <ul id='prevBooksUl' class="list-group list-group-flush" style="height: 75vh; overflow: scroll;">
                        <li id='prevBooks' onclick="loadPrevBooks(this.id)" class="list-group-item text-center"><span class="oi oi-arrow-circle-top"></span></li>
                        @foreach($books as $book)
                            @if($book->id == $id)
                                <li record-id="{{ $book->id }}" onclick="fetchPages({{ $book->id }})" class="list-group-item bg-info">{{ $book->id . ' - ' . $book->book_name . ' - ' . $book->volume_no}}</li>
                            @else
                                <li record-id="{{ $book->id }}" onclick="fetchPages({{ $book->id }})" class="list-group-item">{{ $book->id . ' - ' . $book->book_name . ' - ' . $book->volume_no}}</li>
                            @endif
                        @endforeach
                        <li id='nextBooks' onclick="loadNextBooks(this.id)" class="list-group-item text-center"><span class="oi oi-arrow-circle-bottom"></span></li>
                    </ul>
                </div>
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

                <div class="pages-list" style="padding-left: 20px; height: 75vh; overflow: scroll;"></div>
            </div>
        </div>
        <div class="col-sm-6 page-details-column d-none">
            <div class="card">
                <div class="card-header text-center">
                    Page Details
                    <button onclick="toggleWidth()" class="btn btn-light btn-sm" style="float: right; padding: 0px;"><span class="oi oi-resize-width" ></span></button>
                </div>

                <div class="text-center">
                    <div class="spinner-grow text-info m-5 hidden" style="width: 3rem; height: 3rem; display: none;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>

                <div class="page-details" style="min-height: 75vh; overflow: scroll;"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function loadPrevBooks(id){
        console.log("loadPrevBooks: "+id);
        var bookId = $("#"+ id).next('li').attr('record-id');
        console.log("gotId: "+bookId);
        
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url : "{!! url('/get_prev_books'); !!}" + "/"+bookId,
            type: "GET",
            method: "GET"
        }).done(function (data) {
            console.log(data);
            var j = 0;
            if(bookId>0){
                {{-- $("#"+id).siblings().not('#nextBooks').remove(); --}}
                    for(j;j<data.data.length;j++){
                        console.log(data.data[j].id +" " +data.data[j].book_name+" "+data.data[j].volume_no);
                            console.log(data.data[j].id);
                            if(data.data[j].id != bookId){
                                
                            $("#"+id).before("<li record-id='"+data.data[j].id+"' onclick='fetchPages("+data.data[j].id+")' class='list-group-item'>"
                                + data.data[j].id + " - " + data.data[j].book_name + " - " + data.data[j].volume_no + "</li>");
                            }
                    }
                    $("#"+id).remove();
                    
                    $("<li id='prevBooks' onclick='loadPrevBooks(this.id)' class='list-group-item text-center'><span class='oi oi-arrow-circle-top'></span></li>").insertBefore($("#prevBooksUl li:nth-child(1)"));
            }
        }).fail(function () {
            alert('not done');
        });
        }
    function loadNextBooks(id){
        console.log("loadNextBooks: "+id);
        var bookId = $("#"+ id).prev('li').attr('record-id');
        console.log("loadNextBooks: "+bookId);
        $.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            url : "{!! url('/get_next_books'); !!}" + "/"+bookId,
            type: "GET",
            method: "GET"
        }).done(function (data) {
            console.log(data +" done"); var j = 0;
            if(bookId>0){
                    for(j;j<data.data.length;j++){
                        console.log(data.data[j].id +" " +data.data[j].book_name+" "+data.data[j].volume_no);
                            console.log(data.data[j].id);
                            if(data.data[j].id != bookId){
                                $("#"+id).before("<li record-id='"+data.data[j].id+"' onclick='fetchPages("+data.data[j].id+")' class='list-group-item'>"
                                    + data.data[j].id + " - " + data.data[j].book_name + " - " + data.data[j].volume_no + "</li>");
                            }
                    }
                    $("#"+id).remove();
                    $("<li id='nextBooks' onclick='loadNextBooks(this.id)' class='list-group-item text-center'><span class='oi oi-arrow-circle-bottom'></span></li>")
                    .insertAfter($("#prevBooksUl li:last-child"));
            }
        }).fail(function () {
            alert('not done');
        });
        }
    
    function changeURL(url){
        var new_url="/main/"+url;
        window.history.pushState("data","Title",new_url);
        document.title=url;
        }
    function toggleWidth() {
        var detailsPage = $(".page-details-column");
        if($(detailsPage).hasClass("col-sm-12")) {
            $(".books-column").removeClass("col-sm-6 col-sm-2 d-none").addClass("col-sm-2");
            $(".pages-column").removeClass("col-sm-6 col-sm-2 d-none").addClass("col-sm-2");
            $(".page-details-column").removeClass("col-sm-8 col-sm-6 col-sm-12").addClass("col-sm-8");
        } else {
            $(".books-column").removeClass("col-sm-6 col-sm-2").addClass("d-none");
            $(".pages-column").removeClass("col-sm-6 col-sm-2").addClass("d-none");
            $(".page-details-column").removeClass("col-sm-8 col-sm-6").addClass("col-sm-12");
        }
   }

    function adjustColumns() {
        var colsContainerEl = $(".cols-container");
        var totalCols = $(".cols-container>div:visible").length;
        if(totalCols == 2) {
            $(".books-column").removeClass("col-sm-6 col-sm-0").addClass("col-sm-6");
            $(".pages-column").removeClass("col-sm-6 col-sm-0").addClass("col-sm-6");
            // $(".page-details-column").removeClss("col-sm-6").addClass("col-sm-6");
        } else if(totalCols == 3) {
            $(".books-column").removeClass("col-sm-6 col-sm-0").addClass("col-sm-2");
            $(".pages-column").removeClass("col-sm-6 col-sm-0").addClass("col-sm-2");
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
            url : "{!! url('/main'); !!}/page/" + pageId,
            type: "GET"
        }).done(function (data) {
            $(".spinner-grow", ".page-details-column").hide();

            var pageDetailsDiv = $(".page-details", ".page-details-column").html(data);

            
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
            url : "{!! url('/main'); !!}/" + bookId + "/pages",
            type: "GET"
        }).done(function (data) {
            changeURL(bookId);
            $(".spinner-grow", ".pages-column").hide();

            var pagesListDiv = $(".pages-list", ".pages-column");

            var startPageNo = data.book.start_page_no;
            var endPageNo = data.book.end_page_no;

            for (let i = startPageNo; i <= endPageNo; i++) {
                var inlineDiv = $("<div style='padding: 8px'>").addClass("form-check form-check-inline");
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