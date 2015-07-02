$(document).ready(function(){
    if($(document).find('#show_trainings'))
    {
        load_trainings();
    }
    if($(document).find('#show_all_practice'))
    {
        load_all_practice();
    }

});

function load_all_practice()
{
    $.ajax({
        type: 'POST',
        url: '/practice/generate_all_practice',
        success: function(html)
        {
            $('#show_all_practice').html(html);
            $('#btn_window_view_practice').on("click", function(){
               view_practice();
            });
            $('#btn_window_add_practice').on("click", function(){
               window_add_practice();
            });
            $('#btn_window_delete_practice').on("click", function(){
                window_delete_practice();
            })
            $('#btn_window_edit_practice').on("click", function(){
                window_edit_practice();
            })
        }
    });
}

function load_trainings()
{
    $.ajax({
        type: 'POST',
        url: '/training/generate_trainings/'+$('#user_id').val(),
        success: function(html)
        {
            $('#show_trainings').html(html);
            $("#btn_window_add_training").on("click", function(){
                window_add_training();
            });
            $("#btn_window_delete_training").on("click", function(){
               window_delete_traning();
            });
            $('#btn_window_edit_training').on("click", function(){
               window_edit_training();
            });
            $('#show_trainings').on("change", function(){
               load_days();
               $('#show_blocks').html('');
               build_training();
            });
        }
    });

}

function load_days()
{
    $.ajax({
        type: 'POST',
        url: '/training/generate_days/'+$('#training').val(),
        success: function(html)
        {
            $('#show_days').html(html);
            $("#days").on("change", function(){
               load_blocks();
            });
            $("#btn_add_day").on("click", function(){
               add_day();
               build_training();
            });
            $("#btn_delete_day").on("click", function(){
                delete_day();
                build_training();
            });
        }
    });
}

function load_blocks()
{
    $.ajax({
        type: 'POST',
        url: '/training/generate_blocks/'+$('#days').val(),
        success: function(html)
        {
            $('#show_blocks').html(html);
            $('#block').on("change", function(){
               load_block_practice();
            });
            $("#btn_window_add_block").on("click", function(){
                window_add_block();
            });
            $("#btn_window_delete_block").on("click", function(){
               window_delete_block();
            });
            $('#btn_window_edit_block').on("click", function(){
               window_edit_block();
            });
        }
    });
}

function load_block_practice()
{
    $.ajax({
        type: 'POST',
        url: '/training/generate_block_practice/'+$('#block').val(),
        success: function(html)
        {
            $('#show_block_practice').html(html);
            $('#btn_add_block_practice').on("click", function(){
               add_block_practice();
               build_training();

            });
            $('#btn_delete_block_practice').on("click", function(){
                delete_block_practice();
                build_training();
            });
        }
    })
}

function window_add_training()
{
    $.ajax({
        type: 'POST',
        url: '/training/add_training',
        success: function(html)
        {
            $('#window_add_training').html(html);
            $('#window_add_training').modal({
                keyboard: false
            });
            $("#btn_add_training").on("click", function(){
               add_training();
            });
            $('#window_add_training').keypress(function(e){
                if (e.keyCode == 13)
                    add_training();
            });
        }
    });

}

function add_training()
{
    var fd = new FormData();
    fd.append('user_id', $("#user_id").val());
    fd.append('name', $('#training_name').val());
    $.ajax({
        type: 'POST',
        url: '/training/add_training',
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                $('#window_add_training').modal('hide');
                $('#window_add_training').html('');
                load_trainings();
            }
            else
            {
                $('#window_add_training').html(html);
            }
        }
    })
}

function window_delete_traning()
{
    var fd = new FormData();
    fd.append('id', $("#training").val());
    fd.append('name', $("#training").text());
    $.ajax({
        type: 'POST',
        url: '/training/delete_training/'+$("#training").val(),
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            $('#window_delete_training').html(html);
            $('#window_delete_training').modal({
                keyboard: false
            });
            $('#btn_delete_training').on("click", function(){
                delete_training();
            });
        }
    });
}

function delete_training()
{
    var fd = new FormData();
    fd.append('id', $("#training_id").val());
    $.ajax({
        type: 'POST',
        url: '/training/delete_training_confirm',
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                $('#window_delete_training').modal('hide');
                $('#window_delete_training').html('');
                load_trainings();
            }
            else
            {
                $('#window_delete_training').html(html);
            }
        }
    })
}

function add_day()
{
    var fd = new FormData();
    fd.append('training_id', $("#training").val());
    $.ajax({
        type: 'POST',
        url: '/training/add_day',
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                load_days();
            }
            else
            {
                $('#show_error').html(html);
            }
        }
    })
}

function delete_day()
{
    var fd = new FormData();
    fd.append('day_id', $("#days").val());
    $.ajax({
        type: 'POST',
        url: '/training/delete_day',
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                load_days();
            }
            else
            {
                $('#show_error').html(html);
            }
        }
    })
}

function window_add_block()
{
    $.ajax({
        type: 'POST',
        url: '/training/add_block',
        success: function(html)
        {
            $('#window_add_block').html(html);
            $('#window_add_block').modal({
                keyboard: false
            });
            $("#btn_add_block").on("click", function(){
                add_block();
            });
            $('#window_add_block').keypress(function(e){
                if (e.keyCode == 13)
                    add_block();
            });
            $('#block_time').mask('99:99:99');
        }
    });

}

function add_block()
{
    var fd = new FormData();
    fd.append('day_id', $("#days").val());
    fd.append('block_name', $('#block_name').val());
    fd.append('block_num', $('#block_num').val());
    fd.append('block_time', $('#block_time').val());
    $.ajax({
        type: 'POST',
        url: '/training/add_block',
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                $('#window_add_block').modal('hide');
                $('#window_add_block').html('');
                load_blocks();
                build_training();
            }
            else
            {
                $('#window_add_block').html(html);
            }
        }
    })
}

function window_delete_block()
{
    $.ajax({
        type: 'POST',
        url: '/training/delete_block/'+$("#block").val(),
        success: function(html)
        {
            $('#window_delete_block').html(html);
            $('#window_delete_block').modal({
                keyboard: false
            });
            $('#btn_delete_block').on("click", function(){
                delete_block();
            });
        }
    });
}

function delete_block()
{
    var fd = new FormData();
    fd.append('id', $("#block_id").val());
    $.ajax({
        type: 'POST',
        url: '/training/delete_block_confirm',
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                $('#window_delete_block').modal('hide');
                $('#window_delete_block').html('');
                $('#show_block_practice').html('');
                load_blocks();
                build_training();
            }
            else
            {
                $('#window_delete_block').html(html);
            }
        }
    })
}

function add_block_practice()
{
    var fd = new FormData();
    fd.append('practice_id', $('#all_practice').val());
    fd.append('block_id', $('#block').val());
    $.ajax({
       type: 'POST',
        url: '/training/add_block_practice',
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                load_block_practice();
                build_training();
            }
            else
            {
                $("#show_error").html(html);
            }
        }
    });
}

function delete_block_practice()
{
    var fd = new FormData();
    fd.append('block_practice_id', $('#block_practice').val());
    fd.append('block_id', $('#block').val());
    $.ajax({
        type: 'POST',
        url: '/training/delete_block_practice',
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                load_block_practice();
                build_training();
            }
            else
            {
                $("#show_error").html(html);
            }
        }
    });
}

function view_practice()
{
    $.ajax({
       type: 'POST',
        url: '/practice/view_practice/'+$('#all_practice').val(),
        success: function(html)
        {
            $('#window_view_practice').html(html);
            $('#window_view_practice').modal('toggle');
        }
    });
}

function build_training()
{
    $.ajax({
       type: 'POST',
        url:'/training/build_training/'+$('#training').val(),
        success: function(html)
        {
            $('#training_builder').html(html);
        }
    });
}

function window_add_practice()
{
    $.ajax({
        type: 'POST',
        url: '/practice/add_practice',
        success: function(html)
        {
            $('#window_add_practice').html(html);
            $('#practice_time').mask('99:99:99');
            $('#window_add_practice').modal({
                keyboard: false
            });
            $("#btn_add_practice").on("click", function(){
                add_practice();
            });
            $('#window_add_practice').keypress(function(e){
                if (e.keyCode == 13)
                    add_practice();
            });
        }
    });

}

function add_practice()
{
    var fd = new FormData();
    fd.append('name', $('#practice_name').val());
    fd.append('time', $('#practice_time').val());
    fd.append('theme', $('#practice_theme').val());
    fd.append('purpose', $('#practice_purpose').val());
    fd.append('content', $('#practice_content').val());
    fd.append('inference', $('#practice_inference').val());
    fd.append('material', $('#practice_material').val());
    $.ajax({
        type: 'POST',
        url: '/practice/add_practice',
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                $('#window_add_practice').modal('hide');
                $('#window_add_practice').html('');
                load_all_practice();
            }
            else
            {
                $('#window_add_practice').html(html);
            }
        }
    })
}

function window_delete_practice()
{
    $.ajax({
        type: 'POST',
        url: '/practice/delete_practice/'+$("#all_practice").val(),
        processData: false,
        contentType: false,
        success: function(html)
        {
            $('#window_delete_practice').html(html);
            $('#window_delete_practice').modal({
                keyboard: false
            });
            $('#btn_delete_practice').on("click", function(){
                delete_practice();
            });
        }
    });
}

function delete_practice()
{
    var fd = new FormData();
    fd.append('id', $("#practice_id").val());
    $.ajax({
        type: 'POST',
        url: '/practice/delete_practice_confirm',
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                $('#window_delete_practice').modal('hide');
                $('#window_delete_practice').html('');
                load_all_practice();
            }
            else
            {
                $('#window_delete_practice').html(html);
            }
        }
    })
}

function window_edit_practice()
{
    $.ajax({
        type: 'POST',
        url: '/practice/edit_practice/'+$('#all_practice').val(),
        success: function(html)
        {
            $('#window_edit_practice').html(html);
            $('#practice_time').mask('99:99:99');
            $('#window_edit_practice').modal({
                keyboard: false
            });
            $("#btn_edit_practice").on("click", function(){
                edit_practice();
            });
            $('#btn_add_practice').keypress(function(e){
                if (e.keyCode == 13)
                    edit_practice();
            });
        }
    });

}

function edit_practice()
{
    var fd = new FormData();
    fd.append('id', $('#practice_id').val());
    fd.append('name', $('#practice_name').val());
    fd.append('time', $('#practice_time').val());
    fd.append('theme', $('#practice_theme').val());
    fd.append('purpose', $('#practice_purpose').val());
    fd.append('content', $('#practice_content').val());
    fd.append('inference', $('#practice_inference').val());
    fd.append('material', $('#practice_material').val());
    $.ajax({
        type: 'POST',
        url: '/practice/edit_practice/'+$('#all_practice').val(),
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                $('#window_edit_practice').modal('hide');
                $('#window_edit_practice').html('');
                load_all_practice();
            }
            else
            {
                $('#window_edit_practice').html(html);
            }
        }
    })
}

function window_edit_block()
{
    $.ajax({
        type: 'POST',
        url: '/training/edit_block/'+$('#block').val(),
        success: function(html)
        {
            $('#window_edit_block').html(html);
            $('#window_edit_block').modal({
                keyboard: false
            });
            $("#btn_edit_block").on("click", function(){
                edit_block();
            });
            $('#window_edit_block').keypress(function(e){
                if (e.keyCode == 13)
                    edit_block();
            });
        }
    });

}

function edit_block()
{
    var fd = new FormData();
    fd.append('id', $('#block_id').val());
    fd.append('block_name', $('#block_name').val());
    $.ajax({
        type: 'POST',
        url: '/training/edit_block/'+$('#block_id').val(),
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                $('#window_edit_block').modal('hide');
                $('#window_edit_block').html('');
                load_blocks();
            }
            else
            {
                $('#window_edit_block').html(html);
            }
        }
    })
}

function window_edit_training()
{
    $.ajax({
        type: 'POST',
        url: '/training/edit_training/'+$('#training').val(),
        success: function(html)
        {
            $('#window_edit_training').html(html);
            $('#window_edit_training').modal({
                keyboard: false
            });
            $("#btn_edit_training").on("click", function(){
                edit_training();
            });
            $('#window_edit_training').keypress(function(e){
                if (e.keyCode == 13)
                    edit_training();
            });
        }
    });

}

function edit_training()
{
    var fd = new FormData();
    fd.append('id', $('#training_id').val());
    fd.append('name', $('#training_name').val());
    $.ajax({
        type: 'POST',
        url: '/training/edit_training/'+$('#training_id').val(),
        data: fd,
        processData: false,
        contentType: false,
        success: function(html)
        {
            if(html=="success")
            {
                $('#window_edit_training').modal('hide');
                $('#window_edit_training').html('');
                load_trainings();
                build_training();
            }
            else
            {
                $('#window_edit_training').html(html);
            }
        }
    })
}