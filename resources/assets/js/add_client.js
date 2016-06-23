class Client{



    accessControlInit(){
        $(".access-enable").on('click', function (e) {
            $(".access").removeClass('ticked')
            $(this).addClass("ticked");
            $("#user-access").val('enabled');
        });

        $(".access-disable").on('click', function (e) {
            $(".access").removeClass('ticked')
            $(this).addClass("ticked");
            $("#user-access").val('disabled');
        });
    }

    constructor(){
        this.accessControlInit();

        $("#uc-date").datepicker({ dateFormat: 'yy-mm-dd' });
    }
}

new Client();