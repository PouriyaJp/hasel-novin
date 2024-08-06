
@extends('layouts.app')

@section('content')
    <h2>Live Search Countries</h2>
    <input type="text" id="search" class="form-control" placeholder="Search for a country...">

    <div class="mt-3" id="country-list">

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                let query = $(this).val();

                $.ajax({
                    url: "{{ route('countries.search') }}",
                    type: "GET",
                    data: {'query': query},
                    success: function (data) {
                        $('#country-list').empty();
                        if (data.length > 0) {
                            $.each(data, function (key, country) {
                                $('#country-list').append(
                                    '<div class="card mb-2">' +
                                    '<div class="card-body">' +
                                    '<h5 class="card-title">' + country.name_en + ' (' + country.name_fa + ')</h5>' +
                                    '<img src="' + country.flag + '" alt="Flag" style="width: 50px; height: auto;">' +
                                    '<p class="card-text">Latitude: ' + country.lat + ', Longitude: ' + country.long + '</p>' +
                                    '</div>' +
                                    '</div>'
                                );
                            });
                        } else {
                            $('#country-list').append('<p>No results found</p>');
                        }
                    }
                });
            });
        });
    </script>
@endsection
