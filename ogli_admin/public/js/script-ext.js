function getURLVar(key) {
    var value = [];
    var query = String(document.location).split('?');
    if (query[1]) {
        var part = query[1].split('&');
        for (i = 0; i < part.length; i++) {
            var data = part[i].split('=');
            if (data[0] && data[1]) {
                value[data[0]] = data[1];
            }
        }
        if (value[key]) {
            return value[key];
        } else {
            return '';
        }
    }
}
$(document).ready(function() {
    $('button[type=\'submit\']').on('click', function() {
        $("form[id*='form-']").submit();
    });
    $('.text-danger').each(function() {
        var element = $(this).parent().parent();
        if (element.hasClass('form-group')) {
            element.addClass('has-error');
        }
    });
    $('#menu a[href]').on('click', function() {
        sessionStorage.setItem('menu', $(this).attr('href'));
    });
    if (!sessionStorage.getItem('menu')) {
        $('#menu #dashboard').addClass('active');
    } else {
        $('#menu a[href=\'' + sessionStorage.getItem('menu') + '\']').parents('li').addClass('active open');
    }
    if (localStorage.getItem('column-left') == 'active') {
        $('#button-menu i').replaceWith('<i class="fa fa-dedent fa-lg"></i>');
        $('#column-left').addClass('active');
        $('#menu li.active').has('ul').children('ul').addClass('collapse in');
        $('#menu li').not('.active').has('ul').children('ul').addClass('collapse');
    } else {
        $('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');
        $('#menu li li.active').has('ul').children('ul').addClass('collapse in');
        $('#menu li li').not('.active').has('ul').children('ul').addClass('collapse');
    }
    $('#button-menu').on('click', function() {
        if ($('#column-left').hasClass('active')) {
            //localStorage.setItem('column-left', '');
            $('#button-menu i').replaceWith('<i class="fa fa-indent fa-lg"></i>');
            $('#column-left').removeClass('active');
            $('#menu > li > ul').removeClass('in collapse');
            $('#menu > li > ul').removeAttr('style');
        } else {
            //localStorage.setItem('column-left', 'active');
            $('#button-menu i').replaceWith('<i class="fa fa-dedent fa-lg"></i>');
            $('#column-left').addClass('active');
            $('#menu li.open').has('ul').children('ul').addClass('collapse in');
            $('#menu li').not('.open').has('ul').children('ul').addClass('collapse');
        }
    });
    $('#menu').find('li').has('ul').children('a').on('click', function() {
        if ($('#column-left').hasClass('active')) {
            $(this).parent('li').toggleClass('open').children('ul').collapse('toggle');
            $(this).parent('li').siblings().removeClass('open').children('ul.in').collapse('hide');
        } else if (!$(this).parent().parent().is('#menu')) {
            $(this).parent('li').toggleClass('open').children('ul').collapse('toggle');
            $(this).parent('li').siblings().removeClass('open').children('ul.in').collapse('hide');
        }
    });
    $('button[data-event=\'showImageDialog\']').attr('data-toggle', 'image').removeAttr('data-event');
    $(document).delegate('button[data-toggle=\'image\']', 'click', function() {
        $('#modal-image').remove();
        $.ajax({
            url: 'index.php?route=common/filemanager&token=' + getURLVar('token'),
            dataType: 'html',
            beforeSend: function() {
                $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                $('#button-image').prop('disabled', true);
            },
            complete: function() {
                $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
                $('#button-image').prop('disabled', false);
            },
            success: function(html) {
                $('body').append('<div id="modal-image" class="modal">' + html + '</div>');
                $('#modal-image').modal('show');
            }
        });
    });
    $(document).delegate('a[data-toggle=\'image\']', 'click', function(e) {
        e.preventDefault();
        var element = this;
        $(element).popover({
            html: true,
            placement: 'right',
            trigger: 'manual',
            content: function() {
                return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
            }
        });
        $(element).popover('toggle');
        $('#button-image').on('click', function() {
            $('#modal-image').remove();
            $.ajax({
                url: 'index.php?route=common/filemanager&token=' + getURLVar('token') + '&target=' + $(element).parent().find('input').attr('id') + '&thumb=' + $(element).attr('id'),
                dataType: 'html',
                beforeSend: function() {
                    $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                    $('#button-image').prop('disabled', true);
                },
                complete: function() {
                    $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
                    $('#button-image').prop('disabled', false);
                },
                success: function(html) {
                    $('body').append('<div id="modal-image" class="modal">' + html + '</div>');
                    $('#modal-image').modal('show');
                }
            });
            $(element).popover('hide');
        });
        $('#button-clear').on('click', function() {
            $(element).find('img').attr('src', $(element).find('img').attr('data-placeholder'));
            $(element).parent().find('input').attr('value', '');
            $(element).popover('hide');
        });
    });
    $('[data-toggle=\'tooltip\']').tooltip({
        container: 'body',
        html: true
    });
    $(document).ajaxStop(function() {
        $('[data-toggle=\'tooltip\']').tooltip({
            container: 'body'
        });
    });
});
(function($) {
    function Autocomplete(element, options) {
        this.element = element;
        this.options = options;
        this.timer = null;
        this.items = new Array();
        $(element).attr('autocomplete', 'off');
        $(element).on('focus', $.proxy(this.focus, this));
        $(element).on('blur', $.proxy(this.blur, this));
        $(element).on('keydown', $.proxy(this.keydown, this));
        $(element).after('<ul class="dropdown-menu"></ul>');
        $(element).siblings('ul.dropdown-menu').delegate('a', 'click', $.proxy(this.click, this));
    }
    Autocomplete.prototype = {
        focus: function() {
            this.request();
        },
        blur: function() {
            setTimeout(function(object) {
                object.hide();
            }, 200, this);
        },
        click: function(event) {
            event.preventDefault();
            value = $(event.target).parent().attr('data-value');
            if (value && this.items[value]) {
                this.options.select(this.items[value]);
            }
        },
        keydown: function(event) {
            switch (event.keyCode) {
                case 27:
                    this.hide();
                    break;
                default:
                    this.request();
                    break;
            }
        },
        show: function() {
            var pos = $(this.element).position();
            $(this.element).siblings('ul.dropdown-menu').css({
                top: pos.top + $(this.element).outerHeight(),
                left: pos.left
            });
            $(this.element).siblings('ul.dropdown-menu').show();
        },
        hide: function() {
            $(this.element).siblings('ul.dropdown-menu').hide();
        },
        request: function() {
            clearTimeout(this.timer);
            this.timer = setTimeout(function(object) {
                object.options.source($(object.element).val(), $.proxy(object.response, object));
            }, 200, this);
        },
        response: function(json) {
            html = '';
            if (json.length) {
                for (i = 0; i < json.length; i++) {
                    this.items[json[i]['value']] = json[i];
                }
                for (i = 0; i < json.length; i++) {
                    if (!json[i]['category']) {
                        html += '<li data-value="' + json[i]['value'] + '"><a href="#">' + json[i]['label'] + '</a></li>';
                    }
                }
                var category = new Array();
                for (i = 0; i < json.length; i++) {
                    if (json[i]['category']) {
                        if (!category[json[i]['category']]) {
                            category[json[i]['category']] = new Array();
                            category[json[i]['category']]['name'] = json[i]['category'];
                            category[json[i]['category']]['item'] = new Array();
                        }
                        category[json[i]['category']]['item'].push(json[i]);
                    }
                }
                for (i in category) {
                    html += '<li class="dropdown-header">' + category[i]['name'] + '</li>';
                    for (j = 0; j < category[i]['item'].length; j++) {
                        html += '<li data-value="' + category[i]['item'][j]['value'] + '"><a href="#">&nbsp;&nbsp;&nbsp;' + category[i]['item'][j]['label'] + '</a></li>';
                    }
                }
            }
            if (html) {
                this.show();
            } else {
                this.hide();
            }
            $(this.element).siblings('ul.dropdown-menu').html(html);
        }
    };
    $.fn.autocomplete = function(option) {
        return this.each(function() {
            var data = $(this).data('autocomplete');
            if (!data) {
                data = new Autocomplete(this, option);
                $(this).data('autocomplete', data);
            }
        });
    }
})(window.jQuery);