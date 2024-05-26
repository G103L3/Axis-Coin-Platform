$(function () {
    var includes = $('[data-include]')
    $.each(includes, function () {
        var file = '' + $(this).data('include') + '.php'
        $(this).load(file)
    })
})