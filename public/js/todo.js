$(document).ready(function () {
    'use strict'

    $("#container-id, .notFound, .emptyList, .toast, .add-validation, .edit-validation").hide();

    if($("tbody").children().length < 3) $(".emptyList").show();

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
        }, false)
    })

    setTimeout(() => {
        $(".message").fadeOut();
    }, 1000);

    $(".btn-closeAdd").click(function() {
        $("#formAdd").removeClass('was-validated');
        $("#formAdd")[0].reset();
    });

    $(".btn-closeEdit").click(function() {
        $("#formEdit").removeClass('was-validated');
        $("#formEdit")[0].reset();
    });

    $(".btn-edit").click(function () {
        let tr = $(this).parents("tr");
        let id = tr.attr("data");
        let title = tr.attr("title");

        $("#id").val(id);
        $("#edit_title").val(title);
        $("#formEdit").attr("action", `todo/${id}/update`)
    });

    $("#search").keyup(function() {
        searchItem($(this).val());
    });

    function searchItem(value) {
        let isEmpty = true;

        $("tbody tr").each(function() {
            let isFound = false;
            
            $(this).each(function() {
                if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0) isFound = true;
            });
            
            if(isFound) {
                $(this).show();
                isEmpty = false;
            } else {
                $(this).hide();
            }
        });

        if(isEmpty) $(".notFound").show()
        else $(".notFound").hide();

        if($("tbody").children().length > 2) $(".emptyList").hide();
    }
});