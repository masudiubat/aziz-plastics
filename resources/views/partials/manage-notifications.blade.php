<script>
    //this function auto update the notification after 5sec
    setInterval(function() {
        checkNotifications();
    }, 5000);

    function checkNotifications() {
        var url = "{{url('/ajax/get/notifications')}}";
        $.ajax({
            url: url,
            method: "GET",
        }).done(function(data) {
            $('#address').attr('value', data.company.address);
            $('#phone').attr('value', data.company.phone);
            $('#dealerCode').attr('value', data.company.dealer_code);
        });
    }
</script>