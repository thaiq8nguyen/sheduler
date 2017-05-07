
var app = (function(){
    var $calendar, $appointmentDate, $timeSlotContainer;

    var init = function(){

        var offset = new Date().getTimezoneOffset();
        cachedDOM();
        bindEvents();


    }

    var cachedDOM = function(){
        $calendar = $("#calendar");
        $appointmentDate = $('#appointment-date');
        $timeSlotContainer = $("#time-slot-container");

    }

    var bindEvents = function(){
        initCalendar();
        $calendar.on('change',function(){
            var dateString = new Date($(this).val());
            var date = moment(dateString).format('YYYY-MM-DD');
            initTimeSlot(date);
        });

        $timeSlotContainer.on('click', '.time-slot', function(){
            var timeSlot = $(this);

            if(timeSlot.hasClass('time-slot-select')){
                timeSlot.removeClass('time-slot-select').addClass('time-slot-unselect');
            }else{
                timeSlot.siblings().removeClass('time-slot-select');
                timeSlot.removeClass('time-slot-unselect').addClass('time-slot-select');
            }

            $appointmentDate.val(timeSlot.data('time-slot'));
        });
    }
    var initCalendar = function(){

        var start, end, now;
        now = moment();

        start = now.format('MM/DD/YYYY');
        end = now.clone().add(1,'months').format('MM/DD/YYYY');
        $calendar.datepicker({
            startDate: start,
            endDate: end,
            todayBtn: true,
            todayHighlight: true,
            autoclose:true
        });
    }
    var initTimeSlot = function(selectDate) {
        $.ajax({
            type:'get',
            url:'/api/appointments/' + selectDate,
            dataType: 'json',
            cache:false
        }).done(function(response) {
            var timeSlot = '';
            $.each(response,function(){
                timeSlot += '<div class = "time-slot" data-time-slot = "' + this.time + '">' + moment(this.time).format('h:mm A') + '</div>'
            });
            $timeSlotContainer.html(timeSlot);
        });
    }

    return {
        init: init
    }

})();

$(document).ready(app.init())

