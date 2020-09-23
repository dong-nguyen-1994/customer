function Address() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    const url = location.href;
    if (url.indexOf('address') > 0) {
        $('#address_group').addClass('mm-active');
    }

    if ($('.modal-content').length == 0) {
        $.ajax({
            url: adminPath + '/zone/province/' + $('#province_id').val() + '/districts',
            data: {
                district_id: $('#district_id').val()
            },
            success: function (response) {
                $('#zone_level_2').html(response.districts)
            }
        });

        $.ajax({
            url: adminPath + '/zone/district/' + $('#district_id').val() + '/townships',
            data: {
                township_id: $('#township_id').val()
            },
            success: function (response) {
                $('#zone_level_3').html(response.townships)
            }
        });
    }


    $('body').on('change', '#zone_level_1', function (e) {
        $.ajax({
            url: adminPath + '/zone/province/' + $(this).val() + '/districts',
            data: {
                district_id: $('#district_id').val()
            },
            success: function (response) {
                $('#zone_level_2').html(response.districts);
                $.ajax({
                    url: adminPath + '/zone/district/' + response.firstItemId + '/townships',
                    data: {
                        township_id: $('#township_id').val()
                    },
                    success: function (response) {
                        $('#zone_level_3').html(response.townships)
                    }
                });
            }
        });
    });

    $('body').on('change', '#zone_level_2', function (e) {
        $.ajax({
            url: adminPath + '/zone/district/' + $(this).val() + '/townships',
            data: {
                township_id: $('#township_id').val()
            },
            success: function (response) {
                $('#zone_level_3').html(response.townships)
            }
        });
    });

    $('body').on('click', '.updateOrAddAddress', function (e) {
        e.preventDefault();
        let data = {
            customer_id: $('#customer_id').val(),
            zone_level_1: $('#zone_level_1').val(),
            zone_level_2: $('#zone_level_2').val(),
            zone_level_3: $('#zone_level_3').val(),
            street_address: $('#street_address').val(),
            firstname_address: $('#firstname_address').val(),
            lastname_address: $('#lastname_address').val(),
            email_address: $('#email_address').val(),
            phone_address: $('#phone_address').val(),
        }
        $.ajax({
            url: adminPath + '/customer/address/',
            method: 'POST',
            data: data,
            success: function (response) {
                location.reload();
            },
            error: function (error) {
                console.log(error)
            }
        });
    });

}

$(document).ready(function() {
    new Address();
});
