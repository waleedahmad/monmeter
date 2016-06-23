class Client{

    accessControlInit(){
        $(".access-enable").on('click', function (e) {
            $(".access").removeClass('ticked');
            $(this).addClass("ticked");
            $("#user-access").val('enabled');
            $(".message.disabled-message").slideUp();
        });

        $(".access-disable").on('click', function (e) {
            $(".access").removeClass('ticked');
            $(this).addClass("ticked");
            $("#user-access").val('disabled');
            $(".message.disabled-message").slideDown();
        });
    }

    updateAccessInit(){
        $(".accessUpdateBtn").on('click', function(){
            var client_id = $("#client-id").val(),
                access = $("#user-access").val(),
                token = $("meta[name=_token]").attr('content');
            console.log(token);

            $.ajax({
                url : '/dashboard/user-control/update/access',
                type : 'POST',

                data : {
                    client : client_id,
                    access : access,
                    _token : token
                },
                success : function(res){
                    if(res.updated){
                        window.location = '/dashboard/user-control/user-list';
                    }
                }
            });

            console.log(client_id, access);
        });
    }

    constructor(){
        this.updateAccessInit();
        this.accessControlInit();
        $("#uc-date").datepicker({ dateFormat: 'yy-mm-dd' });
    }
}

new Client();