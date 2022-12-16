$("#regDate").on('change', function () {
    var regDate = $("#regDate").val();
    $.ajax({
        type: 'get',
        url: '/dateSearch/',
        data: {
            'regDate': regDate,
        },
        success: function (list) {
            
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
        table.row.add([`${index + 1}`, `${stu.name}`, `${stu.rollno}`, `${stu.age}`, `${stu.register_date}`]).draw();

    });
}
$('#regDate').datepicker({
    beforeShow: function () {
        setTimeout(function () {
            $('.ui-datepicker').css('z-index', 99999999999999);
        }, 0);
    },
    dateFormat: 'yy-mm-dd'
});
$("#message").fadeOut(3000);
$('#studentTable').DataTable({
    searching: false,
    "ordering": false,
    "info": true,
    "lengthChange": false,
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