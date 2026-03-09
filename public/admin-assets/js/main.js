/*Side Menu
==============================*/
$(document).ready(function () {
    "use strict";
    $(".side-menu ul li a").click(function (e) {
    $(".side-menu ul li ul").slideUp(),
        $(this).next().is(":visible") || $(this).next().slideDown(),
    e.stopPropagation()
    })
});

/* Toggle Icon
==============================*/
$(document).ready(function () {
    "use strict";
    $(".toggle-icon").click(function (){
        $(".side-menu").toggleClass("move");
        $(".main").toggleClass("move");
    });
});

 /* Full Screen
==============================*/
$(document).ready(function () {
    "use strict";
    function headerSize() {
        var winh = $(window).height(),
            halfH = $(window).innerHeight() / 2,
            centerh = $(".center-height"),
            divHeight = $(".center-height").outerHeight(),
            divHalfHeight = divHeight / 2,
            centerDiv = halfH - divHalfHeight;
        $(".login-wrap").height(winh);
        $(".center-height").css({top: centerDiv});
    }
    headerSize();
    $(window).resize(function () {
        headerSize();
    });
});

/* DataTable
==============================*/
$(document).ready(function () {
    "use strict";
    $('#datatable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});

/* ToolTip
==============================*/
$(document).ready(function () {
    "use strict";
    $('[data-toggle="tooltip"]').tooltip()
});

/* Date Picker
=============================*/
$(document).ready(function () {
    "use strict";
    $('.form_date').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0,
        pickerPosition: "bottom-left"
    });
    $('.form_time').datetimepicker({
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0,
        inline: false,
        pickerPosition: "bottom-left"
    });
});

/* Tag Select
============================*/
$(document).ready(function () {
    "use strict";
    $('#tags').select2({
        tags: true,
        tokenSeparators: [',']
    });
 });

/* Select Menu
================================*/
$(document).ready(function () {
    "use strict";
    $(".select-menu").selectmenu();
});

/* Upload
==========================*/
$(document).ready(function (){
    "use strict";
    $('.upload-form .upload_inp').change(function () {
        $('.upload-form p').text(this.files.length + " file(s) selected");
    });
});

/* Upload
==========================*/
$(document).ready(function () {
    var files=[];
    //once refered,  files are not lost after rechossing files..
    $('#file').change(function (v) {
        $.each(v.target.files,function (n,i) {
            var reader = new FileReader(); //need to create new ones...they get busy..
            reader.readAsDataURL(i);
            reader.onload = (function (i) {
                return function(x) {
                    files.push({file:i,data:x.target.result});
                    updateList(files.length-1);
                }
            })(i);
        });
    }); 
    var thumb= $('.thumb').clone().show(), gallery= $('.gallery');
    function updateList(n) {
        var e = thumb.clone();
        e.find('img').attr('src',files[n].data);
        e.find('button').click(removeFromList).data('n',n);
        gallery.append(e);
        function removeFromList() {
            files[$(this).data('n')] = null;
            $(this).parent().remove();
        }  
    }

    $(".jfilestyle").jfilestyle({
        // theme: "blue",
        text: " Add Image ",
        placeholder: " Add image ",
    });
}); 
/*Loading
==========================*/
$(window).on("load", function () {
    "use strict";
    $(".spinner").fadeOut(function () {
        $(this).parent().fadeOut();
        $("body").css({"overflow-y" : "visible"});
    });
});

