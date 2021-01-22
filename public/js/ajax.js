$('#searchBySubject').on('change', function() {

    let subjectId = $(this).val();
    $('#searchResult').html('');

    $.ajax({

        type:'GET',
        url: 'reserve/' + subjectId,
        dataType: 'json',

    }).success(function(data) {
        
        let html = '';

        if(data.length > 0) {
            $.each(data, function(index, value) {

                html = '<a href="http://localhost/teachme/public/student/reserve/paycheck/' + value.meta.id +'" class="horizontal-item">' +
                            '<div class="item-contents">' +
                                '<p class="item-text text-white"><i class="fas fa-flag-usa mr-1 fa-fw"></i>' + value.subject_name + '</p>' +
                                '<p class="item-text text-white"><i class="far fa-calendar-alt mr-1 fa-fw"></i>' + value.meta.date.substr(5) + '</p>' +
                                '<p class="item-text text-white"><i class="far fa-clock mr-1 fa-fw"></i>' + value.meta.start_time.substr(0, 5) + ':' + value.meta.end_time.substr(0, 5) + '</p>' +
                                '<p class="item-text text-white"><i class="fas fa-chalkboard-teacher mr-1 fa-fw"></i>' + value.teacher_name + '</p>' +
                            '</div>' +
                        '</a>';

                $('#searchResult').append(html);
                        
                        
            });
        } else {

            html = '<p class="text-center">現在この科目の授業はありません</p>';
            $('#searchResult').append(html);

        }
                
    }).fail(function() {
                
    
                
    });

});