console.log("hi");
$(".deleteBtn").on('click', function () {
    var id = $(this).val()
    console.log(id)
    console.log($("#delId").val())
    $("#delId").val(id);

})
$('#deleteStudentTable').DataTable({
    "ordering": false,
    "info": true,    
    "lengthChange": false,
    language: {
        "search":"検索:",
        "infoFiltered":"",
        "info": "_START_ から _END_ まで _TOTAL_ 人の生徒を表示する",
        "infoEmpty": "",
        "zeroRecords":"対象データが見つかりませんでした。",
        "emptyTable": "対象データが見つかりませんでした。",
        "paginate": {
            "first": "初め",
            "last": "終わり",
            "next": "次へ",
            "previous": "前へ"
        },
    }
});