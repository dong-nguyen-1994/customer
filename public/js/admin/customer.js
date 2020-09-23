function Customer() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if (location.href.indexOf('customer/create') > 0) {
        $('.navAddress').addClass('disabled')
    }
}

$(document).ready(function() {
    new Customer();
});
