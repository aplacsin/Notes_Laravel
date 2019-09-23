$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


/* Count Images */

$('#image-edit img').length

//if you want to count images by name
var images = [".png", ".jpg", ".gif"] //images types
var count = 0;


for (var a = 0; a < $('#image-edit img').length; a++) {
    for (var b = 0; b < images.length; b++) {

        if ($($('#image-edit img')[a]).attr('src').indexOf(images[b]) !== -1) //index Of returns the position of the string in the other string. If not found, it will return -1:
        {
            count++
        }
    }
}



$(document).ready(function () {
    let max_fields = 6,
        wrapper = $(".wrapper-edit-image-form"),
        add_button = $(".add-edit-field");


    /* Add field file 'images' */

    $(add_button).click(function (e) {
        e.preventDefault();
        count++
        if (count < max_fields) {
            $(wrapper).append('<div><input class="add-file" type="file" name="image[]"/><a href="#" class="delete btn btn-danger">Удалить</a></div>'); //add input box
        } else {
            alert('Максимальное кол-во картинок!')
            count = 5
        }
    });

    /* Delete field */

    $(wrapper).on("click", ".delete", function (e) {
        e.preventDefault();
        $(this).parent('div').remove();
        count--;
    })
});

/* Delete images */

$(".edit-delete").click(function () {
    let id = $(this).data("id"),
        token = $("meta[name='csrf-token']").attr("content");
    if (confirm('Вы точно хотите удалить изображение?')) {
        $.ajax({
            url: "/image/" + id + "/destroy",
            type: 'DELETE',
            data: {
                "id": id,
                "_token": token,
            },
            success: function () {
                location.reload();
            }
        });
    }
});
