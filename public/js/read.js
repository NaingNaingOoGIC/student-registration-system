$("#regDate").on('change', function() {
    var regDate = $("#regDate").val();
    $.ajax({
        type: 'get',
        url: '/dateSearch/',
        data: {
            'regDate': regDate,
        },
        success: function(list) {

            if (list !== null) {
                createList(list.data);
            }
        }
    });
})

function createList(data) {
    var table = $('#studentTable').DataTable();
    table.clear().draw();
    data.forEach((stu, index) => {
        table.row.add([`${index + 1}`, `${stu.name}`, `${stu.rollno}`, `${stu.age}`,
            `${stu.register_date}`]).draw();

    });
}
$('#regDate').datepicker({
    beforeShow: function() {
        setTimeout(function() {
            $('.ui-datepicker').css('z-index', 99999999999999);
        }, 0);
    },
    dateFormat: 'yy-mm-dd'
});
$("#message").fadeOut(3000);
$('#studentList').DataTable({
    "serverSide": true,
    "processing": true,
    "ajax": {
        "url": "{{ url('allLists') }}",
        "dataType": "json",
        "type": "POST",
        "data": {
            _token: "{{ csrf_token() }}"
        }
    },
    "columns": [{
            "data": "no"
        },
        {
            "data": "rollno"
        },
        {
            "data": "name"
        },
        {
            "data": "age"
        },
        {
            "data": "register_date"
        },
        {
            "render": function() {
                return '<button class="btn btn-sm btn-outline-danger" type="button"' +
                    ' id="delBtn">  ' +
                    ' 削除 </button>';
            }
        },
    ],
    // "ordering": false,
    // "info": true,
    // "lengthChange": false,
    language: {
        "info": "_START_ から _END_ まで _TOTAL_ 人の生徒を表示する",
        "infoEmpty": "",
        "emptyTable": "対象データが見つかりませんでした。",
        "paginate": {
            "first": "初め",
            "last": "終わり",
            "next": "次へ",
            "previous": "前へ"
        },
    }
});