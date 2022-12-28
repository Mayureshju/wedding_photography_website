$(document).ready(function() {

    $('#example').DataTable();
    $(".dataTables_filter").addClass("pull-right");
    $(".pagination").addClass("pull-right");
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        var switchery = new Switchery(html, { size: 'small' });
    });


    var userid = Userid;
    if (userid != '') {
        $.ajax({
            type: "POST",
            url: CI_ROOT + 'Appointment/get_userdates',
            data: {
                userid: userid
            },
            success: function(result) {
                //alert(result); 
                if (result != 'no') {
                    var data = result.split(',');
                    var dates = [];
                    //alert(data);
                    // $("#tasktype").html('');
                    // $("#tasktype").html(result);
                    for (i = 0; i < data.length; i++) {

                        if (data[i] != '0000-00-00') {
                            var covdate = convertDate(data[i]);
                            ///alert(covdate)
                            var date_formate = covdate.replace(/-/g, ' ');
                            //alert(date_formate)
                            dates.push(date_formate)
                        }
                    }
                    $("#startdate").Zebra_DatePicker({
                        direction: true,
                        disabled_dates: dates
                    });
                    $("#enddate").Zebra_DatePicker({
                        direction: true,
                        disabled_dates: dates
                    });
                    $("#restartdate").Zebra_DatePicker({
                        direction: true,
                        disabled_dates: dates
                    });
                    $("#reenddate").Zebra_DatePicker({
                        direction: true,
                        disabled_dates: dates
                    });

                }

            }
        });
    }
});

//$("#datatable-responsive").on('click', 'tr', function () {
$(".status").click(function() {
    var isok = 0;
    var pass = confirm("Do you want to update the status?");
    if (pass != '') {
        var statuscl = 0;

        if ($(this).hasClass('active_status')) {
            statuscl = 0;
        } else {
            statuscl = 1;
        }

        var cntid = $(this).attr('alt');

        $.ajax({
            type: "POST",
            url: CI_ROOT + 'Client/chkuser',
            async: false,
            data: {
                statuscl: statuscl,
                cntid: cntid
            },
            success: function(result) {
                if (result == 3) {
                    alert("Status Updated!");
                    isok = 1;
                } else if (result == 4) {
                    alert("Problem with status updated!");
                    isok = 0;
                }
            }
        });

    } else {
        alert("Some thing wrong!");
        isok = 0;
    }



});


function edit_review(id, search, page) {

    if (id != '')
        window.location.href = CI_ROOT + "review/edit_review/" + id + "/" + search + "/" + page;
    else
        alert("Problem with update");

}

// function searchsubmit()
// {
// 	var city = $("#city").val();

// 	$("#mainform").submit(); 
// }	


function readURLbanr(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#blahbanr').attr('src', e.target.result).width(100).height(100);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#userid").change(function() {

    var userid = $("#userid").val();
    $.ajax({
        type: "POST",
        url: CI_ROOT + 'review/get_userdates',
        data: {
            userid: userid
        },
        success: function(result) {
            //alert(result); 
            if (result != 'no') {
                var data = result.split(',');
                var dates = [];
                //alert(data);
                // $("#tasktype").html('');
                // $("#tasktype").html(result);
                for (i = 0; i < data.length; i++) {

                    if (data[i] != '0000-00-00') {
                        var covdate = convertDate(data[i]);
                        ///alert(covdate)
                        var date_formate = covdate.replace(/-/g, ' ');
                        //alert(date_formate)
                        dates.push(date_formate)
                    }
                }
                $("#startdate").Zebra_DatePicker({
                    direction: true,
                    disabled_dates: dates
                });
                $("#enddate").Zebra_DatePicker({
                    direction: true,
                    disabled_dates: dates
                });
                $("#restartdate").Zebra_DatePicker({
                    direction: true,
                    disabled_dates: dates
                });
                $("#reenddate").Zebra_DatePicker({
                    direction: true,
                    disabled_dates: dates
                });

            }

        }
    });
});

function convertDate(inputFormat) {
    function pad(s) { return (s < 10) ? '0' + s : s; }
    var d = new Date(inputFormat)
    return [pad(d.getDate()), pad(d.getMonth() + 1), d.getFullYear()].join(' ')
}

$("#orderid").change(function() {

    var orderid = $("#orderid").val();
    //alert(orderid);
    $.ajax({
        type: "POST",
        url: CI_ROOT + 'review/get_orderdata',
        data: {
            orderid: orderid
        },
        success: function(result) {
            //alert(result); 
            if (result != 'no') {
                var data = result.split(',');
                $("#clientid").val(data[0]).change();
                $("#tattoodt").val(data[1]);
                //$("#tattoodt option[value="+data[1]+"]").attr('selected', 'selected');
            }

        }
    });

});