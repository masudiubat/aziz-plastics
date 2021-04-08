<script>
    //this function auto update the notification after 5sec
    setInterval(function() {
        checkNotifications();
    }, 3000);

    function checkNotifications() {
        var url = "{{url('/ajax/get/notifications')}}";
        $.ajax({
            url: url,
            method: "GET",
        }).done(function(data) {
            var totalCount = data.newOrders.length;
            $("#newNotificationCount").text(totalCount + " New Orders");
            $("#notificationList").empty();
            for (var i = 0; i < totalCount; i++) {
                var html = '<a href="' + data.newOrders[i]['id'] + '" class="kt-notification__item">' +
                    '<div class="kt-notification__item-icon">' +
                    '<i class="flaticon2-line-chart kt-font-success"></i>' +
                    '</div>' +
                    '<div class="kt-notification__item-details">' +
                    '<div class="kt-notification__item-title">' +
                    data.newOrders[i].dealer['company_name'] +
                    '</div>' +
                    '<div class="kt-notification__item-time">' +


                    '</div>' +
                    '</div>' +
                    '</a>';
                $("#notificationList").append(html);
            }


        });
    }
</script>