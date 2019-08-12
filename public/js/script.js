$(document).ready(function () {

    var inputSearch = $('#FormSearch input[name=search]');
    // console.log(inputSearch);

    inputSearch.autocomplete({
        minLength: 1,
        // source: '/search' + inputSearch.val(),
        source: function(request, response) {
            $.ajax({
                type: 'POST',
                url: '/search',
                dataType: 'json',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    term: inputSearch.val()
                },
                success: function (data) {
                    response($.map(data.items, function (item) {
                        return {
                            label: item.title_ru + '/' + item.title_en,
                            value: item.title_ru
                        }
                    }));
                }
            })
        }

    });
});