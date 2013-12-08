$(document).ready(function() {
    var cmsLogViewerCollapse = $('div[id^="collapse-"]');
    cmsLogViewerCollapse.on('shown.bs.collapse', function () {
      cmsLogViewerCollapse.removeClass();
    })
    cmsLogViewerCollapse.collapse('show');

    $.ajax({
        url: cmsLogViewerURL,
        type: "GET",
        dataType: "html",
        timeout: 10000,
        success: function(data, status, xhr) {
            var area = $('#data');
            area.fadeOut(200, function() {
                area.html(data);
                area.fadeIn(200);
            });
        },
        error: function(xhr, status, error) {
            var area = $('#data');
            area.fadeOut(200, function() {
                area.html('<p class="lead">There was an error getting the data</p>');
                area.fadeIn(200);
            });
        }
    });
});
