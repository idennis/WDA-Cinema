<link href="{{ asset('css/site.css') }}" media="all" rel="stylesheet" type="text/css" />

@extends('layouts.app')
@section('pageTitle', 'My Profile')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="pageTitle-container" id="">
                    <h1 class="movieList-pageTitle">My Account</h1>
                    <hr class="separator-movieList-nowPlaying">
                </div>

                <h2>My Bookings</h2>

                <div class="wishlist-tableContainer">
                    @if ($bookings->isEmpty())
                        <p>You currently have no bookings!</p>
                    @else
                        <div class="wishlist-tableContent">
                            <div class="wishlist-tableColumnHeadings">
                                <div class="cart-tableColumnHeadings-movie">
                                    Movie
                                </div>
                                <div class="cart-tableColumnHeadings-notes">
                                    Booking Information
                                </div>
                                <div class="cart-tableColumnHeadings-options">
                                    Actions
                                </div>
                            </div>
                        </div>
                        @foreach($bookings as $i=>$booking)
                            <div class="wishlist-item-container">
                                <div class="wishlist-item-movieContainer">
                                    <div class='movieList-moviePosterContainer wishlist-item-moviePosterContainer'><img class='movieList-moviePoster' src='{{$booking->session->movie->image_url}}'><img class='movieList-moviePoster posterGlow' src='{{$booking->session->movie->image_url}}'></div>
                                    <h5 class="movieList-movieTitle wishlist-item">
                                        {{$booking->session->movie->title}}
                                    </h5>
                                </div>
                                <div class="wishlist-notes">
                                    <div class="wishlist-notes-content">
                                        <p><i class="fa fa-map-marker" aria-hidden="true"></i> {{$booking->session->location->name}}</p>
                                        <p><i class="fa fa-clock-o" aria-hidden="true"></i> {{$booking->session->time}}</p>
                                        <p><i class="fa fa-ticket" aria-hidden="true"></i> Adults x {{$booking->adult_qty}}<br>
                                        <i class="fa fa-ticket" aria-hidden="true"></i> Children x {{$booking->child_qty}}<br>
                                        <i class="fa fa-ticket" aria-hidden="true"></i> Concession x {{$booking->concession_qty}}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                     @endif
                </div>

                <br><br><br><br>

                <h2>My Wishlist</h2>
                <div class="wishlist-tableContainer">
                    @if ($wishes->isEmpty())
                        <p>You currently have no movies on your wish list.</p>
                    @else
                        <div class="wishlist-tableContent">
                            <div class="wishlist-tableColumnHeadings">
                                <div class="wishlist-tableColumnHeadings-movie">
                                    Movie
                                </div>
                                <div class="wishlist-tableColumnHeadings-notes">
                                    Notes
                                </div>
                                <div class="wishlist-tableColumnHeadings-options">
                                    Options
                                </div>
                            </div>
                            @foreach($wishes as $i=>$wish)
                                <div class="wishlist-item-container">
                                    <div class="wishlist-item-movieContainer">
                                        <div class='movieList-moviePosterContainer wishlist-item-moviePosterContainer'><img class='movieList-moviePoster' src='{{$wish->movie->image_url}}'><img class='movieList-moviePoster posterGlow' src='{{$wish->movie->image_url}}'></div>
                                        <h5 class="movieList-movieTitle wishlist-item">
                                            {{$wish->movie->title}}
                                        </h5>
                                    </div>
                                    <div class="wishlist-notes">
                                        <div class="wishlist-notes-content">
                                            @if(isset($wish->notes) && strcmp($wish->notes, "") !== 0) {{$wish->notes}}
                                            @else
                                                <div class="notesPlaceholder"> Add your notes here. </div>
                                            @endif
                                        </div>

                                    </div>
                                    <div class="wishlist-item-options">
                                        <button id="wishlist-edit--button-{{$i}}" type='submit' class='btn btn-link wishlist-item-optionsEdit' onclick="toggleNotesEdit(event, '{{$i}}')">
                                            Edit
                                        </button>
                                        <form method="POST" action="{{ url('user/wish/' . $wish->id) }}" class="wishlist-item-optionsDeleteForm">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type='submit' class='btn btn-link'>
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    <form id="wishlist-edit-{{$i}}" class="wishlist-item--edit" method="POST" action="{{ url('user/wish/' . $wish->id) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="PUT">

                                        <input type="text" name="notes">
                                        <button type="submit" class='btn btn-link'>Update</button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                <br>
            </div>
        </div>

    </div>
    </div>

    <script>
        function toggleNotesEdit(e, elementIndex) {
            e.preventDefault();
            var editElement = $("#wishlist-edit-" + elementIndex);
            if( editElement.css("display") === "flex") {
                editElement.css("display", "none");
                $("#wishlist-edit--button-" + elementIndex).text("Edit");
            }
            else if( editElement.css("display") === "none" ) {
                editElement.css("display", "flex");
                $("#wishlist-edit--button-" + elementIndex).text("Hide");
            }
            console.log(  );
        }
    </script>
@endsection