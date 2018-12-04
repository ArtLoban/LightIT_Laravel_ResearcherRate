/*  AJAX Store Journal request  */
$(function() {
    $('#ajax-submit-journal').on('click',function() {
        var $url = $('.ajax-create-form').attr('action');
        var $journalName = $('#modalJournalName').val();
        var $issnNumber = $('#issnNumber').val();
        var $countryName = $('#countryName').val();
        var $categoryName = $('#categoryName').val();
        var $typeName = $('#typeName').val();

        $.ajax({
            url: $url,
            type: 'POST',
            data: {
                name: $journalName,
                issn: $issnNumber,
                country: $countryName,
                category: $categoryName,
                journal_type_id: $typeName
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

            success: function($data) {
                console.log($data);
                $('#ajax-journalModal').modal('hide');
                $("#msg").html($data.msg).removeClass('d-none').delay(1500).slideUp('slow');
                // $("#msg").html('').delay(2000).addClass('d-none');
            },

            error: function (msg) {
                console.log("error");
            }
        })
    })
});

/* jQuery UI Autocomplete */
$("#articleAuthors").autocomplete({
    delay: 300,
    source: function($query, $result){
        if ($query['term'] !== " ") {
            $.ajax({
                url: $('#ajax-authors-autocomplete').val(),
                type: 'GET',
                data: { name : $query['term'] },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                success: function ($data) {
                    $result($.map($data, function (item) {
                        return item;
                    }));
                },

                error: function (msg) {
                    console.log("error");
                }
            });
        }
    }
});

// $( "#articleAuthors" ).autocomplete({
//     source: ["c++", "java", "php", "coldfusion", "javascript", "asp", "ruby"],
//     delay: 300
// });

$("#journalName").autocomplete({
    delay: 300,
    source: function($query, $result){
        if ($query['term'] !== " ") {
            $.ajax({
                url: $('#ajax-journal-autocomplete').val(),
                type: 'GET',
                data: { name : $query['term'] },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},

                success: function ($data) {
                    $result($.map($data, function (item) {
                        return item;
                    }));
                },

                error: function (msg){
                    console.log("error");
                }
            });
        }
    }
});
